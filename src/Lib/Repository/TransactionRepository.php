<?php

/**
 * PHP Version 8.1
 * TransactionRepository.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/TransactionRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityAlReadyExistException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * TransactionRepository.
 *
 * @template-extends ServiceEntityRepositoryInterface<Transaction>
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/TransactionRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface TransactionRepository extends ServiceEntityRepositoryInterface
{
    /**
     * FindOneByTransactionId.
     *
     * @param int  $transactionId transactionId
     * @param bool $throw         throw
     *
     * @return Transaction|null
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByTransactionId(
        int $transactionId,
        bool $throw = true
    ): ?Transaction;

    /**
     * FindOneByFinancialId.
     *
     * @param string $financialId financialId
     * @param bool   $throw       throw
     *
     * @return Transaction|null
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByFinancialId(
        string $financialId,
        bool $throw = true
    ): ?Transaction;

    /**
     * FindOneByApplicationId.
     *
     * @param string $applicationId applicationId
     * @param bool   $throw         throw
     *
     * @return Transaction|null
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByApplicationId(
        string $applicationId,
        bool $throw = true
    ): ?Transaction;

    /**
     * FindOneByExternalId.
     *
     * @param string $externalId externalId
     * @param bool   $throw      throw
     *
     * @return Transaction|null
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByExternalId(
        string $externalId,
        bool $throw = true
    ): ?Transaction;

    /**
     * FindOneByRequestId.
     *
     * @param string $requestId requestId
     * @param bool   $throw     throw
     *
     * @return Transaction|null
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByRequestId(
        string $requestId,
        bool $throw = true
    ): ?Transaction;

    /**
     * FindOneByProviderId.
     *
     * @param string $providerId providerId
     * @param bool   $throw      throw
     *
     * @return Transaction|null
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByProviderId(
        string $providerId,
        bool $throw = true
    ): ?Transaction;

    /**
     * UpdateProviderId.
     *
     * @param int    $id         id
     * @param string $providerId providerId
     *
     * @return Transaction
     *
     * @throws EntityAlReadyExistException|EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateProviderId(
        int $id,
        string $providerId
    ): Transaction;

    /**
     * UpdateStatus.
     *
     * @param int    $id     id
     * @param Status $status status
     *
     * @return Transaction
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateStatus(
        int $id,
        Status $status
    ): Transaction;

    /**
     * UpdateProviderIdStatus.
     *
     * @param int    $id         id
     * @param string $providerId providerId
     * @param Status $status     status
     *
     * @return Transaction
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateProviderIdStatus(
        int $id,
        string $providerId,
        Status $status
    ): Transaction;

    /**
     * UpdateProviderData.
     *
     * @param int         $id          id
     * @param Transaction $transaction transaction
     *
     * @return Transaction
     *
     * @throws EntityAlReadyExistException
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateProviderData(
        int $id,
        Transaction $transaction
    ): Transaction;
}
