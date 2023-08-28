<?php

/**
 * PHP Version 8.1
 * PaymentProcessService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/PaymentProcessService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadProviderResponseException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentApplicationException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\RequiredProviderIdException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\FullTransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\ProviderResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ApiProcessService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\HttpService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentProcessService as PyProS;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentSuccessService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\NotificationService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\CallbackNotificationService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentFailedService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentErrorService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\CallbackMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\UpdateProviderDataMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\UpdateProviderIdMessage;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * PHP Version 8.1
 * PaymentProcessService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/PaymentProcessService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 * @SuppressWarnings(PHPMD.Superglobals)
 * @SuppressWarnings(PHPMD.EmptyCatchBlock)
 */
class PaymentProcessService implements PyProS
{
    protected HttpService $httpService;
    protected TransactionService $transactionService;
    protected PaymentSuccessService $paySucService;
    protected NotificationService $notificationService;
    protected CallbackNotificationService $callbackNotificationService;
    protected PaymentFailedService $paymentFailedService;
    protected PaymentErrorService $paymentErrorService;
    protected MessageBusInterface $bus;
    protected ReferenceService $referenceService;
    protected TransactionMapper $transactionMapper;
    protected FullTransactionMapper $fullTransactionMapper;

    /**
     * Constructor.
     *
     * @param HttpService                 $httpService                 httpService
     * @param TransactionService          $transactionService          transactionService
     * @param PaymentSuccessService       $paySucService               paySucService
     * @param NotificationService         $notificationService         notificationService
     * @param CallbackNotificationService $callbackNotificationService callbackNotificationService
     * @param PaymentFailedService        $paymentFailedService        paymentFailedService
     * @param PaymentErrorService         $paymentErrorService         paymentErrorService
     * @param MessageBusInterface         $bus                         bus
     * @param ReferenceService            $referenceService            referenceService
     * @param TransactionMapper           $transactionMapper           transactionMapper
     * @param FullTransactionMapper       $fullTransactionMapper       fullTransactionMapper
     *
     * @return void
     */
    public function __construct(
        HttpService $httpService,
        TransactionService $transactionService,
        PaymentSuccessService $paySucService,
        NotificationService $notificationService,
        CallbackNotificationService $callbackNotificationService,
        PaymentFailedService $paymentFailedService,
        PaymentErrorService $paymentErrorService,
        MessageBusInterface $bus,
        ReferenceService $referenceService,
        TransactionMapper $transactionMapper,
        FullTransactionMapper $fullTransactionMapper
    ) {
        $this->httpService = $httpService;
        $this->transactionService = $transactionService;
        $this->paySucService = $paySucService;
        $this->notificationService = $notificationService;
        $this->callbackNotificationService = $callbackNotificationService;
        $this->paymentFailedService = $paymentFailedService;
        $this->paymentErrorService = $paymentErrorService;
        $this->bus = $bus;
        $this->referenceService = $referenceService;
        $this->transactionMapper = $transactionMapper;
        $this->fullTransactionMapper = $fullTransactionMapper;
    }

    /**
     * Payment.
     *
     * @param Transaction $transaction transaction
     *
     * @return array
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress InvalidNullableReturnType
     * @psalm-suppress NullableReturnStatement
     * @psalm-suppress MixedArgument
     */
    public function payment(Transaction $transaction): array
    {
        $bodyRequest = $this->bodyRequest($transaction);
        $headersRequest = $this->headersRequest($transaction);
        $tokenRequest = null;
        if ($_ENV['API_TOKEN']) {
            $tokenRequest = $this->tokenRequest($transaction);
        }

        $response = null;

        if ($_ENV['API_PAYMENT']) {
            $response = $this->httpService->sendPOSTWithTokenSet(
                $_ENV['API_PAYMENT'],
                $bodyRequest,
                $headersRequest,
                $tokenRequest
            );
        }

        return $response;
    }


