<?php

/**
 * PHP Version 8.1
 * CallbackService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/CallbackService.php
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
use Symfony\Component\HttpFoundation\Request;

/**
 * CallbackService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/CallbackService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface CallbackService extends ApiProcessService
{
    /**
     * Execute.
     *
     * @param Request $request request
     *
     * @return Transaction
     *
     * @throws PaymentAPIException
     */
    public function execute(Request $request): Transaction;
}
