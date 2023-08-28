<?php

/**
 * PHP Version 8.1
 * VerifyApplicationException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/VerifyApplicationException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * VerifyApplicationException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/VerifyApplicationException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class VerifyApplicationException extends VerifyException
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
                    SystemExceptionMessage::VERIFY_API_ERROR[AppConstants::CODE],
                    $_ENV['APP_CODE'],
                    $errorCode
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::VERIFY_API_ERROR[AppConstants::MESSAGE],
                    $message
                ),
            ]
        );
    }
}
