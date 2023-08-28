<?php

/**
 * PHP Version 8.1
 * CancelService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/CancelService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\IllegalStatusCancelException;

/**
 * CancelService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/CancelService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface CancelService
{
    /**
     * Cancel.
     *
     * @param int $transactionId transactionId
     *
     * @return Transaction
     *
     * @throws IllegalStatusCancelException
     */
    public function cancel(int $transactionId): Transaction;
}
