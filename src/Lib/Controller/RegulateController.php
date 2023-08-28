<?php

/**
 * PHP Version 8.1
 * RegulateController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/RegulateController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\VerifyException;

/**
 * RegulateController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/RegulateController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface RegulateController
{
    /**
     * Regulate API.
     *
     * @param int    $transactionId transactionId
     * @param string $providerId    providerId
     *
     * @return PaymentResponse
     *
     * @throws VerifyException|PaymentException
     */
    public function regulate(
        int $transactionId,
        string $providerId
    ): PaymentResponse;
}
