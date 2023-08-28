<?php

/**
 * PHP Version 8.1
 * ConfirmService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/ConfirmService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ConfirmRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\IllegalStatusConfirmException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\RequiredProviderIdException;

/**
 * ConfirmService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/ConfirmService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface ConfirmService
{
    /**
     * Confirm
     *
     * @param ConfirmRequest $request request
     *
     * @return Transaction
     *
     * @throws IllegalStatusConfirmException|RequiredProviderIdException
     */
    public function confirm(ConfirmRequest $request): Transaction;
}
