<?php

/**
 * PHP Version 8.1
 * PaymentSuccessService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/PaymentSuccessService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse as BasePrR;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentApplicationException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\ApplicationExceptionMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentSuccessService as SucS;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\FullTransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\SetBalanceMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\UpdateReferenceStatusMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\UpdateStatusMessage;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * PaymentSuccessService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/PaymentSuccessService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.Superglobals)
 */
class PaymentSuccessService implements SucS
{
    protected TransactionService $transactionService;
    protected ReferenceService $referenceService;
    protected MessageBusInterface $bus;
    protected FullTransactionMapper $fullTransactionMapper;

    /**
     * Constructor.
     *
     * @param TransactionService    $transactionService    transactionService
     * @param ReferenceService      $referenceService      referenceService
     * @param MessageBusInterface   $bus                   bus
     * @param FullTransactionMapper $fullTransactionMapper fullTransactionMapper
     *
     * @return void
     */
    public function __construct(
        TransactionService $transactionService,
        ReferenceService $referenceService,
        MessageBusInterface $bus,
        FullTransactionMapper $fullTransactionMapper
    ) {
        $this->transactionService = $transactionService;
        $this->referenceService = $referenceService;
        $this->bus = $bus;
        $this->fullTransactionMapper = $fullTransactionMapper;
    }

    /**
     * Success.
     *
     * @param Transaction $transactionOp transactionOp
     * @param BasePrR     $response      response
     *
     * @return Transaction
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress MixedAssignment
     */
    public function success(
        Transaction $transactionOp,
        BasePrR $response
    ): Transaction {
        $transaction = $transactionOp;

        $transaction->status = Status::SUCCESS;
        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['MANUAL_MODE']) {
            $transaction->status = Status::PROGRESS;
        }

        if (isset($transaction->referenceData) && $transaction->referenceData) {
            $transaction->referenceData->status = $transaction->status;
        }

        $this->updateTransaction($transaction);

        return $transaction;
    }

    /**
     * SetBalance.
     *
     * @param Transaction $transactionOp transactionOp
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setBalance(Transaction $transactionOp): Transaction
    {
        $transaction = $transactionOp;

        try {
            $condition = AppConstants::PARAMETER_TRUE_VALUE ==
                $_ENV['SET_BALANCE_AFTER_PAYMENT'];

            if ($condition) {
                $transaction->providerBalance = $this->setBalanceAfterPayment($transaction);
                $this->bus->dispatch(
                    new SetBalanceMessage(
                        $this->fullTransactionMapper->asDTO($transaction)
                    )
                );
            }
        } catch (\Throwable $throwable) {
            //Send Alert
        }

        return $transaction;
    }

    /**
     * Decision.
     *
     * @param Transaction $transaction transaction
     * @param BasePrR     $response    response
     *
     * @throws PaymentApplicationException
     *
     * @return void
     */
    public function decision(Transaction $transaction, $response): void
    {
        $condition = Status::PROGRESS != $transaction->status &&
            Status::PENDING != $transaction->status;

        if ($condition) {
            throw new PaymentApplicationException(
                ApplicationExceptionMessage::ILLEGAL_TRANSACTION_STATUS[
                AppConstants::CODE
                ],
                sprintf(
                    ApplicationExceptionMessage::ILLEGAL_TRANSACTION_STATUS[
                    AppConstants::MESSAGE
                    ],
                    $transaction->status->value
                )
            );
        }

        $this->verifyAfterPayment($transaction, $response);
    }

    /**
     * UpdateTransaction.
     *
     * @param Transaction $transactionOp transactionOp
     *
     * @return void
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress MixedAssignment
     */
    protected function updateTransaction(Transaction $transactionOp): void
    {
        $transaction = $transactionOp;

        $this->bus->dispatch(
            new UpdateStatusMessage(
                $this->fullTransactionMapper->asDTO($transaction)
            )
        );

        try {
            if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['REFERENCE_API_ENABLED']) {
                $this->bus->dispatch(
                    new UpdateReferenceStatusMessage(
                        $transaction->reference,
                        $transaction->status
                    )
                );
            }
        } catch (\Throwable $throwable) {
            //Send alert
        }
    }

    /**
     * VerifyAfterPayment.
     *
     * @param Transaction $transaction transaction
     * @param BasePrR     $response    response
     *
     * @throws PaymentApplicationException
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function verifyAfterPayment(
        Transaction $transaction,
        BasePrR $response
    ): void {
        return;
    }

    /**
     * SetBalanceAfterPayment.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     *
     * @throws LogicNotImplementedException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setBalanceAfterPayment(Transaction $transaction): float
    {
        throw new LogicNotImplementedException(__FUNCTION__);
    }
}
