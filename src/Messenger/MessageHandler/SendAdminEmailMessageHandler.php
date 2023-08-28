<?php

/**
 * PHP Version 8.1
 * SendAdminEmailMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/SendAdminEmailMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\HandlerMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\NotificationService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\SendAdminEmailMessage;

/**
 * SendAdminEmailMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/SendAdminEmailMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.Superglobals)
 */
class SendAdminEmailMessageHandler
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
     * @param SendAdminEmailMessage $transaction transaction
     *
     * @return void
     */
    public function __invoke(SendAdminEmailMessage $transaction)
    {
        if (!$_ENV['ADMIN_EMAILS']) {
            echo sprintf(
                HandlerMessage::SEND_ADMIN_EMAIL_MESSAGE_CHECK,
                $transaction->transactionId,
                $transaction->transactionId
            );

            return;
        }

        echo sprintf(
            HandlerMessage::SEND_ADMIN_EMAIL_MESSAGE_BEFORE_PAYMENT,
            $transaction->transactionId,
            $transaction->transactionId,
            $_ENV['ADMIN_EMAILS']
        );

        $this->notificationService->sendAdminEmail($this->transactionMapper->asEntity($transaction));

        echo sprintf(
            HandlerMessage::SEND_ADMIN_EMAIL_MESSAGE_AFTER_PAYMENT,
            $transaction->transactionId,
            $transaction->transactionId,
            $_ENV['ADMIN_EMAILS']
        );
    }
}
