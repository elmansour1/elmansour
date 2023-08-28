<?php

/**
 * PHP Version 8.1
 * ParameterCollection.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ParameterCollection.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Parameter;

/**
 * ParameterCollection.
 *
 * @template-extends Collection<Parameter>
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ParameterCollection.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ParameterCollection extends Collection
{
    /**
     * Constructor.
     *
     * @param object|array $array         array
     * @param string       $class         class
     * @param int          $flags         flags
     * @param string       $iteratorClass iteratorClass
     *
     * @return void
     */
    public function __construct(
        object|array $array = [],
        string $class = Parameter::class,
        int $flags = 0,
        string $iteratorClass = 'ArrayIterator'
    ) {
        parent::__construct($array, $class, $flags, $iteratorClass);
    }
}
