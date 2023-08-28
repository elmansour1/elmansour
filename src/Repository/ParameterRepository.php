<?php

/**
 * PHP Version 8.1
 * ParameterRepository.
 *
 * @category Repository
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Repository
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Repository/OptionRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Repository;

use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\ParameterCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository\ParameterRepository as ParRp;

/**
 * ParameterRepository.
 *
 * @template-extends    Repository<Parameter>
 * @template-implements ParRp
 *
 * @category Repository
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Repository
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Repository/OptionRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ParameterRepository extends Repository implements ParRp
{
    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry        registry
     * @param string          $entityClass     entityClass
     * @param string          $collectionClass collectionClass
     *
     * @return void
     */
    public function __construct(
        ManagerRegistry $registry,
        string $entityClass = Parameter::class,
        string $collectionClass = ParameterCollection::class
    ) {
        parent::__construct(
            $registry,
            $entityClass,
            $collectionClass
        );
    }

    /**
     * FindOneByParameterId.
     *
     * @param int  $parameterId parameterId
     * @param bool $throw       throw
     *
     * @return Parameter|null
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     *
     * @throws EntityNotFoundException
     */
    public function findOneByParameterId(
        int $parameterId,
        bool $throw = true
    ): ?Parameter {
        return parent::findOneWith(
            [AppConstants::PARAMETER_ID => $parameterId],
            $throw
        );
    }

    /**
     * FindOneBySlug.
     *
     * @param string $slug  slug
     * @param bool   $throw throw
     *
     * @return Parameter|null
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneBySlug(
        string $slug,
        bool $throw = true
    ): ?Parameter {
        return parent::findOneWith([AppConstants::SLUG => $slug], $throw);
    }

    /**
     * UpdateValue.
     *
     * @param string $slug  slug
     * @param bool   $value value
     *
     * @return Parameter
     *
     * @throws EntityNotFoundException
     */
    public function updateValue(string $slug, string $value): Parameter
    {
        return parent::updateWith(
            AppConstants::SLUG,
            $slug,
            AppConstants::SLUG,
            $value
        );
    }
}
