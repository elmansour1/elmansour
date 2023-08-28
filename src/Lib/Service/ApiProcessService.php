<?php

/**
 * PHP Version 8.1
 * ApiProcessService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/ApiProcessService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse;

/**
 * ApiProcessService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/ApiProcessService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface ApiProcessService
{
    /**
     * GenerateProviderResponse.
     *
     * @param array|null $apiResponse apiResponse
     *
     * @return ProviderPaymentResponse
     *
     * @throws LogicNotImplementedException
     */
    public function generateProviderResponse(?array $apiResponse): ProviderPaymentResponse;

    /**
     * Decision.
     *
     * @param ProviderPaymentResponse $providerResponse providerResponse
     *
     * @return void
     *
     * @throws PaymentAPIException|LogicNotImplementedException
     */
    public function decision(ProviderPaymentResponse $providerResponse): void;
}
