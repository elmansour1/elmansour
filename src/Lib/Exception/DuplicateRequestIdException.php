<?php

/**
 * PHP Version 8.1
 * DuplicateRequestIdException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/DuplicateRequestIdException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * DuplicateRequestIdException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/DuplicateRequestIdException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class DuplicateRequestIdException extends PaymentException
{
    /**
     * Constructor.
     *
     * @param string|null $requestId requestId
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(string $requestId = null)
    {
        parent::__construct(
            [
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_REQUEST_ID[
                    AppConstants::CODE
                ],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_REQUEST_ID[
                    AppConstants::MESSAGE
                ],
                $requestId ?? ''
            ),
            ]
        );
    }
}
