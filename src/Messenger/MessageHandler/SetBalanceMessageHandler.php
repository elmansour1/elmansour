<?php

/**
 * PHP Version 8.1
 * SetBalanceMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/SetBalanceMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\HandlerMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\SetBalanceMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\BalanceService;

/**
 * UpdateProviderIdMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/SetBalanceMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class SetBalanceMessageHandler
{
    protected BalanceService $balanceService;
    protected TransactionMapper $transactionMapper;

    /**
     * Constructor.
     *
     * @param BalanceService    $balanceService    balanceService
     * @param TransactionMapper $transactionMapper transactionMapper
     *
     * @return void
     */
    public function __construct(BalanceService $balanceService, TransactionMapper $transactionMapper)
    {
        $this->balanceService = $balanceService;
        $this->transactionMapper = $transactionMapper;
    }

    /**
     * Invoke.
     *
     * @param SetBalanceMessage $transaction transaction
     *
     * @return void
     */
    public function __invoke(SetBalanceMessage $transaction)
    {
        if (!isset($transaction->providerBalance) || !$transaction->providerBalance) {
            echo sprintf(
                HandlerMessage::SET_BALANCE_CHECK,
                $transaction->transactionId,
                $transaction->transactionId
            );

            return;
        }

        echo sprintf(
            HandlerMessage::SET_BALANCE_BEFORE_PAYMENT,
            $transaction->transactionId,
            $transaction->transactionId
        );

        $result = $this->transactionMapper->asEntity($transaction);

        $this->balanceService->setBalance($result->providerBalance);

        echo sprintf(
            HandlerMessage::SET_BALANCE_AFTER_PAYMENT,
            $transaction->transactionId,
            $transaction->providerBalance
        );
    }
}
