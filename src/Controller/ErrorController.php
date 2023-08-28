<?php

/**
 * PHP Version 8.1
 * ErrorController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/ErrorController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Controller;

use Doctrine\DBAL\Exception\ConnectionException;
use FOS\RestBundle\Controller\Annotations\Route;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller\ErrorController as ErCtrl;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ErrorResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\GeneralException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

/**
 * ErrorController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/ErrorController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
#[Route('/error')]
class ErrorController extends AbstractController implements ErCtrl
{
    /**
     * Error.
     *
     * @param \Throwable                $exception exception
     * @param DebugLoggerInterface|null $logger    logger
     *
     * @return ErrorResponse
     *
     * @throws \Throwable
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @SuppressWarnings(PHPMD.ElseExpression)
     *
     * @psalm-suppress PossiblyUndefinedArrayOffset
     */
    #[Route]
    public function error(
        \Throwable $exception,
        ?DebugLoggerInterface $logger = null
    ): ErrorResponse {
        $code = $message = null;

        if ($exception instanceof GeneralException) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
        } elseif ($exception instanceof ConnectionException) {
            $code = SystemExceptionMessage::DATABASE_CONNECTIVITY_FAILURE[
                AppConstants::CODE
            ];
            $message = sprintf(
                SystemExceptionMessage::DATABASE_CONNECTIVITY_FAILURE[
                    AppConstants::MESSAGE
                ]
            );
        } elseif ($exception instanceof NotFoundHttpException) {
            $code = SystemExceptionMessage::URI_NOT_FOUND[AppConstants::CODE];
            $message = $exception->getMessage();
        } else {
            if (AppConstants::ENV_DEV == $_ENV['APP_ENV']) {
                throw $exception;
            }
            $code = SystemExceptionMessage::GENERAL_FAILURE[AppConstants::CODE];
            $messageTxt = SystemExceptionMessage::GENERAL_FAILURE[
                AppConstants::MESSAGE
            ];
            $separator = AppConstants::SEPARATOR_MESSAGE;
            $tryAgain = AppConstants::SEPARATOR_MESSAGE;
            $message = sprintf($messageTxt, "$separator $tryAgain");
        }

        return new ErrorResponse((int)$code, $message);
    }
}
