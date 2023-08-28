<?php

/**
 * PHP Version 8.1
 * ServiceEntityRepositoryInterface.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ServiceEntityRepositoryInterface.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository;

// @codingStandardsIgnoreStart
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface as BaseRepositoryInterface;
// @codingStandardsIgnoreEnd
use Doctrine\DBAL\LockMode;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Collection;

/**
 * ServiceEntityRepositoryInterface.
 *
 * @template T of object
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ReferenceRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface ServiceEntityRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Save.
     * Save entity in database.
     *
     * @param T $entity entity
     *
     * @return T
     */
    public function save($entity);

    /**
     * SaveWith.
     * Save entity in database with parameter.
     *
     * @param array $parameters parameters
     *
     * @return T
     */
    public function saveWith(array $parameters);

    /**
     * Update.
     * Update entity in database.
     *
     * @param T $entity entity
     *
     * @return T
     *
     * @throws \Exception
     */
    public function update($entity);

    /**
     * Save.
     * Save entities in database.
     *
     * @param Collection<T> $entities entities
     *
     * @return Collection<T>
     */
    public function saveList($entities);

    /**
     * FindId.
     * Finds an entity by its primary key / identifier.
     *
     * @param int           $id          the identifier
     * @param bool          $throw       throw
     * @param LockMode|null $lockMode    one of the
     *                                   \Doctrine\DBAL\LockMode::*
     *                                   constants or NULL if no
     *                                   specific lock mode should
     *                                   be used during the search
     * @param int|null      $lockVersion the lock version
     *
     * @return T
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findId(
        int $id,
        bool $throw = true,
        ?LockMode $lockMode = null,
        ?int $lockVersion = null
    );

    /**
     * FindOneWith
     * Finds a single entity by a set of criteria.
     *
     * @param array      $criteria criteria
     * @param bool       $throw    throw
     * @param array|null $orderBy  orderBy
     *
     * @return T
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneWith(
        array $criteria,
        bool $throw = true,
        ?array $orderBy = null
    );

    /**
     * UpdateWith.
     * Update entity by a set of criteria.
     *
     * @param string $key         key
     * @param mixed  $searchValue searchValue
     * @param string $keyValue    $keyValue
     * @param mixed  $value       $value
     *
     * @return T
     *
     * @throws \Exception
     */
    public function updateWith(
        string $key,
        mixed $searchValue,
        string $keyValue,
        mixed $value
    );

    /**
     * UpdateEntity.
     * Update entity by a set of criteria.
     *
     * @param int $id     id
     * @param T   $object object
     *
     * @return T
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateEntity(int $id, $object);

    /**
     * UpdateValues.
     * Update entity by a set of criteria.
     *
     * @param int   $id         id
     * @param array $parameters parameters
     *
     * @return T
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateValues(int $id, array $parameters);

    /**
     * FindWith.
     * Finds entities by a set of criteria.
     *
     * @param array      $criteria criteria
     * @param bool       $throw    throw
     * @param array|null $orderBy  orderBy
     * @param int|null   $limit    limit
     * @param int|null   $offset   offset
     *
     * @return Collection<T>
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findWith(
        array $criteria,
        bool $throw = true,
        ?array $orderBy = null,
        ?int $limit = null,
        ?int $offset = null
    );

    /**
     * FindAll.
     * Finds all entities in the repository.
     *
     * @param bool $throw throw
     *
     * @return Collection<T>
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findAll(bool $throw = true);

    /**
     * GenerateEntity.
     *
     * @param T $entity entity
     *
     * @return T
     */
    public function generateEntity($entity);

    /**
     * GenerateId.
     *
     * @param int $length Length
     *
     * @return string
     */
    public function generateId(int $length = 6): string;
}
