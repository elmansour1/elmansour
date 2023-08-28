<?php

/**
 * PHP Version 8.1
 * OptionApiDisabledException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/OptionApiDisabledException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * OptionApiDisabledException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/OptionApiDisabledException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class OptionApiDisabledException extends OptionException
{
    /**
     * Constructor.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct()
    {
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::OPTION_API_DISABLED[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE']
                ),
                AppConstants::MESSAGE => SystemExceptionMessage::OPTION_API_DISABLED[
                    AppConstants::MESSAGE
                ],
            ]
        );
    }
}
