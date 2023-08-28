<?php

/**
 * PHP Version 8.1
 * LoggingService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/LoggingService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

/**
 * LoggingService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/LoggingService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface LoggingService
{
    /**
     * LogTxt.
     *
     * @param string $title   title
     * @param string $message message
     * @param string $level   level
     *
     * @return void
     */
    public function logTxt(string $title, string $message, string $level): void;

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
    public function logArray(string $title, string $template, array $data, string $level): void;

    /**
     * Log.
     *
     * @param string $title   title
     * @param string $message message
     * @param string $level   level
     *
     * @return void
     */
    public function log(string $title, string $message, string $level): void;
}
