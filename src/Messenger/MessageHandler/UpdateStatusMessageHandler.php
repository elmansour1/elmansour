<?php

/**
 * PHP Version 8.1
 * UpdateStatusMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/UpdateStatusMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\HandlerMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\FullTransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\UpdateStatusMessage;

/**
 * UpdateStatusMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/UpdateStatusMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class UpdateStatusMessageHandler
{
    protected TransactionService $transactionService;
    protected FullTransactionMapper $fullTransactionMapper;

    /**
     * Constructor.
     *
     * @param TransactionService    $transactionService    transactionService
     * @param FullTransactionMapper $fullTransactionMapper fullTransactionMapper
     *
     * @return void
     */
    public function __construct(
        TransactionService $transactionService,
        FullTransactionMapper $fullTransactionMapper
    ) {
        $this->transactionService = $transactionService;
        $this->fullTransactionMapper = $fullTransactionMapper;
    }

    /**
     * Invoke.
     *
     * @param UpdateStatusMessage $message message
     *
     * @return void
     */
    public function __invoke(UpdateStatusMessage $message)
    {
        if (!$message->status) {
            echo sprintf(
                HandlerMessage::UPDATE_STATUS_CHECK,
                $message->transactionId,
                $message->transactionId
            );

            return;
        }

        echo sprintf(
            HandlerMessage::UPDATE_STATUS_BEFORE_PAYMENT,
            $message->transactionId,
            $message->status,
            $message->transactionId
        );

        $transaction = $this->fullTransactionMapper->asEntity($message);

        $result = $this->transactionService->updateStatus(
            $transaction->id,
            $transaction->status
        );

        echo sprintf(
            HandlerMessage::UPDATE_STATUS_AFTER_PAYMENT,
            $transaction->transactionId,
            $result->status->value,
            $result->transactionId
        );
    }
}
