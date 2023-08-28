<?php

/**
 * PHP Version 8.1
 * PaymentFailedService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/PaymentFailedService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentFailedService as PayFS;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\UpdateStatusMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\FullTransactionMapper;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * PaymentFailedService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/PaymentFailedService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class PaymentFailedService implements PayFS
{
    protected TransactionService $transactionService;
    protected MessageBusInterface $bus;
    protected FullTransactionMapper $fullTransactionMapper;

    /**
     * Constructor.
     *
     * @param TransactionService    $transactionService    transactionService
     * @param MessageBusInterface   $bus                   bus
     * @param FullTransactionMapper $fullTransactionMapper fullTransactionMapper
     *
     * @return void
     */
    public function __construct(
        TransactionService $transactionService,
        MessageBusInterface $bus,
        FullTransactionMapper $fullTransactionMapper
    ) {
        $this->transactionService = $transactionService;
        $this->bus = $bus;
        $this->fullTransactionMapper = $fullTransactionMapper;
    }

    /**
     * Failed.
     *
     * @param Transaction $transaction transaction
     *
     * @return Transaction
     */
    public function failed(Transaction $transaction): Transaction
    {
        $transactionOp = $transaction;

        $transactionOp->status = Status::FAILED;

        $this->updateToFailed($transactionOp);

        return $transactionOp;
    }

    /**
     * UpdateToFailed.
     *
     * @param Transaction $transaction transactionOp
     *
     * @return void
     */
    protected function updateToFailed(Transaction $transaction): void
    {
        $this->bus->dispatch(
            new UpdateStatusMessage(
                $this->fullTransactionMapper->asDTO($transaction)
            )
        );
    }
}
