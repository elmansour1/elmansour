<?php

/**
 * PHP Version 8.1
 * ReferenceService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/ReferenceService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ReferenceApiResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Reference;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadApiResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\LogicNotImplementedException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\MappingException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\ReferenceNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * ReferenceService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/ReferenceService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface ReferenceService
{
    /**
     * Create.
     *
     * @param Reference $reference reference
     *
     * @return Reference
     */
    public function create(Reference $reference): Reference;

    /**
     * CreateWith.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return Reference
     */
    public function createWith(string $referenceNumber): Reference;

    /**
     * FindByReferenceNumber.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return Reference
     */
    public function findByReferenceNumber(string $referenceNumber): Reference;

    /**
     * FindByApi.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @throws MappingException
     *
     * @return Reference
     */
    public function findByApi(string $referenceNumber): Reference;

    /**
     * GenerateReferenceResponse.
     *
     * @param string     $referenceNumber referenceNumber
     * @param array|null $data            data
     *
     * @return ReferenceApiResponse
     *
     * @throws BadApiResponse|PaymentAPIException|ReferenceNotFoundException|LogicNotImplementedException
     */
    public function generateReferenceResponse(
        string $referenceNumber,
        ?array $data
    ): ReferenceApiResponse;

    /**
     * GetAmount.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return float
     *
     * @throws \Exception
     */
    public function getAmount(string $referenceNumber): float;

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
    public function updateStatus(string $referenceNumber, Status $status): Reference;

    /**
     * TokenRequest.
     *
     * @param string $reference reference
     *
     * @return string|null
     *
     * @throws \Exception|NetworkException|GeneralNetworkException
     */
    public function tokenRequest(string $reference): string|null;

    /**
     * HeadersRequest.
     *
     * @param string $reference reference
     *
     * @return array|null
     */
    public function headersRequest(string $reference): ?array;

    /**
     * BodyRequest.
     *
     * @param string $reference reference
     *
     * @return array|null
     */
    public function bodyRequest(string $reference): ?array;

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
    ): bool;

    /**
     * ExistReference.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return bool
     */
    public function existReference(string $referenceNumber): bool;

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
    ): bool;

    /**
     * ExistFinalReference.
     *
     * @param string $referenceNumber referenceNumber
     *
     * @return bool
     */
    public function existFinalReference(string $referenceNumber): bool;
}
