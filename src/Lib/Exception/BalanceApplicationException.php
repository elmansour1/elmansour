<?php

/**
 * PHP Version 8.1
 * BalanceApplicationException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/BalanceApplicationException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * BalanceApplicationException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/BalanceApplicationException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class BalanceApplicationException extends PaymentException
{
    /**
     * Constructor.
     *
     * @param string $errorCode errorCode
     * @param string $message   message
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(string $errorCode, string $message)
    {
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::BALANCE_APPLICATION_ERROR[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE'],
                    $errorCode
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::BALANCE_APPLICATION_ERROR[
                        AppConstants::MESSAGE
                    ],
                    $message
                ),
            ]
        );
    }
}
