<?php

/**
 * PHP Version 8.1
 * ReferenceRepository.
 *
 * @category Repository
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Repository
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Repository/ReferenceRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Repository;

use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Reference;
use Doctrine\Persistence\ManagerRegistry;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\ReferenceCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository\ReferenceRepository as RefRp;

/**
 * ReferenceRepository.
 *
 * @template-extends    Repository<Reference>
 * @template-implements RefRp
 *
 * @category Repository
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Repository
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Repository/ReferenceRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ReferenceRepository extends Repository implements RefRp
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
        string $entityClass = Reference::class,
        string $collectionClass = ReferenceCollection::class
    ) {
        parent::__construct(
            $registry,
            $entityClass,
            $collectionClass
        );
    }

    /**
     * SaveWithReferenceNumber.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return Reference
     *
     * @throws \Exception
     */
    public function saveWithReferenceNumber(string $referenceNumber): Reference
    {
        return parent::saveWith(
            [AppConstants::REFERENCE_NUMBER => $referenceNumber]
        );
    }

    /**
     * FindOneByReferenceId.
     *
     * @param int  $referenceId referenceId
     * @param bool $throw       throw
     *
     * @return Reference|null
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByReferenceId(
        int $referenceId,
        bool $throw = true
    ): ?Reference {
        return parent::findOneWith(
            [AppConstants::REFERENCE_ID => $referenceId],
            $throw
        );
    }

    /**
     * FindOneByReferenceId.
     *
     * @param int  $referenceNumber referenceNumber
     * @param bool $throw           throw
     *
     * @return Reference|null
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByReferenceNumber(
        string $referenceNumber,
        bool $throw = true
    ): ?Reference {
        return parent::findOneWith(
            [AppConstants::REFERENCE_NUMBER => $referenceNumber],
            $throw
        );
    }

    /**
     * FindOneByReferenceId.
     *
     * @param int    $referenceNumber referenceNumber
     * @param Status $status          status
     *
     * @return Reference
     *
     * @throws \Exception
     */
    public function updateStatus(string $referenceNumber, Status $status): Reference
    {
        return parent::updateWith(
            AppConstants::REFERENCE_NUMBER,
            $referenceNumber,
            AppConstants::STATUS,
            $status
        );
    }
}
