<?php

/**
 * PHP Version 8.1
 * PaymentVerifyService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/PaymentVerifyService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\DuplicateProviderIdException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\RequiredProviderIdException;

/**
 * PaymentVerifyService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/PaymentVerifyService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface PaymentVerifyService
{
    /**
     * Verify.
     *
     * @param PaymentRequest $paymentRequest paymentRequest
     *
     * @return void
     *
     * @throws PaymentException
     */
    public function verify(PaymentRequest $paymentRequest): void;

    /**
     * VerifyProvider.
     *
     * @param string|null $providerId providerId
     *
     * @return void
     *
     * @throws DuplicateProviderIdException|RequiredProviderIdException
     */
    public function verifyProvider(?string $providerId): void;
}
