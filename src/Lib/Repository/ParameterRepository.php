<?php

/**
 * PHP Version 8.1
 * ParameterRepository.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ParameterRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Parameter;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;

/**
 * ParameterRepository.
 *
 * @template-extends ServiceEntityRepositoryInterface<Parameter>
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/ParameterRepository.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface ParameterRepository extends ServiceEntityRepositoryInterface
{
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
    public function findOneBySlug(string $slug, bool $throw = true): ?Parameter;

    /**
     * FindOneByParameterId.
     *
     * @param int  $parameterId parameterId
     * @param bool $throw       throw
     *
     * @return Parameter|null
     *
     * @throws EntityNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneByParameterId(
        int $parameterId,
        bool $throw = true
    ): ?Parameter;

    /**
     * FindOneByParameterId.
     *
     * @param string $slug  slug
     * @param string $value value
     *
     * @return Parameter
     *
     * @throws \Exception
     */
    public function updateValue(string $slug, string $value): Parameter;
}
