<?php

/**
 * PHP Version 8.1
 * OptionService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/OptionService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequestCollectionRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Option;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MappingException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Collection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;

/**
 * OptionService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/OptionService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface OptionService
{
    /**
     * Create.
     *
     * @param OptionRequest $request request
     *
     * @return Option
     *
     * @throws \Exception
     */
    public function create(OptionRequest $request): Option;

    /**
     * CreateList.
     *
     * @param OptionRequestCollectionRequest $request request
     *
     * @return OptionCollection|Collection
     *
     * @throws \Exception
     */
    public function createList(
        OptionRequestCollectionRequest $request
    ): OptionCollection|Collection;

    /**
     * List.
     *
     * @param string|null $reference reference
     * @param bool        $throw     throw
     *
     * @return Collection<Option>|OptionCollection|null
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function list(
        ?string $reference = null,
        bool $throw = false
    ): Collection|OptionCollection|null;

    /**
     * ListApi.
     *
     * @param string|null $reference reference
     *
     * @return OptionCollection|null
     *
     * @throws \Exception
     */
    public function listApi(?string $reference = null): ?OptionCollection;

    /**
     * GenerateOption.
     *
     * @param OptionRequest $request request
     *
     * @return Option
     *
     * @throws \Exception|MappingException
     */
    public function generateOption(OptionRequest $request): Option;

    /**
     * FindByReferenceAndSlug.
     *
     * @param string $reference reference
     * @param string $slug      slug
     *
     * @return Option
     */
    public function findByReferenceAndSlug(string $reference, string $slug): Option;

    /**
     * FindByReferenceAndSlug.
     *
     * @param string $slug  slug
     * @param bool   $throw throw
     *
     * @return Option|null
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneBySlug(string $slug, bool $throw = true): ?Option;

    /**
     * ExistOption.
     *
     * @param string $reference reference
     * @param string $slug      slug
     *
     * @return bool
     */
    public function existOption(string $reference, string $slug): bool;

    /**
     * ExistFinalOption.
     *
     * @param string $reference reference
     * @param string $slug      slug
     *
     * @return bool
     */
    public function existFinalOption(string $reference, string $slug): bool;
}
