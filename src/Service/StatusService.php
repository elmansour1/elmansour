<?php

/**
 * PHP Version 8.1
 * StatusService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/StatusService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\StatusRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadReferenceException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\InvalidAmountException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\ReferenceMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\StatusService as BaseStatusSv;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;

/**
 * StatusService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/StatusService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class StatusService implements BaseStatusSv
{
    protected TransactionService $transactionService;
    protected ReferenceService $referenceService;
    protected ReferenceMapper $referenceMapper;
    protected TransactionMapper $transactionMapper;

    /**
     * Constructor.
     *
     * @param TransactionService $transactionService transactionService
     * @param ReferenceService   $referenceService   referenceService
     * @param ReferenceMapper    $referenceMapper    referenceMapper
     * @param TransactionMapper  $transactionMapper  transactionMapper
     *
     * @return void
     */
    public function __construct(
        TransactionService $transactionService,
        ReferenceService $referenceService,
        ReferenceMapper $referenceMapper,
        TransactionMapper $transactionMapper
    ) {
        $this->transactionService = $transactionService;
        $this->referenceService = $referenceService;
        $this->referenceMapper = $referenceMapper;
        $this->transactionMapper = $transactionMapper;
    }

    /**
     * Status.
     *
     * @param StatusRequest $request request
     *
     * @return Transaction
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress MixedAssignment
     */
    public function status(StatusRequest $request): Transaction
    {
        if (!preg_match($_ENV['REFERENCE_REGEX'], $request->reference ?? '')) {
            throw new BadReferenceException($request->reference);
        }

        $condition = $request->amount &&
            (
                $request->amount > $_ENV['AMOUNT_MAX'] ||
                $request->amount < $_ENV['AMOUNT_MIN']
            );

        if ($condition) {
            throw new InvalidAmountException($request->amount);
        }

        $searchItems = [];

        foreach (get_object_vars($request) as $key => $value) {
            if ($value) {
                $searchItems[$key] = $value;
            }
        }

        $transaction = $this->transactionService->findOneBy($searchItems);

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['REFERENCE_API_ENABLED']) {
            $transaction->referenceData = $this->referenceService
                ->findByReferenceNumber(
                    $transaction->reference
                );
        }

        return $transaction;
    }
}
