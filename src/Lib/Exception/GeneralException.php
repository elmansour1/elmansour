<?php

/**
 * PHP Version 8.1
 * GeneralException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/GeneralException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;

/**
 * GeneralException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/GeneralException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
class GeneralException extends \RuntimeException implements \Throwable
{
    /**
     * Constructor.
     *
     * @param array       $exceptionDetail exceptionDetail
     * @param string|null $message         message
     * @param int|null    $code            code
     */
    public function __construct(
        array $exceptionDetail,
        string $message = null,
        int $code = null
    ) {
        $messageException = (string) (
            $message ?? $exceptionDetail[AppConstants::MESSAGE]
        );
        $codeException = (int) (
            $code ?? $exceptionDetail[AppConstants::CODE]
        );

        parent::__construct($messageException, $codeException);
    }

    /**
     * SetMessage.
     *
     * @param string $message message
     *
     * @return void
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
