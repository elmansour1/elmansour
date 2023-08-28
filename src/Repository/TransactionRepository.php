<?php

/**
 * PHP Version 8.1
 * TransactionRepository.
 *
 * @category Repository
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Repository
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Repository/TransactionRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Repository;

use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Transaction;
use Doctrine\Persistence\ManagerRegistry;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\TransactionCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository\TransactionRepository as TxR;

/**
 * TransactionRepository.
 *
 * @template-extends    Repository<Transaction>
 * @template-implements TxR
 *
 * @category Repository
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Repository
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Repository/TransactionRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class TransactionRepository extends Repository implements TxR
{
    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry        registry
     * @param string          $entityClass     entityClass
     * @param string          $collectionClass collectionClass
     *
     * @return void
     */
    public function __construct(
        ManagerRegistry $registry,
        string $entityClass = Transaction::class,
        string $collectionClass = TransactionCollection::class
    ) {
        parent::__construct(
            $registry,
            $entityClass,
            $collectionClass
        );
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
        return parent::findOneWith(
            [AppConstants::TRANSACTION_ID => $transactionId],
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
        return parent::findOneWith(
            [AppConstants::FINANCIAL_ID => $financialId],
            $throw
        );
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
        return parent::findOneWith(
            [AppConstants::APPLICATION_ID => $applicationId],
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
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     *
     * @throws EntityNotFoundException
     */
    public function findOneByExternalId(
        string $externalId,
        bool $throw = true
    ): ?Transaction {
        return parent::findOneWith(
            [AppConstants::EXTERNAL_ID => $externalId],
            $throw
        );
    }

    /**
     * FindOneByRequestId.
     *
     * @param string $requestId requestId
     * @param bool   $throw     throw
     *
     * @return Transaction|null
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     *
     * @throws EntityNotFoundException
     */
    public function findOneByRequestId(
        string $requestId,
        bool $throw = true
    ): ?Transaction {
        return parent::findOneWith([AppConstants::REQUEST_ID => $requestId], $throw);
    }

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
    ): ?Transaction {
        return parent::findOneWith(
            [AppConstants::PROVIDER_ID => $providerId],
            $throw
        );
    }

    /**
     * UpdateProviderId.
     *
     * @param int    $id         id
     * @param string $providerId providerId
     *
     * @return Transaction
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateProviderId(int $id, string $providerId): Transaction
    {
        return parent::updateWith(
            AppConstants::ID,
            $id,
            AppConstants::PROVIDER_ID,
            $providerId
        );
    }

    /**
     * UpdateStatus.
     *
     * @param int    $id     id
     * @param Status $status status
     *
     * @return Transaction
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateStatus(int $id, Status $status): Transaction
    {
        return parent::updateWith(
            AppConstants::ID,
            $id,
            AppConstants::STATUS,
            $status
        );
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
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateProviderIdStatus(
        int $id,
        string $providerId,
        Status $status
    ): Transaction {
        return parent::updateValues(
            $id,
            [
                AppConstants::PROVIDER_ID => $providerId,
                AppConstants::STATUS => $status
            ]
        );
    }

    /**
     * UpdateProviderData
     *
     * @param int             $id          id
     * @param BaseTransaction $transaction transaction
     *
     * @return Transaction
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateProviderData(
        int $id,
        BaseTransaction $transaction
    ): Transaction {
        return parent::updateEntity($id, $transaction);
    }
}
