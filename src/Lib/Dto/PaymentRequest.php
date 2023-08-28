<?php

/**
 * PHP Version 8.1
 * PaymentRequest.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/PaymentRequest.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto;

use JMS\Serializer\Annotation as Serializer;

/**
 * PaymentRequest.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/PaymentRequest.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class PaymentRequest extends VerifyRequest
{
    /**
     * ExternalId
     *
     * @Serializer\Type("string")
     */
    public ?string $externalId = null;

    /**
     * RequestId
     *
     * @Serializer\Type("string")
     */
    public ?string $requestId = null;

    /**
     * ApplicationId
     *
     * @Serializer\Type("string")
     */
    public ?string $applicationId = null;

    /**
     * FinancialId
     *
     * @Serializer\Type("string")
     */
    public ?string $financialId = null;

    /**
     * AccountNumber
     *
     * @Serializer\Type("string")
     */
    public ?string $accountNumber = null;

    /**
     * AccountName
     *
     * @Serializer\Type("string")
     */
    public ?string $accountName = null;

    /**
     * CallBackUrl
     *
     * @Serializer\Type("string")
     */
    public ?string $callbackUrl = null;
}
