<?php

/**
 * PHP Version 8.1
 * VerifyController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/VerifyController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\VerifyRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\VerifyResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\VerifyException;

/**
 * VerifyController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/VerifyController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface VerifyController
{
    /**
     * Verify API.
     *
     * @param VerifyRequest $request request
     *
     * @return VerifyResponse
     *
     * @throws VerifyException
     */
    public function verify(VerifyRequest $request): VerifyResponse;
}
