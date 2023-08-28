<?php

/**
 * PHP Version 8.1
 * IllegalStatusConfirmException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/IllegalStatusConfirmException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * IllegalStatusConfirmException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/IllegalStatusConfirmException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class IllegalStatusConfirmException extends ConfirmException
{
    /**
     * Constructor
     *
     * @param int    $transactionId transactionId
     * @param string $status        status
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(int $transactionId, string $status)
    {
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::ILLEGAL_STATUS_CONFIRM_EXCEPTION[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE']
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::ILLEGAL_STATUS_CONFIRM_EXCEPTION[
                        AppConstants::MESSAGE
                    ],
                    $transactionId,
                    $status
                ),
            ]
        );
    }
}
