<?php

/**
 * PHP Version 8.1
 * ReferenceMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/ReferenceMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Mapper;

use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Reference;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ReferenceDTO;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\ReferenceMapper as BaseRefM;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\ReferenceCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\ReferenceDTOCollection;

/**
 * ReferenceMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/ReferenceApiResponseMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @codingStandardsIgnoreStart
 * @template-extends BaseEntityMapper<ReferenceDTO, Reference, ReferenceDTOCollection, ReferenceCollection>
 * @codingStandardsIgnoreEnd
 */
class ReferenceMapper extends BaseEntityMapper implements BaseRefM
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
        string $entityClass = Reference::class,
        string $dtoClass = ReferenceDTO::class,
        string $entitiesClass = ReferenceCollection::class,
        string $dtosClass = ReferenceDTOCollection::class
    ) {
        parent::__construct($entityClass, $dtoClass, $entitiesClass, $dtosClass);
    }
}
