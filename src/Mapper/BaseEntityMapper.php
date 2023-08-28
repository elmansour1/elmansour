<?php

/**
 * PHP Version 8.1
 * BaseEntityMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/BaseEntityMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Mapper;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\BaseEntityMapper as BaseEntityM;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;

/**
 * BaseEntityMapper.
 *
 * @category Mapper
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Mapper
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Mapper/BaseEntityMapper.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @template T of object
 * @template K of object
 * @template Z of object
 * @template S of object
 *
 * @template-extends    Mapper<T, K, Z, S>
 * @template-implements BaseEntityM<T, K, Z, S>
 */
class BaseEntityMapper extends Mapper implements BaseEntityM
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
        string $entityClass = null,
        string $dtoClass = null,
        string $entitiesClass = null,
        string $dtosClass = null
    ) {
        parent::__construct(
            $entityClass,
            $dtoClass,
            $entitiesClass,
            $dtosClass,
            AppConstants::DEFAULT_KEY_DTO_CONVERTER
        );
    }
}
