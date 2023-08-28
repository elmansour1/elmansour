<?php

/**
 * PHP Version 8.1
 * ApplicationExceptionMessage.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ApplicationExceptionMessage.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model;

/**
 * ApplicationExceptionMessage.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ApplicationExceptionMessage.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
final class ApplicationExceptionMessage
{
    public const ILLEGAL_TRANSACTION_STATUS = [
        AppConstants::CODE => '001',
        AppConstants::MESSAGE =>
            'Illegal transaction status %s. The status must be PROGRESS or PENDING',
    ];
    public const TRANSACTION_ID_MISMATCH = [
        AppConstants::CODE => '002',
        AppConstants::MESSAGE =>
            'Transaction Id in adapter side %s and Provider side %s are mismatched',
    ];

    // @codingStandardsIgnoreStart
    public const TRANSACTION_REFERENCE_MISMATCH = [
        AppConstants::CODE => '003',
        AppConstants::MESSAGE =>
            'Transaction Reference in adapter side %s and Provider side %s are mismatched',
    ];
    // @codingStandardsIgnoreEnd'

    public const PARAM_BALANCE_NOT_FOUND = [
        AppConstants::CODE => '004',
        AppConstants::MESSAGE =>
            'Parameter balance not found. Check configuration',
    ];
}
