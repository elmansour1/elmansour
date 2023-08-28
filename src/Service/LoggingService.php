<?php

/**
 * PHP Version 8.1
 * LoggingService
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/LoggingService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\LogMessage;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Messenger\MessageBusInterface;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\LoggingService as BaseLoggingService;

/**
 * LoggingService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/LoggingService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class LoggingService implements BaseLoggingService
{
    protected LoggerInterface $logger;
    protected MessageBusInterface $bus;

    /**
     * Constructor.
     *
     * @param LoggerInterface     $logger logger
     * @param MessageBusInterface $bus    bus
     *
     * @return void
     */
    public function __construct(
        LoggerInterface $logger,
        MessageBusInterface $bus,
    ) {
        $this->logger = $logger;
        $this->bus = $bus;
    }

    /**
     * LogTxt.
     *
     * @param string $title   title
     * @param string $message message
     * @param string $level   level
     *
     * @return void
     */
    public function logTxt(string $title, string $message, string $level): void
    {
        $this->bus->dispatch(new LogMessage($title, $message, $level));
    }

    /**
     * LogArray.
     *
     * @param string $title   title
     * @param string $message message
     * @param array  $data    data
     * @param string $level   level
     *
     * @return void
     */
    public function logArray(string $title, string $template, array $data, string $level): void
    {
        $message = sprintf($template, ...$data);
        $this->logTxt($title, $message, $level);
    }

    /**
     * Log.
     *
     * @param string $title   title
     * @param string $message message
     * @param string $level   level
     *
     * @return void
     */
    public function log(string $title, string $message, string $level): void
    {
        $text = sprintf(
            '[%s] %s',
            $title,
            $message
        );
        $this->logger->log($level, $text);
    }
}
