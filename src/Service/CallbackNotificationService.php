<?php

/**
 * PHP Version 8.1
 * CallbackNotificationService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/CallbackNotificationService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponseDTO;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\CallbackNotificationService as CNotfS;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\HttpService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\ReferenceMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use DateTimeZone;
use DateTime;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponse;

/**
 * CallbackNotificationService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/CallbackNotificationService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class CallbackNotificationService implements CNotfS
{
    protected HttpService $httpService;
    protected ReferenceMapper $referenceMapper;
    protected TransactionMapper $transactionMapper;
    protected ReferenceService $referenceService;

    /**
     * Constructor.
     *
     * @param HttpService       $messagingService  messagingService
     * @param ReferenceMapper   $referenceMapper   referenceMapper
     * @param TransactionMapper $transactionMapper transactionMapper
     * @param ReferenceService  $referenceService  referenceService
     *
     * @return void
     */
    public function __construct(
        HttpService $httpService,
        ReferenceMapper $referenceMapper,
        TransactionMapper $transactionMapper,
        ReferenceService $referenceService
    ) {
        $this->httpService = $httpService;
        $this->referenceMapper = $referenceMapper;
        $this->transactionMapper = $transactionMapper;
        $this->referenceService = $referenceService;
    }

    /**
     * CallbackNotification.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.EmptyCatchBlock)
     */
    public function callbackNotification(Transaction $transaction): void
    {
        try {
            $this->callback($transaction);
        } catch (\Throwable $exception) {
        }
    }

    /**
     * CallbackNotification.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function callback(Transaction $transaction): void
    {
        if (!isset($transaction->callbackUrl) || !$transaction->callbackUrl) {
            return ;
        }

        $bodyRequest = $this->bodyRequest($transaction);
        $headersRequest = $this->headersRequest($transaction);

        $this->httpService->sendPOSTWithTokenSet(
            $transaction->callbackUrl,
            $bodyRequest,
            $headersRequest
        );
    }

    /**
     * GenerateSignature.
     *
     * @param Transaction $transaction transaction
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function generateSignature(Transaction $transaction): string
    {
        $signatureVars = explode(
            $_ENV['API_CALLBACK_SIGNATURE_SEPARATOR'],
            $_ENV['API_CALLBACK_SIGNATURE_VARS']
        );

        $text = '';

        foreach ($signatureVars as $value) {
            $text .= $value;
        }

        return hash_hmac(
            AppConstants::SHA256,
            $text,
            $_ENV['API_CALLBACK_SIGNATURE_SECRET']
        );
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
        return [
            AppConstants::SIGNATURE . ':' . $this->generateSignature($transaction)
        ];
    }

    /**
     * BodyRequest.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function bodyRequest(Transaction $transaction): ?array
    {
        $referenceDTO = null;

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['REFERENCE_API_ENABLED']) {
            $transaction->referenceData = $this
                ->referenceService
                ->findByReferenceNumber(
                    $transaction->reference
                );
            $referenceDTO = $this->referenceMapper->asDTO(
                $transaction->referenceData
            );
        }

        $transactionDTO = $this->transactionMapper->asDTO($transaction);

        $paymentResponse = new PaymentResponse($transactionDTO, $referenceDTO);
        $paymentDTO = $paymentResponse->paymentResponseDTO;

        return get_object_vars($paymentDTO);
    }
}
