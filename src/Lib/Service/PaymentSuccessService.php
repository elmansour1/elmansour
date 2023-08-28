<?php

/**
 * PHP Version 8.1
 * PaymentSuccessService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/PaymentSuccessService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentApplicationException;

/**
 * PHP Version 8.1
 * PaymentSuccessService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/PaymentSuccessService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface PaymentSuccessService
{
    /**
     * Success.
     *
     * @param Transaction             $transactionOp transactionOp
     * @param ProviderPaymentResponse $response      response
     *
     * @return Transaction
     *
     * @throws PaymentApplicationException
     */
    public function success(
        Transaction $transactionOp,
        ProviderPaymentResponse $response
    ): Transaction;

    /**
     * VerifyAfterPayment.
     *
     * @param Transaction             $transaction transaction
     * @param ProviderPaymentResponse $response    response
     *
     * @throws PaymentApplicationException
     *
     * @return void
     */
    public function verifyAfterPayment(
        Transaction $transaction,
        ProviderPaymentResponse $response
    ): void;

    /**
     * Decision.
     *
     * @param Transaction             $transaction transaction
     * @param ProviderPaymentResponse $response    response
     *
     * @throws PaymentApplicationException
     *
     * @return void
     */
    public function decision(Transaction $transaction, ProviderPaymentResponse $response): void;

    /**
     * SetBalance.
     *
     * @param Transaction $transactionOp transactionOp
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setBalance(Transaction $transaction): Transaction;

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
    public function setBalanceAfterPayment(Transaction $transaction): float;
}
