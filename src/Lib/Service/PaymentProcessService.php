<?php

/**
 * PHP Version 8.1
 * PaymentProcessService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/PaymentProcessService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\ProviderResponse;

/**
 * PaymentProcessService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/PaymentProcessService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface PaymentProcessService
{
    /**
     * Payment.
     *
     * @param Transaction $transaction transaction
     *
     * @return array
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function payment(Transaction $transaction): array;

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
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function process(
        ApiProcessService $apiProcessService,
        ?array $apiResponse,
        ?Transaction $transaction = null,
        bool $endProcess = true
    ): Transaction;

    /**
     * TokenRequest.
     *
     * @param Transaction $transaction transaction
     *
     * @return string|null
     *
     * @throws \Exception|NetworkException|GeneralNetworkException
     */
    public function tokenRequest(Transaction $transaction): string|null;

    /**
     * HeadersRequest.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     */
    public function headersRequest(Transaction $transaction): ?array;

    /**
     * BodyRequest.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     */
    public function bodyRequest(Transaction $transaction): ?array;
}
