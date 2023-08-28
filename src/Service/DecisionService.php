<?php

/**
 * PHP Version 8.1
 * DecisionService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/DecisionService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentResponseConvertException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\RequiredProviderIdException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\NotificationService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentSuccessService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentProcessService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\DecisionService as BaseDecisionService;

/**
 * PHP Version 8.1
 * DecisionService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/DecisionService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class DecisionService implements BaseDecisionService
{
    protected NotificationService $notificationService;
    protected PaymentSuccessService $paySucService;
    protected PaymentProcessService $payProcService;
    protected TransactionService $transactionService;

    /**
     * Constructor.
     *
     * @param NotificationService   $notificationService notificationService
     * @param PaymentSuccessService $paySucService       paySucService
     * @param PaymentProcessService $payProcService      payProcService
     * @param TransactionService    $transactionService  transactionService
     *
     * @return void
     */
    public function __construct(
        NotificationService $notificationService,
        PaymentSuccessService $paySucService,
        PaymentProcessService $payProcService,
        TransactionService $transactionService
    ) {
        $this->notificationService = $notificationService;
        $this->paySucService = $paySucService;
        $this->payProcService = $payProcService;
        $this->transactionService = $transactionService;
    }

    /**
     * Process.
     *
     * @param ProviderPaymentResponse $providerResponse providerResponse
     * @param Transaction|null        $transaction      transaction
     *
     * @return Transaction
     *
     * @throws PaymentAPIException|LogicNotImplementedException
     */
    public function process(
        ProviderPaymentResponse $providerResponse,
        ?Transaction $transaction = null
    ): Transaction {
        $this->payProcService->decision($providerResponse);

        $transactionOp = $transaction;

        if (!$transactionOp) {
            if (!$providerResponse->providerId) {
                throw new RequiredProviderIdException();
            }
            $transactionOp = $this->transactionService->findOneByProviderId($providerResponse->providerId);
        }

        $transactionOp = $this->paySucService->success($transactionOp, $providerResponse);

        $this->notificationService->notification($transactionOp);

        return $transactionOp;
    }
}
