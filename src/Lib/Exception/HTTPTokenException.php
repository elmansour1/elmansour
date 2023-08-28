<?php

/**
 * PHP Version 8.1
 * HTTPTokenException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/HTTPTokenException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * HTTPTokenException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/HTTPTokenException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class HTTPTokenException extends GeneralException
{
    /**
     * Constructor.
     *
     * @param string      $api     api
     * @param string|null $message message
     * @param int|null    $code    code
     *
     * @return void
     */
    public function __construct(
        string $api,
        string $message = null,
        int $code = null
    ) {
        $text = sprintf(
            SystemExceptionMessage::HTTP_TOKEN_FAILURE[
                AppConstants::MESSAGE
            ],
            $api
        );

        $exceptionDetail = [
            AppConstants::CODE => SystemExceptionMessage::HTTP_TOKEN_FAILURE[
                AppConstants::CODE
            ],
            AppConstants::MESSAGE => $text,
        ];

        parent::__construct($exceptionDetail, $message, $code);
    }
}
