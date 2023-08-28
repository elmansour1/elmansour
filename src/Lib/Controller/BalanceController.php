<?php

/**
 * PHP Version 8.1
 * BalanceController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/BalanceController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\BalanceResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BalanceException;

/**
 * BalanceController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/BalanceController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface BalanceController
{
    /**
     * Balance API.
     *
     * @return BalanceResponse
     *
     * @throws BalanceException
     */
    public function balance(): BalanceResponse;
}
