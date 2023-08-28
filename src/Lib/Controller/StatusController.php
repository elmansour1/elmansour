<?php

/**
 * PHP Version 8.1
 * StatusController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/StatusController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\StatusRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\VerifyException;

/**
 * StatusController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/StatusController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface StatusController
{
    /**
     * Status API.
     *
     * @param StatusRequest $request request
     *
     * @return PaymentResponse
     *
     * @throws VerifyException|PaymentException
     */
    public function status(StatusRequest $request): PaymentResponse;
}
