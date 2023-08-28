<?php

/**
 * PHP Version 8.1
 * IllegalProviderConfirmException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/IllegalProviderConfirmException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * IllegalProviderConfirmException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/IllegalProviderConfirmException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class IllegalProviderConfirmException extends ConfirmException
{
    /**
     * Constructor
     *
     * @param int    $transactionId transactionId
     * @param string $provider      provider
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(int $transactionId, string $provider)
    {
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::ILLEGAL_PROVIDER_CONFIRM_EXCEPTION[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE']
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::ILLEGAL_PROVIDER_CONFIRM_EXCEPTION[
                        AppConstants::MESSAGE
                    ],
                    $transactionId,
                    $provider
                ),
            ]
        );
    }
}
