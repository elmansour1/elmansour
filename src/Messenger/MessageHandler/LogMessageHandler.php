<?php

/**
 * PHP Version 8.1
 * LogMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/LogMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\HandlerMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\LoggingService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\LogMessage;

/**
 * LogMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/LogMessageHandler/UpdateProviderIdMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class LogMessageHandler
{
    protected LoggingService $loggingService;

    /**
     * Constructor.
     *
     * @param LoggingService $loggingService
     *
     * @return void
     */
    public function __construct(LoggingService $loggingService)
    {
        $this->loggingService = $loggingService;
    }

    /**
     * Invoke.
     *
     * @param LogMessage $logMessage logMessage
     *
     * @return void
     */
    public function __invoke(LogMessage $logMessage)
    {
        echo sprintf(
            HandlerMessage::LOGGING_BEFORE_PAYMENT,
            $logMessage->title,
            $logMessage->message
        );

        $this->loggingService->log(
            $logMessage->title ?? '',
            $logMessage->message ?? '',
            $logMessage->level ?? '',
        );

        echo sprintf(
            HandlerMessage::LOGGING_BEFORE_PAYMENT,
            $logMessage->title,
            $logMessage->message
        );
    }
}
