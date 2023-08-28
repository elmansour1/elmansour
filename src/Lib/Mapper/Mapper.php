<?php

/**
 * PHP Version 8.1
 * Mapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Mapper/Mapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MapperConfigException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MapperEmptyException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MapperException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MapperTypeException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Collection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * Mapper.
 *
 * @template T of object
 * @template K of object
 * @template Z of object
 * @template S of object
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Mapper/Mapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface Mapper
{
    /**
     * Get entity with Dto.
     *
     * @param T|null $dto dto
     *
     * @return K|null
     *
     * MapperException|MapperEmptyException|MapperConfigException
     */
    public function asEntity($dto);

    /**
     * Get Dto with entity.
     *
     * @param K|null $entity entity
     *
     * @return T|null
     *
     * MapperException|MapperEmptyException|MapperConfigException
     */
    public function asDTO($entity);

    /**
     * Get entities with dtos.
     *
     * @param Z|Collection<T>|null $dtos dtos
     *
     * @return S|Collection<K>|null
     *
     * MapperException|MapperEmptyException|MapperConfigException|MapperTypeException
     */
    public function asEntityList($dtos);

    /**
     * Get dtos with entities.
     *
     * @param S|Collection<K>|null $entities entities
     *
     * @return Z|Collection<T>|null
     *
     * MapperException|MapperEmptyException|MapperConfigException|MapperTypeException
     */
    public function asDTOList($entities);

    /**
     * ConvertToValue.
     * Convert entity attribute to dto value.
     *
     * @param string|int|float|\DateTime|Status|null $attribute attribute
     *
     * @return string|int|float|null
     */
    public function convertToValue(
        string|int|float|\DateTime|Status|null $attribute
    ): string|int|float|null;

    /**
     * ConvertToAttribute.
     * Convert dto value to entity attribute.
     *
     * @param string|int|float|null $value value
     * @param string|null           $class class
     *
     * @return string|int|float|\DateTime|Status|null
     */
    public function convertToAttribute(
        string|int|float|null $value,
        ?string $class = null
    ): string|int|float|\DateTime|Status|null;
}
