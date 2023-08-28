<?php

/**
 * PHP Version 8.1
 * ReferenceService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/ReferenceService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MappingException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Mapper\ReferenceApiResponseMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\Reference as ReferenceDTO;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ReferenceApiResponse as BRfRep;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Reference;
use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Reference as EntityReference;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadApiResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\ReferenceNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository\ReferenceRepository;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\HttpService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\OptionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService as RefS;

/**
 * ReferenceService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/ReferenceService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.Superglobals)
 */
class ReferenceService implements RefS
{
    protected ReferenceRepository $referenceRepository;
    protected OptionService $optionService;
    protected HttpService $httpService;
    protected VerifyService $verifyService;
    protected ReferenceApiResponseMapper $referenceApiMapper;

    /**
     * Constructor.
     *
     * @param ReferenceRepository        $referenceRepository referenceRepository
     * @param OptionService              $optionService       optionService
     * @param HttpService                $httpService         httpService
     * @param VerifyService              $verifyService       verifyService
     * @param ReferenceApiResponseMapper $referenceApiMapper  referenceApiMapper
     */
    public function __construct(
        ReferenceRepository $referenceRepository,
        OptionService $optionService,
        HttpService $httpService,
        VerifyService $verifyService,
        ReferenceApiResponseMapper $referenceApiMapper
    ) {
        $this->referenceRepository = $referenceRepository;
        $this->optionService = $optionService;
        $this->httpService = $httpService;
        $this->verifyService = $verifyService;
        $this->referenceApiMapper = $referenceApiMapper;
    }

    /**
     * Create.
     *
     * @param Reference $reference reference
     *
     * @return Reference
     */
    public function create(Reference $reference): Reference
    {
        $this->verifyService->verifyReferenceAPI();

        return $this->referenceRepository->save($reference);
    }

    /**
     * CreateWith.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return Reference
     */
    public function createWith(string $referenceNumber): Reference
    {
        $this->verifyService->verifyReferenceAPI();
        $this->verifyService->verifyReference($referenceNumber);

        $reference = new EntityReference();
        $reference->referenceNumber = $referenceNumber;

        return $this->referenceRepository->save($reference);
    }

    /**
     * FindByReferenceNumber.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return Reference
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function findByReferenceNumber(string $referenceNumber): Reference
    {
        $this->verifyService->verifyReferenceAPI();
        $this->verifyService->verifyReference($referenceNumber);

        $reference = $this->referenceRepository->findOneByReferenceNumber(
            $referenceNumber,
            false
        );

        if (!$reference) {
            $reference = $this->findByApi($referenceNumber);
            $reference = $this->referenceRepository->save($reference);
        }

        $condition = AppConstants::PARAMETER_TRUE_VALUE
            == $_ENV['OPTION_ENABLED'] &&
            AppConstants::PARAMETER_TRUE_VALUE
            == $_ENV['SEARCH_OPTION_WITH_REFERENCE'];

        if ($condition) {
            $reference->options = $this->optionService->list($referenceNumber);
        }

        return $reference;
    }

    /**
     * FindByApi.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return Reference
     *
     * @throws \Exception|MappingException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function findByApi(string $referenceNumber): Reference
    {
        $bodyRequest = $this->bodyRequest($referenceNumber);
        $headersRequest = $this->headersRequest($referenceNumber);
        $tokenRequest = null;
        if ($_ENV['API_TOKEN']) {
            $tokenRequest = $this->tokenRequest($referenceNumber);
        }

        $data = null;

        if ($_ENV['API_REFERENCE']) {
            $data = $this->httpService->sendGetWithTokenSet(
                $_ENV['API_REFERENCE'],
                $bodyRequest,
                $headersRequest,
                $tokenRequest
            );
        }

        $response = $this->generateReferenceResponse(
            $referenceNumber,
            $data
        );

        $reference = $this->referenceApiMapper->asEntity($response);

        return $reference;
    }

    /**
     * GetAmount.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return float
     *
     * @throws \Exception
     *
     * @psalm-suppress NullableReturnStatement
     * @psalm-suppress InvalidNullableReturnType
     */
    public function getAmount(string $referenceNumber): float
    {
        $amount = $this->findByReferenceNumber($referenceNumber)->amount;
        $this->verifyService->verifyAmount($amount);

        return $amount;
    }

