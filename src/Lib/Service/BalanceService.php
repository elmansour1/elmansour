<?php

/**
 * PHP Version 8.1
 * BalanceService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/BalanceService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BalanceApplicationException;

/**
 * BalanceService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/BalanceService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface BalanceService
{
    /**
     * Balance.
     *
     * @return float
     *
     * @throws BalanceApplicationException
     */
    public function balance(): float;

    /**
     * SetBalance.
     *
     * @param float $balance balance
     *
     * @return void
     *
     * @throws BalanceApplicationException
     */
    public function setBalance(float $balance): void;
}
