<?php

/**
 * PHP Version 8.1
 * NotificationService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/NotificationService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;

/**
 * NotificationService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/NotificationService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface NotificationService
{
    /**
     * Notification.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function notification(Transaction $transaction): void;

    /**
     * GenerateClientSMS.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     */
    public function generateClientSMS(Transaction $transaction): ?array;

    /**
     * GenerateAdminSMS.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     */
    public function generateAdminSMS(Transaction $transaction): ?array;

    /**
     * GenerateClientEmail.
     *
     * @param Transaction $transaction transaction
     *
     * @return string
     */
    public function generateClientEmail(Transaction $transaction): string;

    /**
     * GenerateAdminEmail.
     *
     * @param Transaction $transaction transaction
     *
     * @return string
     */
    public function generateAdminEmail(Transaction $transaction): string;

    /**
     * SendClientSMS.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function sendClientSMS(Transaction $transaction): void;

    /**
     * SendAdminSMS.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function sendAdminSMS(Transaction $transaction): void;

    /**
     * SendClientEmail.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function sendClientEmail(Transaction $transaction): void;

    /**
     * sendAdminEmail.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function sendAdminEmail(Transaction $transaction): void;
}
