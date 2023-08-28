<?php

/**
 * PHP Version 8.1
 * LogMessage.
 *
 * @category Message
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/Message/LogMessage.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message;

/**
 * LogMessage.
 *
 * @category Message
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/Message/LogMessage.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class LogMessage
{
    public ?string $title = null;
    public ?string $message = null;
    public ?string $level = null;

    /**
     * Constructor.
     *
     * @param string $title   title
     * @param string $message message
     * @param string $level   level
     *
     *                        return void
     */
    public function __construct(string $title, string $message, string $level)
    {
        $this->title = $title;
        $this->message = $message;
        $this->level = $level;
    }
}
