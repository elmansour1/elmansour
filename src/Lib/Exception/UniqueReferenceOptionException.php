<?php

/**
 * PHP Version 8.1
 * UniqueReferenceOptionException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/UniqueReferenceOptionException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * UniqueReferenceOptionException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/UniqueReferenceOptionException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class UniqueReferenceOptionException extends PaymentException
{
    /**
     * Constructor.
     *
     * @param string      $reference reference
     * @param string|null $option    option
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(string $reference, ?string $option = null)
    {
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::UNIQUE_REFERENCE_OPTION_EXCEPTION[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE']
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::UNIQUE_REFERENCE_OPTION_EXCEPTION[
                        AppConstants::MESSAGE
                    ],
                    $reference,
                    $option ?? ''
                )
            ]
        );
    }
}
