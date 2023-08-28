<?php

/**
 * PHP Version 8.1
 * UpdateProviderIdMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/UpdateProviderIdMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\HandlerMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\UpdateProviderIdMessage;

/**
 * UpdateProviderIdMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/UpdateProviderIdMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class UpdateProviderIdMessageHandler
{
    protected TransactionService $transactionService;

    /**
     * Constructor.
     *
     * @param TransactionService $transactionService
     *
     * @return void
     */
    public function __construct(
        TransactionService $transactionService
    ) {
        $this->transactionService = $transactionService;
    }

    /**
     * Invoke.
     *
     * @param UpdateProviderIdMessage $transaction transaction
     *
     * @return void
     */
    public function __invoke(UpdateProviderIdMessage $transaction)
    {
        if (!isset($transaction->providerId) || !$transaction->providerId) {
            echo sprintf(
                HandlerMessage::UPDATE_PROVIDER_ID_CHECK,
                $transaction->transactionId,
                $transaction->transactionId
            );

            return;
        }

        echo sprintf(
            HandlerMessage::UPDATE_PROVIDER_ID_BEFORE_PAYMENT,
            $transaction->transactionId,
            $transaction->providerId,
            $transaction->transactionId
        );

        $result = $this->transactionService->updateProviderId(
            $transaction->id,
            $transaction->providerId
        );

        echo sprintf(
            HandlerMessage::UPDATE_PROVIDER_ID_AFTER_PAYMENT,
            $transaction->transactionId,
            $result->providerId,
            $result->transactionId
        );
    }
}
