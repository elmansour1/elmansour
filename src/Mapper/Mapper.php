<?php

/**
 * PHP Version 8.1
 * Mapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/Mapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Mapper;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MapperConfigException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MapperEmptyException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MapperException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MapperTypeException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\Mapper as BaseMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Collection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;
use DateTime;
use DateTimeZone;
use ReflectionClass;

/**
 * Mapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/Mapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @template T of object
 * @template K of object
 * @template Z of object
 * @template S of object
 *
 * @template-implements BaseMapper<T, K, Z, S>
 *
 * @psalm-suppress InvalidReturnType
 * @psalm-suppress MoreSpecificReturnType
 * @psalm-suppress LessSpecificReturnStatement
 * @psalm-suppress InvalidReturnStatement
 * @psalm-suppress InvalidStringClass
 * @psalm-suppress MixedAssignment
 * @psalm-suppress MixedArgument
 * @psalm-suppress MixedAssignment
 * @psalm-suppress MixedMethodCall
 * @psalm-suppress MixedReturnStatement
 * @psalm-suppress MixedInferredReturnType
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Mapper implements BaseMapper
{
    protected ?string $entityClass;
    protected ?string $dtoClass;
    protected ?string $entitiesClass;
    protected ?string $dtosClass;
    protected ?array $keyConverters;

    /**
     * Constructor.
     *
     * @param string|null $entityClass   entityClass
     * @param string|null $dtoClass      dtoClass
     * @param string|null $entitiesClass entitiesClass
     * @param string|null $dtosClass     dtosClass
     * @param array|null  $keyConverters keyConverters
     *
     * @return void
     */
    public function __construct(
        ?string $entityClass = null,
        ?string $dtoClass = null,
        ?string $entitiesClass = null,
        ?string $dtosClass = null,
        ?array $keyConverters = null
    ) {
        $this->entityClass = $entityClass;
        $this->dtoClass = $dtoClass;
        $this->entitiesClass = $entitiesClass;
        $this->dtosClass = $dtosClass;
        $this->keyConverters = $keyConverters;
    }

    /**
     * Get entity with Dto.
     *
     * @param T|null $dto dto
     *
     * @return K|null
     *
     * @throws MapperException|MapperEmptyException|MapperConfigException
     */
    public function asEntity($dto)
    {
        if (null == $dto) {
            throw new MapperEmptyException($this->dtoClass);
        }

        if (!$this->entityClass) {
            throw new MapperConfigException(AppConstants::ENTITY);
        }

        $entity = new $this->entityClass();
        $properties = $this->getClassProperties($entity);

        foreach (get_object_vars($dto) as $key => $value) {
            if (property_exists($entity, $key) && null != $value) {
                $entity->$key = $this->convertToAttribute($value, $properties[$key]);
            }
        }

        if (!$entity) {
            throw new MapperException($this->dtoClass, $this->entityClass);
        }

        return $entity;
    }

    /**
     * Get Dto with entity.
     *
     * @param K|null $entity entity
     *
     * @return T|null
     *
     * @psalm-suppress InvalidStringClass
     *
     * @throws MapperException|MapperEmptyException|MapperConfigException
     */
    public function asDTO($entity)
    {
        if (null == $entity) {
            throw new MapperEmptyException($this->entityClass);
        }

        if (!$this->dtoClass) {
            throw new MapperConfigException(AppConstants::DTO);
        }

        $dto = new $this->dtoClass();

        foreach (get_object_vars($entity) as $key => $value) {
            if (property_exists($dto, $key) && null != $value) {
                $dto->$key = $this->convertToValue($value);
            }
        }

        if ($this->keyConverters) {
            foreach ($this->keyConverters as $key => $value) {
                $dto->$value = $this->convertToValue($entity->$key);
            }
        }

        if (!$dto) {
            throw new MapperException($this->entityClass, $this->dtoClass);
        }

        return $dto;
    }

    /**
     * Get entities with dtos.
     *
     * @param Z|Collection<T>|null $dtos dtos
     *
     * @return S|Collection<K>|null
     *
     * @throws MapperException|MapperEmptyException|MapperConfigException|MapperTypeException
     *
     * @psalm-suppress InvalidStringClass
     */
    public function asEntityList($dtos)
    {
        if (null == $dtos) {
            throw new MapperEmptyException($this->dtosClass);
        }

        if (!($dtos instanceof Collection)) {
            throw new MapperTypeException(AppConstants::DTO_COLLECTION);
        }

        if (!$this->entitiesClass) {
            throw new MapperConfigException(AppConstants::ENTITY_COLLECTION);
        }

        $entities = new $this->entitiesClass();

        foreach ($dtos->all() as $value) {
            $entities->add($this->asEntity($value));
        }

        if (!$entities) {
            throw new MapperException($this->dtosClass, $this->entitiesClass);
        }

        return $entities;
    }

    /**
     * Get dtos with entities.
     *
     * @param S|Collection<K>|null $entities entities
     *
     * @return Z|Collection<T>|null
     *
     * @throws MapperException|MapperEmptyException|MapperConfigException|MapperTypeException
     *
     * @psalm-suppress InvalidStringClass
     */
    public function asDTOList($entities)
    {
        if (null == $entities) {
            throw new MapperEmptyException($this->entitiesClass);
        }

        if (!($entities instanceof Collection)) {
            throw new MapperTypeException(AppConstants::ENTITY_COLLECTION);
        }

        if (!$this->dtosClass) {
            throw new MapperConfigException(AppConstants::DTO_COLLECTION);
        }

        $dtos = new $this->dtosClass();

        foreach ($entities->all() as $value) {
            $dtos->add($this->asDTO($value));
        }

        if (!$dtos) {
            throw new MapperException($this->entitiesClass, $this->dtosClass);
        }

        return $dtos;
    }

    /**
     * ConvertToValue.
     * Convert entity attribute to dto value.
     *
     * @param string|int|float|DateTime|Status|null $attribute attribute
     *
     * @return string|int|float|null
     */
    public function convertToValue(
        DateTime|Status|string|int|float|null $attribute
    ): string|int|float|null {
        $value = null;

        $condition = is_int($attribute) ||
            is_float($attribute) ||
            is_string($attribute);

        if ($condition) {
            $value = $attribute;
        } elseif ($attribute instanceof DateTime) {
            $value = $attribute->format('Y-m-d H:m:s');
        } elseif ($attribute instanceof Status) {
            $value = $attribute->value;
        }

        return $value;
    }

    /**
     * ConvertToAttribute.
     * Convert dto value to entity attribute.
     *
     * @param string|int|float|null $value value
     * @param string|null           $class class
     *
     * @return string|int|float|DateTime|Status|null
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.StaticAccess)
     *
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function convertToAttribute(
        string|int|float|null $value,
        ?string $class = null
    ): DateTime|Status|string|int|float|null {
        $attribute = null;

        if (DateTime::class == $class && is_string($value)) {
            $attribute = new DateTime(
                $value,
                new DateTimeZone($_ENV['TIME_ZONE'])
            );
        } elseif (Status::class == $class && is_string($value)) {
            $attribute = Status::from($value);
        } elseif ($value) {
            $attribute = $value;
        }

        return $attribute;
    }

    /**
     * GetClassProperties.
     *
     * @param mixed $object object
     *
     * @return array
     *
     * @throws \ReflectionException
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UndefinedMethod
     */
    protected function getClassProperties(mixed $object): array
    {
        $reflect = new ReflectionClass($object);

        $properties = [];
        foreach ($reflect->getProperties() as $property) {
            $type = $property->getType();
            if ($type && method_exists($type, 'getName')) {
                $properties[$property->getName()] = $property->getType()->getName();
            }
        }

        return $properties;
    }
}
