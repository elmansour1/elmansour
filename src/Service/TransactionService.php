<?php

/**
 * PHP Version 8.1
 * TransactionService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/TransactionService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityAlReadyExistException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository\TransactionRepository;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\TransactionService as TrS;

/**
 * TransactionService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/TransactionService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class TransactionService implements TrS
{
    protected TransactionRepository $transRepository;

    /**
     * Constructor.
     *
     * @param TransactionRepository $transRepository transRepository
     *
     * @return void
     */
    public function __construct(TransactionRepository $transRepository)
    {
        $this->transRepository = $transRepository;
    }

    /**
     * Save.
     *
     * @param Transaction $transaction transaction
     *
     * @return Transaction
     *
     * @throws \Exception
     */
    public function save(Transaction $transaction): Transaction
    {
        return $this->transRepository->save($transaction);
    }

    /**
     * Update.
     *
     * @param Transaction $transaction transaction
     *
     * @return Transaction
     *
     * @throws \Exception
     */
    public function update(Transaction $transaction): Transaction
    {
        return $this->transRepository->update($transaction);
    }

    /**
     * Find.
     *
     * @param int $id id
     *
     * @return Transaction
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function find(int $id): Transaction
    {
        return $this->transRepository->findId($id);
    }

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
    ): ?Transaction {
        return $this->transRepository->findOneByTransactionId(
            $transactionId,
            $throw
        );
    }

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
    ): ?Transaction {
        return $this->transRepository->findOneByFinancialId($financialId, $throw);
    }

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
    ): ?Transaction {
        return $this->transRepository->findOneByApplicationId(
            $applicationId,
            $throw
        );
    }

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
    ): ?Transaction {
        return $this->transRepository->findOneByExternalId($externalId, $throw);
    }

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
    ): ?Transaction {
        return $this->transRepository->findOneByRequestId($requestId, $throw);
    }

    /**
     * FindOneByProviderId.
     *
     * @param string $providerId requestId
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
    ): ?Transaction {
        return $this->transRepository->findOneByProviderId($providerId, $throw);
    }

    /**
     * FindOneBy.
     *
     * @param array $data data
     *
     * @return Transaction
     *
     * @throws EntityNotFoundException
     */
    public function findOneBy(array $data): Transaction
    {
        return $this->transRepository->findOneWith($data);
    }

    /**
     * UpdateProviderId.
     *
     * @param int    $id         id
     * @param string $providerId providerId
     *
     * @return Transaction
     *
     * @throws EntityAlReadyExistException
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateProviderId(int $id, string $providerId): Transaction
    {
        return $this->transRepository->updateProviderId($id, $providerId);
    }

    /**
     * UpdateStatus.
     *
     * @param int    $id     id
     * @param Status $status status
     *
     * @return Transaction
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateStatus(int $id, Status $status): Transaction
    {
        return $this->transRepository->updateStatus($id, $status);
    }

    /**
     * UpdateProviderIdStatus.
     *
     * @param int    $id         id
     * @param string $providerId providerId
     * @param Status $status     status
     *
     * @return Transaction
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateProviderIdStatus(
        int $id,
        string $providerId,
        Status $status
    ): Transaction {
        return $this->transRepository->updateProviderIdStatus(
            $id,
            $providerId,
            $status
        );
    }

    /**
     * UpdateProviderData.
     *
     * @param int         $id          id
     * @param Transaction $transaction transaction
     *
     * @return Transaction
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateProviderData(
        int $id,
        Transaction $transaction
    ): Transaction {
        return $this->transRepository->updateProviderData($id, $transaction);
    }
}
