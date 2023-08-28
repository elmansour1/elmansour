<?php

/**
 * PHP Version 8.1
 * StatusService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/StatusService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\StatusRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;

/**
 * StatusService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/StatusService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface StatusService
{
    /**
     * Status.
     *
     * @param StatusRequest $request request
     *
     * @return Transaction
     */
    public function status(StatusRequest $request): Transaction;
}
