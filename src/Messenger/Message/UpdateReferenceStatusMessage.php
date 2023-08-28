<?php

/**
 * PHP Version 8.1
 * UpdateReferenceStatusMessage.
 *
 * @category Message
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/Message/UpdateReferenceStatusMessage.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * UpdateReferenceStatusMessage.
 *
 * @category Message
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/Message/UpdateReferenceStatusMessage.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class UpdateReferenceStatusMessage
{
    public ?string $reference = null;
    public ?Status $status = null;

    /**
     * Constructor.
     *
     * @param string $reference reference
     * @param Status $status    status
     *
     *                          return void
     */
    public function __construct(string $reference, Status $status)
    {
        $this->reference = $reference;
        $this->status = $status;
    }
}
