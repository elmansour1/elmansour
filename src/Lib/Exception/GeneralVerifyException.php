<?php

/**
 * PHP Version 8.1
 * GeneralVerifyException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/GeneralVerifyException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * GeneralVerifyException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/GeneralVerifyException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class GeneralVerifyException extends VerifyException
{
    /**
     * Constructor.
     *
     * @param string|null $message message
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(string $message = null)
    {
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::VERIFY_GENERAL_FAILURE[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE']
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::VERIFY_GENERAL_FAILURE[
                        AppConstants::MESSAGE
                    ],
                    $message ?? ''
                ),
            ]
        );
    }
}
