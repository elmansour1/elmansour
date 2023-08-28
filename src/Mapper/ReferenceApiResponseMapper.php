<?php

/**
 * PHP Version 8.1
 * ReferenceApiResponseMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/ReferenceApiResponseMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Mapper;

use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Reference;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ReferenceApiResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\ReferenceApiResponseMapper as AM;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\ReferenceApiResponseCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\ReferenceCollection;

/**
 * ReferenceApiResponseMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/ReferenceApiResponseMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 *
 * @codingStandardsIgnoreStart
 * @template-extends Mapper<ReferenceApiResponse, Reference, ReferenceApiResponseCollection, ReferenceCollection>
 * @codingStandardsIgnoreEnd
 */
class ReferenceApiResponseMapper extends Mapper implements AM
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
        string $dtoClass = ReferenceApiResponse::class,
        string $entitiesClass = ReferenceCollection::class,
        string $dtosClass = ReferenceApiResponseCollection::class
    ) {
        $this->entityClass = $entityClass;
        $this->dtoClass = $dtoClass;
        $this->entitiesClass = $entitiesClass;
        $this->dtosClass = $dtosClass;
    }
}
