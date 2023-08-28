<?php

/**
 * PHP Version 8.1
 * InvalidAmountOptionException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/InvalidAmountOptionException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * InvalidAmountOptionException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/InvalidAmountOptionException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class InvalidAmountOptionException extends VerifyException
{
    /**
     * Constructor.
     *
     * @param string $option option
     * @param float  $amount amount
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(string $option, float $amount)
    {
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::VERIFY_INVALID_OPTION_AMOUNT_VALUE[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE']
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::VERIFY_INVALID_OPTION_AMOUNT_VALUE[
                        AppConstants::MESSAGE
                    ],
                    $option,
                    $amount
                ),
            ]
        );
    }
}
