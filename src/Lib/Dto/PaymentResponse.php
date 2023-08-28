<?php

/**
 * PHP Version 8.1
 * PaymentResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/PaymentResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * PaymentResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/PaymentResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class PaymentResponse extends JsonResponse
{
    public ?PaymentResponseDTO $paymentResponseDTO = null;

    /**
     * Constructor.
     *
     * @param TransactionDTO    $transactionDTO transactionDTO
     * @param ReferenceDTO|null $referenceDTO   referenceDTO
     *
     * @return void
     *
     * @psalm-suppress PossiblyInvalidArgument
     */
    public function __construct(
        TransactionDTO $transactionDTO,
        ?ReferenceDTO $referenceDTO
    ) {
        $this->paymentResponseDTO = new PaymentResponseDTO();

        $this->paymentResponseDTO->code = AppConstants::SUCCESS_CODE;
        $this->paymentResponseDTO->message = AppConstants::SUCCESS_MESSAGE;

        $this->paymentResponseDTO->result = $transactionDTO;
        $this->paymentResponseDTO->referenceData = $referenceDTO;

        $this->paymentResponseDTO->transactionId = $transactionDTO->transactionId;
        $this->paymentResponseDTO->providerId = $transactionDTO->providerId;
        $this->paymentResponseDTO->requestId = $transactionDTO->requestId;
        $this->paymentResponseDTO->financialId = $transactionDTO->financialId;
        $this->paymentResponseDTO->externalId = $transactionDTO->externalId;
        $this->paymentResponseDTO->applicationId = $transactionDTO->applicationId;

        parent::__construct($this->paymentResponseDTO);
    }
}
