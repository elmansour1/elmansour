<?php

/**
 * PHP Version 8.1
 * ReferenceApiResponseCollection.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ReferenceApiResponseCollection.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ReferenceApiResponse;

/**
 * ReferenceApiResponseCollection.
 *
 * @template-extends Collection<ReferenceApiResponse>
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ReferenceApiResponseCollection.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ReferenceApiResponseCollection extends Collection
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
        string $class = ReferenceApiResponse::class,
        int $flags = 0,
        string $iteratorClass = 'ArrayIterator'
    ) {
        parent::__construct($array, $class, $flags, $iteratorClass);
    }
}
