<?php

/**
 * PHP Version 8.1
 * DecisionService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/DecisionService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentResponseConvertException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse;

/**
 * DecisionService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/DecisionService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface DecisionService
{
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
    ): Transaction;
}
