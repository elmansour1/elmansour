<?php

/**
 * PHP Version 8.1
 * CallbackNotificationService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/CallbackNotificationService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;

/**
 * CallbackNotificationService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/CallbackNotificationService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface CallbackNotificationService
{
    /**
     * CallbackNotification.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function callbackNotification(Transaction $transaction): void;

    /**
     * CallbackNotification.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function callback(Transaction $transaction): void;

    /**
     * GenerateSignature.
     *
     * @param Transaction $transaction transaction
     *
     * @return string
     */
    public function generateSignature(Transaction $transaction): string;

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
