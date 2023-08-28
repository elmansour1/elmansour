<?php

/**
 * PHP Version 8.1
 * SendClientEmailMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/SendClientEmailMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\HandlerMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\NotificationService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\SendAdminEmailMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\SendClientEmailMessage;

/**
 * SendClientEmailMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/SendClientEmailMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class SendClientEmailMessageHandler
{
    protected NotificationService $notificationService;
    protected TransactionMapper $transactionMapper;

    /**
     * Constructor.
     *
     * @param NotificationService $notificationService notificationService
     * @param TransactionMapper   $transactionMapper   transactionMapper
     *
     * @return void
     */
    public function __construct(
        NotificationService $notificationService,
        TransactionMapper $transactionMapper
    ) {
        $this->notificationService = $notificationService;
        $this->transactionMapper = $transactionMapper;
    }

    /**
     * Invoke.
     *
     * @param SendClientEmailMessage $transaction transaction
     *
     * @return void
     */
    public function __invoke(SendClientEmailMessage $transaction)
    {
        if (!$transaction->email) {
            echo sprintf(
                HandlerMessage::SEND_CLIENT_EMAIL_MESSAGE_CHECK,
                $transaction->transactionId,
                $transaction->transactionId
            );

            return;
        }

        echo sprintf(
            HandlerMessage::SEND_CLIENT_EMAIL_MESSAGE_BEFORE_PAYMENT,
            $transaction->transactionId,
            $transaction->transactionId,
            $transaction->email,
        );

        $this->notificationService->sendClientEmail($this->transactionMapper->asEntity($transaction));

        echo sprintf(
            HandlerMessage::SEND_CLIENT_EMAIL_MESSAGE_AFTER_PAYMENT,
            $transaction->transactionId,
            $transaction->transactionId,
            $transaction->email,
        );
    }
}
