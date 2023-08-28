<?php

/**
 * PHP Version 8.1
 * InvalidOptionException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/InvalidOptionException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * InvalidOptionException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/InvalidOptionException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class InvalidOptionException extends VerifyException
{
    /**
     * Constructor.
     *
     * @param string|null $option option
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(?string $option = null)
    {
        $optionTxt = $option ?? '';
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::VERIFY_INVALID_OPTION_VALUE[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE']
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::VERIFY_INVALID_OPTION_VALUE[
                        AppConstants::MESSAGE
                    ],
                    $optionTxt
                ),
            ]
        );
    }
}
