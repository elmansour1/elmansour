<?php

/**
 * PHP Version 8.1
 * PaymentErrorService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/PaymentErrorService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\RegulateException;

/**
 * PaymentErrorService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/PaymentErrorService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface PaymentErrorService
{
    /**
     * Error.
     *
     * @param \Throwable       $exception   exception
     * @param Transaction|null $transaction transaction
     *
     * @return RegulateException
     */
    public function error(
        \Throwable $exception,
        ?Transaction $transaction = null
    ): RegulateException;
}
