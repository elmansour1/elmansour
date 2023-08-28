<?php

/**
 * PHP Version 8.1
 * UpdateProviderDataMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/UpdateProviderDataMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\FullTransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\HandlerMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\UpdateProviderDataMessage;

/**
 * UpdateProviderDataMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/UpdateProviderDataMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class UpdateProviderDataMessageHandler
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
     * @param UpdateProviderDataMessage $transaction transaction
     *
     * @return void
     */
    public function __invoke(UpdateProviderDataMessage $transaction)
    {
        echo sprintf(
            HandlerMessage::UPDATE_PROVIDER_DATA_BEFORE_PAYMENT,
            $transaction->transactionId,
            json_encode($transaction),
            $transaction->transactionId
        );

        $result = $this->transactionService->updateProviderData(
            $transaction->id,
            $this->fullTransactionMapper->asEntity($transaction)
        );

        echo sprintf(
            HandlerMessage::UPDATE_PROVIDER_DATA_AFTER_PAYMENT,
            $transaction->transactionId,
            json_encode($this->fullTransactionMapper->asDTO($result)),
            $result->transactionId
        );
    }
}
