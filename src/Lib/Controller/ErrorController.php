<?php

/**
 * PHP Version 8.1
 * ErrorController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/ErrorController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ErrorResponse;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

/**
 * ErrorController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/ErrorController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface ErrorController
{
    /**
     * Error API.
     *
     * @param \Throwable                $exception exception
     * @param DebugLoggerInterface|null $logger    logger
     *
     * @return ErrorResponse
     *
     * @throws \Throwable
     */
    public function error(
        \Throwable $exception,
        ?DebugLoggerInterface $logger = null
    ): ErrorResponse;
}
