<?php

/**
 * PHP Version 8.1
 * OptionRequestMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/OptionRequestMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Mapper;

use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Option;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\OptionRequestMapper as OpReqM;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\OptionRequestCollection;

/**
 * OptionRequestMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/OptionRequestMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @codingStandardsIgnoreStart
 * @template-extends    Mapper<OptionRequest, Option, OptionRequestCollection, OptionCollection>
 * @codingStandardsIgnoreEnd
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class OptionRequestMapper extends Mapper implements OpReqM
{
    /**
     * Constructor.
     *
     * @param string $entityClass   entityClass
     * @param string $dtoClass      dtoClass
     * @param string $entitiesClass entitiesClass
     * @param string $dtosClass     dtosClass
     *
     * @return void
     */
    public function __construct(
        string $entityClass = Option::class,
        string $dtoClass = OptionRequest::class,
        string $entitiesClass = OptionCollection::class,
        string $dtosClass = OptionRequestCollection::class
    ) {
        $this->entityClass = $entityClass;
        $this->dtoClass = $dtoClass;
        $this->entitiesClass = $entitiesClass;
        $this->dtosClass = $dtosClass;
    }
}
