<?php

/**
 * PHP Version 8.1
 * Collection.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/Collection.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\CollectionCastException;
// @codingStandardsIgnoreLine
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\InvalidTypeCollectionException as InvalidTypeCollectionExc;

/**
 * Collection.
 *
 * @template T of object
 *
 * @extends \ArrayObject<string, T>
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/Collection.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PossiblyInvalidArgument
 * @psalm-suppress ArgumentTypeCoercion
 */
class Collection extends \ArrayObject
{
    protected ?string $class;

    /**
     * Constructor.
     *
     * @param object|array $array         array
     * @param string|null  $class         class
     * @param int          $flags         flags
     * @param string       $iteratorClass iteratorClass
     *
     * @return void
     */
    public function __construct(
        object|array $array = [],
        ?string $class = null,
        int $flags = 0,
        string $iteratorClass = 'ArrayIterator'
    ) {
        $this->class = $class;
        parent::__construct($array, $flags, $iteratorClass);
    }

    /**
     * Add.
     *
     * @param T $value value
     *
     * @return void
     */
    public function add($value): void
    {
        if (!($value instanceof $this->class)) {
            throw new InvalidTypeCollectionExc(
                get_class($value),
                $this->class
            );
        }
        parent::append($value);
    }

    /**
     * Set.
     *
     * @param string $key   key
     * @param T      $value value
     *
     * @return void
     */
    public function set(string $key, $value): void
    {
        if (!($value instanceof $this->class)) {
            throw new InvalidTypeCollectionExc(
                get_class($value),
                $this->class
            );
        }
        parent::offsetSet($key, $value);
    }

    /**
     * Get.
     *
     * @param string $key key
     *
     * @return T $value
     *
     * @throws CollectionCastException
     */
    public function get(string $key)
    {
        return $this->cast(parent::offsetGet($key));
    }

    /**
     * Exists.
     *
     * @param string $key key
     *
     * @return bool
     */
    public function exists(string $key): bool
    {
        return parent::offsetExists($key);
    }

    /**
     * Count.
     *
     * @return int
     */
    public function count(): int
    {
        return parent::count();
    }

    /**
     * All.
     *
     * @return array
     */
    public function all(): array
    {
        return parent::getArrayCopy();
    }

    /**
     * First.
     *
     * @return T $value
     *
     * @throws CollectionCastException
     */
    public function first()
    {
        return $this->cast($this->all()[0]);
    }

    /**
     * Cast
     *
     * @param mixed $instance instance
     *
     * @return T $value
     *
     * @throws CollectionCastException
     *
     * @psalm-suppress MixedInferredReturnType
     * @psalm-suppress MixedReturnStatement
     */
    public function cast(mixed $instance)
    {
        if (!$this->class) {
            throw new CollectionCastException(get_class($this));
        }

        return unserialize(
            sprintf(
                'O:%d:"%s"%s',
                \strlen($this->class),
                $this->class,
                strstr(
                    strstr(
                        serialize($instance),
                        '"'
                    ),
                    ':'
                )
            )
        );
    }

    /**
     * IsEmpty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->all());
    }
}
