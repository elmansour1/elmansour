<?php

/**
 * PHP Version 8.1
 * Repository.
 *
 * @category Repository
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Repository
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Repository/Repository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\ORM\Repository\Exception\InvalidMagicMethodCall;
use Doctrine\Persistence\ManagerRegistry;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\ListEntityNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Collection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;
//@codingStandardsIgnoreStart
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository\ServiceEntityRepositoryInterface as BaseRepoInterface;
//@codingStandardsIgnoreEnd
use DateTime;
use DateTimeZone;

/**
 * Repository.
 *
 * @template T of object
 *
 * @template-implements ServiceEntityRepositoryInterface<T>
 *
 * @category Repository
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Repository
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Repository/Repository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Repository extends ServiceEntityRepository implements BaseRepoInterface
{
    protected string $entityClass;
    protected string $collectionClass;
    protected ?string $entityName;
    protected static ?Inflector $inflector = null;

    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry        registry
     * @param string|null     $entityClass     entityClass
     * @param string          $collectionClass collectionClass
     *
     * @return void
     */
    public function __construct(
        ManagerRegistry $registry,
        string $entityClass = null,
        string $collectionClass = Collection::class
    ) {
        $this->collectionClass = $collectionClass;
        $this->entityClass = $entityClass;
        parent::__construct($registry, $entityClass);

        $values = explode('\\', $this->_entityName);
        if (is_array($values)) {
            $this->entityName = $values[count($values) - 1];
        }
    }

    /**
     * Save.
     * Save entity in database.
     *
     * @param T $entity entity
     *
     * @return T
     */
    public function save($entity)
    {
        $object = $this->generateEntity($entity);
        $this->_em->persist($object);
        $this->_em->flush();

        return $object;
    }

    /**
     * SaveWith.
     * Save entity in database with parameters.
     *
     * @param array $parameters parameters
     *
     * @return T
     */
    public function saveWith(array $parameters)
    {
        $entity = new $this->entityClass();

        foreach ($parameters as $key => $value) {
            if (property_exists($entity, $key) && null != $value) {
                $entity->$key = $value;
            }
        }

        return $this->save($entity);
    }

    /**
     * Update.
     * Update entity in database.
     *
     * @param T $entity entity
     *
     * @return T
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function update($entity)
    {
        $entity->lastUpdatedDate = new DateTime(
            AppConstants::NOW,
            new DateTimeZone($_ENV['TIME_ZONE'])
        );
        $this->_em->persist($entity);
        $this->_em->flush();

        return $entity;
    }

    /**
     * SaveList.
     * Save entities in database.
     *
     * @param Collection<T> $entities entities
     *
     * @return Collection<T>
     */
    public function saveList($entities)
    {
        $tab = $entities->all();

        foreach ($tab as $key => $value) {
            $tab[$key] = $this->generateEntity($value);
            $this->_em->persist($tab[$key]);
        }

        $this->_em->flush();

        return new $this->collectionClass($tab);
    }

    /**
     * FindId.
     * Finds an entity by its primary key / identifier.
     *
     * @param int           $id          the identifier
     * @param bool          $throw       throw clause
     * @param LockMode|null $lockMode    LockMode::* constants
     *                                   or NULL if no specific
     *                                   during the search
     * @param int|null      $lockVersion the lock version
     *
     * @return T
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function findId(
        int $id,
        bool $throw = true,
        ?LockMode $lockMode = null,
        ?int $lockVersion = null
    ) {
        $entity = parent::find($id);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(
                sprintf(
                    SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE],
                    ucfirst($this->entityName),
                    AppConstants::ID,
                    $id
                )
            );
        }

        return $entity;
    }

    /**
     * FindOneWith.
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
    ) {
        $entity = parent::findOneBy($criteria, $orderBy);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(
                sprintf(
                    SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE],
                    ucfirst($this->entityName),
                    http_build_query($criteria, '', ','),
                    ''
                )
            );
        }

        return $entity;
    }

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
    ) {
        $entities = parent::findBy($criteria, $orderBy, $limit, $offset);

        if (!$entities && $throw) {
            throw new EntityNotFoundException(
                sprintf(
                    SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE],
                    ucfirst($this->entityName),
                    http_build_query($criteria, '', ','),
                    ''
                )
            );
        }

        return new $this->collectionClass($entities);
    }

    /**
     * UpdateWith.
     * Update entity by a set of criteria.
     *
     * @param string $key         key
     * @param mixed  $searchValue searchValue
     * @param string $keyValue    keyValue
     * @param mixed  $value       value
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
    ) {
        $entity = $this->findOneWith([$key => $searchValue]);
        $entity->$keyValue = $value;

        return $this->update($entity);
    }

    /**
     * UpdateEntity.
     * Update entity by a set of criteria.
     *
     * @param int   $id     id
     * @param mixed $object object
     *
     * @return T
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateEntity(int $id, $object)
    {
        $entity = $this->find($id);

        foreach (get_object_vars($object) as $key => $value) {
            if (property_exists($entity, $key) && null != $value) {
                $entity->$key = $value;
            }
        }

        return $this->update($entity);
    }

    /**
     * UpdateValues.
     * update entity by a set of criteria.
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
    public function updateValues(int $id, array $parameters)
    {
        $entity = $this->find($id);

        foreach ($parameters as $key => $value) {
            if (property_exists($entity, $key) && null != $value) {
                $entity->$key = $value;
            }
        }

        return $this->update($entity);
    }

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
    public function findAll(bool $throw = true)
    {
        $entities = parent::findAll();

        if (!$entities && $throw) {
            throw new ListEntityNotFoundException(
                sprintf(
                    SystemExceptionMessage::LIST_ENTITY_NOT_FOUND[
                        AppConstants::MESSAGE
                    ],
                    AppConstants::OPTION
                )
            );
        }

        return new $this->collectionClass($entities);
    }

    /**
     * GenerateEntity.
     *
     * @param T $entity entity
     *
     * @return T
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function generateEntity($entity)
    {
        $idParam = lcfirst($this->entityName . 'Id');
        $methodFindById = 'findOneWith' . $this->entityName . 'Id';

        $entity->$idParam = $this->generateId($_ENV['APP_DB_ID_LENGTH']);

        if ($this->$methodFindById($entity->$idParam, false)) {
            return $this->generateEntity($entity);
        }

        $object = $entity;

        if ($this->entityClass != $entity::class) {
            $object = new $this->entityClass();

            foreach (get_object_vars($entity) as $key => $value) {
                if (property_exists($object, $key) && null != $value) {
                    $object->$key = $value;
                }
            }
        }

        return $object;
    }

    /**
     * GenerateId.
     *
     * @param int $length length
     *
     * @return string
     */
    public function generateId(int $length = 6): string
    {
        $str = '';
        $characters = array_merge(range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }

        return $str;
    }

    /**
     * Callable.
     * Adds support for magic method calls.
     *
     * @param string  $method    method
     * @param mixed[] $arguments arguments
     *
     * @psalm-param list<mixed> $arguments
     *
     * @return mixed the returned value from the resolved method
     *
     * @throws BadMethodCallException|InvalidMagicMethodCall
     */
    public function __call($method, $arguments)
    {
        if (str_starts_with($method, 'findWith')) {
            return $this->resolveMagicCall(
                'findWith',
                substr($method, 8),
                $arguments
            );
        }

        if (str_starts_with($method, 'findOneWith')) {
            return $this->resolveMagicCall(
                'findOneWith',
                substr($method, 11),
                $arguments
            );
        }

        if (str_starts_with($method, 'updateWith')) {
            return $this->resolveMagicCall(
                'updateWith',
                substr($method, 10),
                $arguments
            );
        }

        parent::__call($method, $arguments);
    }

    /**
     * ResolveMagicCall.
     * Resolves a magic method call to the
     * Proper existent method at `EntityRepository`.
     *
     * @param string $method    The method to call
     * @param string $by        The property name used as condition
     * @param array  $arguments The arguments to pass at method call
     *
     * @psalm-param list<mixed> $arguments The arguments to pass at method call
     *
     * @return mixed
     *
     * @throws InvalidMagicMethodCall if the method called is invalid or the
     *                                requested field/association does not exist
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function resolveMagicCall(
        string $method,
        string $by,
        array $arguments
    ) {
        if (!$arguments) {
            throw InvalidMagicMethodCall::onMissingParameter($method . $by);
        }

        if (null === self::$inflector) {
            self::$inflector = InflectorFactory::create()->build();
        }

        $fieldName = lcfirst(self::$inflector->classify($by));

        $condition = $this->_class->hasField($fieldName) ||
            $this->_class->hasAssociation($fieldName);
        if (!$condition) {
            throw InvalidMagicMethodCall::becauseFieldNotFoundIn(
                $this->_entityName,
                $fieldName,
                $method . $by
            );
        }

        return $this->$method(
            [$fieldName => $arguments[0]],
            ...array_slice($arguments, 1)
        );
    }
}
