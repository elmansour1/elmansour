<?php

/**
 * PHP Version 8.1
 * HandlerMessage.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/HandlerMessage.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model;

/**
 * HandlerMessage.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/HandlerMessage.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
final class HandlerMessage
{
    //@codingStandardsIgnoreStart
    public const SEND_ADMIN_EMAIL_MESSAGE_CHECK =
        PHP_EOL . '[%s] Error occured when sending Admin Email of transaction Id %s. No admin emails has been defined' . PHP_EOL;
    public const SEND_ADMIN_EMAIL_MESSAGE_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting send Admin Email of transaction Id %s to %s' . PHP_EOL;
    public const SEND_ADMIN_EMAIL_MESSAGE_AFTER_PAYMENT =
        PHP_EOL . '[%s] Sending Admin Email of transaction Id %s to %s has been sent successfully' . PHP_EOL;
    public const SEND_ADMIN_SMS_MESSAGE_CHECK =
        PHP_EOL . '[%s] Error occured when sending Admin SMS of transaction Id %s. No admin phones has been defined' . PHP_EOL;
    public const SEND_ADMIN_SMS_MESSAGE_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting send Admin SMS of transaction Id %s to %s' . PHP_EOL;
    public const SEND_ADMIN_SMS_MESSAGE_AFTER_PAYMENT =
        PHP_EOL . '[%s] Sending Admin SMS of transaction Id %s to %s has been sent successfully' . PHP_EOL;
    public const SEND_CLIENT_EMAIL_MESSAGE_CHECK =
        PHP_EOL . '[%s] Error occured when sending Client Email of transaction Id %s. No email has been defined' . PHP_EOL;
    public const SEND_CLIENT_EMAIL_MESSAGE_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting send Client Email of transaction Id %s to %s' . PHP_EOL;
    public const SEND_CLIENT_EMAIL_MESSAGE_AFTER_PAYMENT =
        PHP_EOL . '[%s] Sending Client Email of transaction Id %s to %s has been sent successfully' . PHP_EOL;
    public const SEND_CLIENT_SMS_MESSAGE_CHECK =
        PHP_EOL . '[%s] Error occured when sending Client SMS of transaction Id %s. No phone has been defined' . PHP_EOL;
    public const SEND_CLIENT_SMS_MESSAGE_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting send Client SMS of transaction Id %s to %s' . PHP_EOL;
    public const SEND_CLIENT_SMS_MESSAGE_AFTER_PAYMENT =
        PHP_EOL . '[%s] Sending Client SMS of transaction Id %s to %s has been sent successfully' . PHP_EOL;
    public const SET_BALANCE_CHECK =
        PHP_EOL . '[%s] Error occured when getting balance after transaction Id %s. No provider balance' . PHP_EOL;
    public const SET_BALANCE_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting get balance after transaction Id %s' . PHP_EOL;
    public const SET_BALANCE_AFTER_PAYMENT =
        PHP_EOL . '[%s] Getting balance successfully. Balance = %s' . PHP_EOL;
    public const UPDATE_PROVIDER_DATA_CHECK =
        PHP_EOL . '[%s] Error occured when updating provider data %s after transaction Id %s. No Data' . PHP_EOL;
    public const UPDATE_PROVIDER_DATA_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting update provider data %s after transaction Id %s' . PHP_EOL;
    public const UPDATE_PROVIDER_DATA_AFTER_PAYMENT =
        PHP_EOL . '[%s] Updating provider data %s after transaction Id %s has been processed successfully' . PHP_EOL;
    public const UPDATE_PROVIDER_ID_CHECK =
        PHP_EOL . '[%s] Error occured when updating provider Id after transaction Id %s. No provider Id' . PHP_EOL;
    public const UPDATE_PROVIDER_ID_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting update provider Id %s after transaction Id %s' . PHP_EOL;
    public const UPDATE_PROVIDER_ID_AFTER_PAYMENT =
        PHP_EOL . '[%s] Updating provider Id %s after transaction Id %s has been processed successfully' . PHP_EOL;
    public const UPDATE_REFERENCE_STATUS_CHECK_REFERENCE =
        PHP_EOL . '[%s] Error occured when updating reference with status. No reference provided' . PHP_EOL;
    public const UPDATE_REFERENCE_STATUS_CHECK_STATUS =
        PHP_EOL . '[%s] Error occured when updating reference %s with status. No status provided' . PHP_EOL;
    public const UPDATE_REFERENCE_STATUS_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting update reference %s with status %s' . PHP_EOL;
    public const UPDATE_REFERENCE_STATUS_AFTER_PAYMENT =
        PHP_EOL . '[%s] Updating reference %s with status %s has been processed successfully' . PHP_EOL;
    public const CALLBACK_CHECK =
        PHP_EOL . '[%s] Error occured when sending callback notification message. Callback was not defined for transaction Id %s' . PHP_EOL;
    public const CALLBACK_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting send callback notification message for transaction %s to %s' . PHP_EOL;
    public const CALLBACK_AFTER_PAYMENT =
        PHP_EOL . '[%s] Sending callback notification message for transaction %s to %s has processed successfully' . PHP_EOL;
    public const UPDATE_STATUS_CHECK =
        PHP_EOL . '[%s] Error occured when updating status of transaction %s. Status is not defined' . PHP_EOL;
    public const UPDATE_STATUS_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting update status %s of transaction %s' . PHP_EOL;
    public const UPDATE_STATUS_AFTER_PAYMENT =
        PHP_EOL . '[%s] Updating status %s of transaction %s has processed successfully' . PHP_EOL;
    public const LOGGING_BEFORE_PAYMENT =
        PHP_EOL . '[%s] Starting log message %s' . PHP_EOL;
    public const LOGGING_AFTER_PAYMENT =
        PHP_EOL . '[%s] Logging message %s has been processed successfully' . PHP_EOL;
    //@codingStandardsIgnoreEnd
}
