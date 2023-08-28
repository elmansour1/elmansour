<?php

/**
 * PHP Version 8.1
 * ReferenceRepository.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ReferenceRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Reference;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;
use PHPUnit\Util\Exception;

/**
 * ReferenceRepository.
 *
 * @template-extends ServiceEntityRepositoryInterface<Reference>
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ReferenceRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface ReferenceRepository extends ServiceEntityRepositoryInterface
{
    /**
     * SaveWithReferenceNumber.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return Reference
     *
     * @throws \Exception
     */
    public function saveWithReferenceNumber(string $referenceNumber): Reference;

    /**
     * FindOneByReferenceNumber.
     *
     * @param string $referenceNumber referenceNumber
     * @param bool   $throw           throw
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
    ): ?Reference;

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
    ): ?Reference;

    /**
     * UpdateStatus.
     *
     * @param string $referenceNumber referenceNumber
     * @param Status $status          status
     *
     * @return Reference
     *
     * @throws \Exception
     */
    public function updateStatus(string $referenceNumber, Status $status): Reference;
}
