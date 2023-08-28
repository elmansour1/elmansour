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
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadProviderResponseException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentResponseConvertException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\RequiredProviderIdException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\NotificationService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentSuccessService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentProcessService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentFailedService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentErrorService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\CallbackService as BaseCallbackService;
use Symfony\Component\HttpFoundation\Request;

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
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CallbackService implements BaseCallbackService
{
    protected NotificationService $notificationService;
    protected PaymentSuccessService $paySucService;
    protected PaymentProcessService $payProcService;
    protected TransactionService $transactionService;
    protected PaymentFailedService $paymentFailedService;
    protected PaymentErrorService $paymentErrorService;

    /**
     * Constructor.
     *
     * @param NotificationService   $notificationService  notificationService
     * @param PaymentSuccessService $paySucService        paySucService
     * @param PaymentProcessService $payProcService       payProcService
     * @param TransactionService    $transactionService   transactionService
     * @param PaymentFailedService  $paymentFailedService paymentFailedService
     * @param PaymentErrorService   $paymentErrorService  paymentErrorService
     *
     * @return void
     */
    public function __construct(
        NotificationService $notificationService,
        PaymentSuccessService $paySucService,
        PaymentProcessService $payProcService,
        TransactionService $transactionService,
        PaymentFailedService $paymentFailedService,
        PaymentErrorService $paymentErrorService
    ) {
        $this->notificationService = $notificationService;
        $this->paySucService = $paySucService;
        $this->payProcService = $payProcService;
        $this->transactionService = $transactionService;
        $this->paymentFailedService = $paymentFailedService;
        $this->paymentErrorService = $paymentErrorService;
    }

    /**
     * Execute.
     *
     * @param Request $request request
     *
     * @return Transaction
     *
     * @throws PaymentAPIException
     */
    public function execute(Request $request): Transaction
    {
        $response = [];
        $response[AppConstants::BODY] = json_decode($request->getContent(), true);
        $response[AppConstants::HEADERS] = $request->headers->all();

        return $this->payProcService->process($this, $response);
    }


    /**
     * GenerateProviderResponse.
     *
     * @param array|null $apiResponse apiResponse
     *
     * @return ProviderResponse
     *
     * @throws LogicNotImplementedException
     */
    public function generateProviderResponse(?array $apiResponse): ProviderResponse
    {
        throw new LogicNotImplementedException(__FUNCTION__);
    }

    /**
     * Decision.
     *
     * @param ProviderPaymentResponse $providerResponse providerResponse
     *
     * @return void
     *
     * @throws PaymentAPIException|LogicNotImplementedException
     */
    public function decision(ProviderPaymentResponse $providerResponse): void
    {
        throw new LogicNotImplementedException(__FUNCTION__);
    }
}
