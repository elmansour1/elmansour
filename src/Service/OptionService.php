<?php

/**
 * PHP Version 8.1
 * OptionService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/OptionService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MappingException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Afrikpaysas\SymfonyThirdpartyAdapter\Mapper\OptionRequestMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequestCollectionRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Option;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadReferenceException;
// @codingStandardsIgnoreLine
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\InvalidReferenceSlugOptionException as InvalidReferenceSlgOptxc;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\OptionAlreadyExistException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\OptionApiDisabledException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\OptionListEmptyException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\RequiredOptionAmountException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\RequiredOptionNameException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Collection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository\OptionRepository;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\OptionService as BaseOptServ;

/**
 * OptionService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/OptionService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class OptionService implements BaseOptServ
{
    protected OptionRepository $optionRepository;
    protected UtilService $utilService;
    protected OptionRequestMapper $optionRequestMapper;

    /**
     * Constructor.
     *
     * @param OptionRepository    $optionRepository    optionRepository
     * @param UtilService         $utilService         utilService
     * @param OptionRequestMapper $optionRequestMapper optionRequestMapper
     *
     * @return void
     */
    public function __construct(
        OptionRepository $optionRepository,
        UtilService $utilService,
        OptionRequestMapper $optionRequestMapper
    ) {
        $this->optionRepository = $optionRepository;
        $this->utilService = $utilService;
        $this->optionRequestMapper = $optionRequestMapper;
    }

    /**
     * Create.
     *
     * @param OptionRequest $request request
     *
     * @return Option
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function create(OptionRequest $request): Option
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['OPTION_ENABLED']) {
            throw new OptionApiDisabledException();
        }

        return $this->optionRepository->save($this->generateOption($request));
    }

    /**
     * CreateList.
     *
     * @param OptionRequestCollectionRequest $request request
     *
     * @return OptionCollection|Collection
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     */
    public function createList(
        OptionRequestCollectionRequest $request
    ): OptionCollection|Collection {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['OPTION_ENABLED']) {
            throw new OptionApiDisabledException();
        }

        $options = new OptionCollection();

        foreach ($request->all() as $value) {
            $options->add($this->generateOption($value));
        }

        return $this->optionRepository->saveList($options);
    }

    /**
     * List
     *
     * @param string|null $reference reference
     * @param bool        $throw     throw
     *
     * @return Collection<Option>|OptionCollection|null
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     *
     * @psalm-suppress RedundantCondition
     */
    public function list(
        ?string $reference = null,
        bool $throw = false
    ): Collection|OptionCollection|null {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['OPTION_ENABLED']) {
            throw new OptionApiDisabledException();
        }

        $condition = AppConstants::PARAMETER_FALSE_VALUE ==
            $_ENV['SEARCH_OPTION_WITH_REFERENCE'] &&
            $reference;

        if ($condition) {
            throw new OptionApiDisabledException();
        }

        $condition = AppConstants::PARAMETER_TRUE_VALUE ==
            $_ENV['SEARCH_OPTION_WITH_REFERENCE'] &&
            !preg_match($_ENV['REFERENCE_REGEX'], $reference ?? '');

        if ($condition) {
            throw new BadReferenceException($reference);
        }

        $options = null;

        $condition = AppConstants::PARAMETER_TRUE_VALUE ==
            $_ENV['SEARCH_OPTION_WITH_REFERENCE'];

        if ($condition) {
            $options = $this->optionRepository->findByReference(
                $reference ?? '',
                false
            );
        } elseif (true) {
            $options = $this->optionRepository->findAll(false);
        }

        $condition = !$options &&
            AppConstants::PARAMETER_TRUE_VALUE == $_ENV['OPTION_API_ENABLED'];

        if ($condition) {
            $options = $this->listApi($reference);
        }

        if ((!$options || $options->isEmpty()) && $throw) {
            throw new OptionListEmptyException();
        }

        return $options;
    }

    /**
     * ListApi.
     *
     * @param string|null $reference reference
     *
     * @return OptionCollection|null
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function listApi(?string $reference = null): ?OptionCollection
    {
        throw new OptionApiDisabledException();
    }

    /**
     * GenerateOption.
     *
     * @param OptionRequest $request request
     *
     * @return Option
     *
     * @throws \Exception|MappingException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function generateOption(OptionRequest $request): Option
    {
        if (!$request->name) {
            throw new RequiredOptionNameException();
        }

        if (!$request->amount) {
            throw new RequiredOptionAmountException();
        }

        if (!$request->slug) {
            $request->slug = $this->utilService->slugify($request->name);
        }

        if ($this->optionRepository->findOneBySlug($request->slug, false)) {
            throw new OptionAlreadyExistException($request->slug);
        }

        $condition = $request->reference &&
            !preg_match($_ENV['REFERENCE_REGEX'], $request->reference);

        if ($condition) {
            throw new BadReferenceException($request->reference);
        }

        $option = $this->optionRequestMapper->asEntity($request);

        return $option;
    }

    /**
     * FindByReferenceAndSlug.
     *
     * @param string $reference reference
     * @param string $slug      slug
     *
     * @return Option
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress NullableReturnStatement
     * @psalm-suppress InvalidNullableReturnType
     */
    public function findByReferenceAndSlug(string $reference, string $slug): Option
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['OPTION_ENABLED']) {
            throw new OptionApiDisabledException();
        }

        $condition = AppConstants::PARAMETER_TRUE_VALUE ==
            $_ENV['SEARCH_OPTION_WITH_REFERENCE']
            && !preg_match($_ENV['REFERENCE_REGEX'], $reference);

        if ($condition) {
            throw new BadReferenceException($reference);
        }

        $option = null;

        $searchRef = $_ENV['SEARCH_OPTION_WITH_REFERENCE'];

        $condition = AppConstants::PARAMETER_FALSE_VALUE == $searchRef;

        if ($condition) {
            $option = $this->optionRepository->findOneBySlug($slug);
        } elseif (AppConstants::PARAMETER_TRUE_VALUE == $searchRef) {
            $option = $this->optionRepository->findOneByReferenceAndSlug(
                $reference,
                $slug,
                false
            );
        }

        if (!$option) {
            if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['OPTION_API_ENABLED']) {
                throw new InvalidReferenceSlgOptxc($reference, $slug);
            }

            $this->listApi($reference);

            $option = $this->optionRepository->findOneByReferenceAndSlug(
                $reference,
                $slug
            );
        }

        return $option;
    }

    /**
     * FindOneBySlug.
     *
     * @param string $slug  slug
     * @param bool   $throw throw
     *
     * @return Option|null
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function findOneBySlug(string $slug, bool $throw = true): ?Option
    {
        return $this->optionRepository->findOneBySlug($slug, $throw);
    }

    /**
     * ExistOption.
     *
     * @param string $reference reference
     * @param string $slug      slug
     *
     * @return bool
     */
    public function existOption(string $reference, string $slug): bool
    {
        $option = $this->optionRepository->findOneByReferenceAndSlug(
            $reference,
            $slug,
            false
        );

        $result = false;

        if ($option) {
            $result = true;
        }

        return $result;
    }

    /**
     * ExistFinalOption.
     *
     * @param string $reference reference
     * @param string $slug      slug
     *
     * @return bool
     */
    public function existFinalOption(string $reference, string $slug): bool
    {
        $option = $this->optionRepository->findOneByReferenceAndSlug(
            $reference,
            $slug,
            false
        );

        $result = false;

        if ($option && Status::PENDING != $option->status) {
            $result = true;
        }

        return $result;
    }
}