    /**
     * GenerateReferenceResponse.
     *
     * @param string     $referenceNumber referenceNumber
     * @param array|null $data            data
     *
     * @return BRfRep
     *
     * @throws BadApiResponse|PaymentAPIException|ReferenceNotFoundException|LogicNotImplementedException
     *
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedArgument
     */
    public function generateReferenceResponse(
        string $referenceNumber,
        ?array $data
    ): BRfRep {
        throw new LogicNotImplementedException(__FUNCTION__);
    }

    /**
     * UpdateStatus.
     *
     * @param string $referenceNumber referenceNumber
     * @param Status $status          status
     *
     * @return Reference
     *
     * @throws \Exception
     */
    public function updateStatus(string $referenceNumber, Status $status): Reference
    {
        return $this->referenceRepository->updateStatus($referenceNumber, $status);
    }

    /**
     * TokenRequest.
     *
     * @param string $reference reference
     *
     * @return string|null
     *
     * @throws \Exception|NetworkException|GeneralNetworkException
     */
    public function tokenRequest(string $reference): string|null
    {
        return $this->httpService->getToken([]);
    }

    /**
     * HeadersRequest.
     *
     * @param string $reference reference
     *
     * @return array|null
     */
    public function headersRequest(string $reference): ?array
    {
        return [];
    }

    /**
     * BodyRequest.
     *
     * @param string $reference reference
     *
     * @return array|null
     */
    public function bodyRequest(string $reference): ?array
    {
        return [
            AppConstants::REFERENCE => $reference
        ];
    }

    /**
     * ExistReferenceWithOption.
     *
     * @param string      $referenceNumber referenceNumber
     * @param string|null $option          option
     *
     * @return bool
     */
    public function existReferenceWithOption(
        string $referenceNumber,
        ?string $option = null
    ): bool {
        $result = false;

        if ($this->existReference($referenceNumber)) {
            $result = true;
        }

        $condition = $result && AppConstants::PARAMETER_TRUE_VALUE == $_ENV['OPTION_ENABLED'];

        if ($condition) {
            $result = $this->optionService->existOption($referenceNumber, $option ?? '');
        }

        return $result;
    }

    /**
     * ExistReference.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return bool
     */
    public function existReference(string $referenceNumber): bool
    {
        $reference = $this->referenceRepository->findOneByReferenceNumber(
            $referenceNumber,
            false
        );

        $result = false;

        if ($reference) {
            $result = true;
        }

        return $result;
    }

    /**
     * ExistFinalReferenceWithOption.
     *
     * @param string      $referenceNumber referenceNumber
     * @param string|null $option          option
     *
     * @return bool
     */
    public function existFinalReferenceWithOption(
        string $referenceNumber,
        ?string $option = null
    ): bool {
        $result = false;

        if ($this->existFinalReference($referenceNumber)) {
            $result = true;
        }

        $condition = $result && AppConstants::PARAMETER_TRUE_VALUE == $_ENV['OPTION_PAY_ENABLED'];

        if ($condition) {
            $result = $this->optionService->existFinalOption($referenceNumber, $option ?? '');
        }

        return $result;
    }

    /**
     * ExistFinalReference.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return bool
     */
    public function existFinalReference(string $referenceNumber): bool
    {
        $reference = $this->referenceRepository->findOneByReferenceNumber(
            $referenceNumber,
            false
        );

        $result = false;

        if ($reference && Status::PENDING != $reference->status) {
            $result = true;
        }

        return $result;
    }
}