    /**
     * Process.
     *
     * @param ApiProcessService $apiProcessService apiProcessService
     * @param array|null        $apiResponse       apiResponse
     * @param Transaction|null  $transaction       transaction
     * @param bool              $endProcess        endProcess
     *
     * @return Transaction
     *
     * @throws PaymentAPIException
     */
    public function process(
        ApiProcessService $apiProcessService,
        ?array $apiResponse,
        ?Transaction $transaction = null,
        bool $endProcess = true
    ): Transaction {
        $transactionOp = $transaction;
        $status = true;
        $providerResponse = null;

        try {
            $providerResponse = $apiProcessService->generateProviderResponse($apiResponse);
            if (!$providerResponse->providerId) {
                throw new BadProviderResponseException();
            }
            $transactionOp = $this->refreshTransaction($providerResponse, $transactionOp);
            $apiProcessService->decision($providerResponse);
            if ($endProcess) {
                $this->paySucService->decision($transactionOp, $providerResponse);
            }
            $transactionOp = $this->updateTransaction($providerResponse, $transactionOp);
        } catch (RequiredProviderIdException | EntityNotFoundException | PaymentApplicationException $exception) {
            throw $exception;
        } catch (PaymentAPIException $exception) {
            $status = false;
        } catch (\Throwable $exception) {
            throw $this->paymentErrorService->error($exception, $transactionOp);
        }

        return $this->processAfterPayment($providerResponse, $transactionOp, $status, $endProcess);
    }

    /**
     * TokenRequest.
     *
     * @param Transaction $transaction transaction
     *
     * @return string|null
     *
     * @throws \Exception|NetworkException|GeneralNetworkException
     */
    public function tokenRequest(Transaction $transaction): string|null
    {
        return $this->httpService->getToken([]);
    }

    /**
     * HeadersRequest.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     */
    public function headersRequest(Transaction $transaction): ?array
    {
        return [];
    }

    /**
     * BodyRequest.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     */
    public function bodyRequest(Transaction $transaction): ?array
    {
        return $transaction->toArray();
    }

    /**
     * ProcessAfterPayment.
     *
     * @param ProviderPaymentResponse $providerResponse providerResponse
     * @param Transaction             $transaction      transaction
     * @param bool                    $status           status
     * @param bool                    $endProcess       endProcess
     *
     * @return Transaction
     *
     * @throws PaymentAPIException
     */
    protected function processAfterPayment(
        ProviderPaymentResponse $providerResponse,
        Transaction $transaction,
        bool $status,
        bool $endProcess = true
    ): Transaction {
        $transactionOp = $transaction;

        try {
            if ($status && $endProcess) {
                $transactionOp = $this->paySucService->success($transactionOp, $providerResponse);
                $transactionOp = $this->paySucService->setBalance($transaction);
                $this->notificationService->notification($transactionOp);
                $this->callbackNotification($transactionOp);
            } elseif (!$status) {
                $transactionOp = $this->paymentFailedService->failed($transactionOp);
                $this->callbackNotification($transactionOp);
            }
        } catch (\Throwable) {
            //Send alert
        }

        return $transactionOp;
    }

    /**
     * RefreshTransaction.
     *
     * @param ProviderPaymentResponse $providerResponse providerResponse
     * @param Transaction|null        $transaction      transaction
     *
     * @throws RequiredProviderIdException|EntityNotFoundException
     *
     * @return void
     */
    protected function refreshTransaction(
        ProviderPaymentResponse $providerResponse,
        ?Transaction $transaction
    ): Transaction {
        $transactionOp = $transaction;

        if (!$transactionOp) {
            $transactionOp = $this->transactionService->findOneByProviderId($providerResponse->providerId);

            if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['REFERENCE_API_ENABLED']) {
                $transactionOp->referenceData = $this->referenceService->findByReferenceNumber(
                    $transactionOp->reference ?? ''
                );
            }
        }

        return $transactionOp;
    }

    /**
     * UpdateTransaction.
     *
     * @param ProviderPaymentResponse $response    response
     * @param Transaction|null        $transaction $transactionOp
     *
     * @return void
     */
    protected function updateTransaction(
        ProviderPaymentResponse $response,
        ?Transaction $transactionOp
    ): Transaction {
        $transaction = $transactionOp;

        try {
            foreach (get_object_vars($response) as $key => $value) {
                if (property_exists($transaction, $key) && null != $value) {
                    $transaction->$key = $value;
                }
            }

            $this->bus->dispatch(
                new UpdateProviderDataMessage(
                    $this->fullTransactionMapper->asDTO($transaction)
                )
            );
        } catch (\Throwable $trowable) {
        }

        return $transaction;
    }

    /**
     * UpdateProviderId.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    protected function updateProviderId(Transaction $transaction): void
    {
        $this->bus->dispatch(
            new UpdateProviderIdMessage(
                $this->fullTransactionMapper->asDTO($transaction)
            )
        );
    }

    /**
     * CallbackNotification.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    protected function callbackNotification(Transaction $transaction): void
    {
        $this->bus->dispatch(
            new CallbackMessage(
                $this->transactionMapper->asDTO($transaction)
            )
        );
    }
}
