<?php

/**
 * PHP Version 8.1
 * CallbackController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/CallbackController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * CallbackController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/CallbackController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface CallbackController
{
    /**
     * Decision API.
     *
     * @param Request $response response
     *
     * @return PaymentResponse
     */
    public function callback(Request $response): PaymentResponse;
}
