<?php

/**
 * PHP Version 8.1
 * PaymentService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/PaymentService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Transaction as EntityTransaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadApiResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadProviderResponseException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\ReferencePaidException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentService as BasePaymSv;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\DecisionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\OptionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentErrorService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentVerifyService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentProcessService;
use DateTimeZone;
use DateTime;

/**
 * PaymentService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/PaymentService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class PaymentService implements BasePaymSv
{
    protected TransactionService $transactionService;
    protected OptionService $optionService;
    protected ReferenceService $referenceService;
    protected PaymentErrorService $paymentErrorService;
    protected PaymentVerifyService $paymentVerifyService;
    protected PaymentProcessService $payProcService;

    /**
     * Constructor.
     *
     * @param TransactionService   $transactionService   transactionService
     * @param OptionService        $optionService        optionService
     * @param ReferenceService     $referenceService     referenceService
     * @param PaymentErrorService  $paymentErrorService  paymentErrorService
     * @param PaymentVerifyService $paymentVerifyService paymentVerifyService
     *
     * @return void
     */
    public function __construct(
        TransactionService $transactionService,
        OptionService $optionService,
        ReferenceService $referenceService,
        PaymentErrorService $paymentErrorService,
        PaymentVerifyService $paymentVerifyService,
        PaymentProcessService $payProcService
    ) {
        $this->transactionService = $transactionService;
        $this->optionService = $optionService;
        $this->referenceService = $referenceService;
        $this->paymentErrorService = $paymentErrorService;
        $this->paymentVerifyService = $paymentVerifyService;
        $this->payProcService = $payProcService;
    }

    /**
     * Pay.
     *
     * @param PaymentRequest $request request
     *
     * @return Transaction
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     *
     * @psalm-suppress MixedAssignment
     */
    public function pay(PaymentRequest $request): Transaction
    {
        $this->paymentVerifyService->verify($request);

        $reference = null;

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['REFERENCE_API_ENABLED']) {
            $reference = $this->referenceService->findByReferenceNumber(
                $request->reference ?? ''
            );

            if (Status::SUCCESS == $reference->status || Status::PROGRESS == $reference->status) {
                $date = $reference
                    ->lastUpdatedDate
                    ->setTimezone(new DateTimeZone($_ENV['TIME_ZONE_PROVIDER']))
                    ->format($_ENV['API_DATE_FORMAT']);

                throw new ReferencePaidException($reference->referenceNumber, $date);
            }

            $condition = AppConstants::PARAMETER_FALSE_VALUE ==
                $_ENV['AMOUNT_ENABLED'] &&
                AppConstants::PARAMETER_FALSE_VALUE ==
                $_ENV['OPTION_ENABLED'];

            if ($condition) {
                $request->amount = $reference->amount;
            }
        }

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['OPTION_ENABLED']) {
            $option = $this->optionService->findByReferenceAndSlug(
                $request->reference ?? '',
                $request->option ?? ''
            );
            $request->amount = $option->amount;
        }

        $transaction = $this->generateTransaction($request);
        $transaction->referenceData = $reference;

        $apiResponse = null;
        try {
            $apiResponse = $this->payProcService->payment($transaction);
        } catch (\Throwable $exception) {
            throw $this->paymentErrorService->error($exception, $transaction);
        }

        $endProcess = AppConstants::PARAMETER_FALSE_VALUE == $_ENV['ASYNC_MODE'];

        $transaction = $this->payProcService->process($this, $apiResponse, $transaction, $endProcess);

        return $transaction;
    }

    /**
     * GenerateTransaction.
     *
     * @param PaymentRequest $paymentRequest paymentRequest
     *
     * @return Transaction
     *
     * @psalm-suppress MixedAssignment
     */
    protected function generateTransaction(
        PaymentRequest $paymentRequest
    ): Transaction {
        $transaction = new EntityTransaction();

        foreach (get_object_vars($paymentRequest) as $key => $value) {
            if (property_exists($transaction, $key) && null != $value) {
                $transaction->$key = $value;
            }
        }

        return $this->transactionService->save($transaction);
    }

    /**
     * GenerateProviderPaymentResponse.
     *
     * @param array|null $apiResponse apiResponse
     *
     * @return ProviderPaymentResponse
     *
     * @throws BadApiResponse|PaymentAPIException|BadApiResponse
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress PossiblyUndefinedArrayOffset
     */
    protected function generateProviderPaymentResponse(
        ?array $apiResponse
    ): ProviderPaymentResponse {
        try {
            return $this->generateProviderResponse($apiResponse);
        } catch (\ErrorException $exception) {
            if (AppConstants::ENV_DEV == $_ENV['APP_ENV']) {
                throw new BadApiResponse(
                    $_ENV['API_PAYMENT'],
                    $exception->getMessage()
                );
            }

            throw new BadApiResponse($_ENV['API_PAYMENT']);
        }
    }

    /**
     * GenerateProviderResponse.
     *
     * @param array|null $apiResponse apiResponse
     *
     * @return ProviderPaymentResponse
     *
     * @throws LogicNotImplementedException
     */
    public function generateProviderResponse(?array $apiResponse): ProviderPaymentResponse
    {
        throw new LogicNotImplementedException(__FUNCTION__);
    }

    /**
     * Decision.
     *
     * @param ProviderPaymentResponse $providerResponse providerResponse
     *
     * @return void
     *
     * @throws PaymentAPIException|LogicNotImplementedException
     */
    public function decision(ProviderPaymentResponse $providerResponse): void
    {
        throw new LogicNotImplementedException(__FUNCTION__);
    }
}
