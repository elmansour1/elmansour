<?php

/**
 * PHP Version 8.1
 * DuplicateApplicationIdException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/DuplicateApplicationIdException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * DuplicateApplicationIdException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/DuplicateApplicationIdException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class DuplicateApplicationIdException extends PaymentException
{
    /**
     * Constructor.
     *
     * @param string|null $applicationId applicationId
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(string $applicationId = null)
    {
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::PAYMENT_DUPLICATE_APPLICATION_ID[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE']
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::PAYMENT_DUPLICATE_APPLICATION_ID[
                        AppConstants::MESSAGE
                    ],
                    $applicationId ?? ''
                ),
            ]
        );
    }
}
