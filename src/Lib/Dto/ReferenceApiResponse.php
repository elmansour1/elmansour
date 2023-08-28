<?php

/**
 * PHP Version 8.1
 * ReferenceApiResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/ReferenceApiResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto;

use JMS\Serializer\Annotation as Serializer;

/**
 * PHP Version 8.1
 * ReferenceApiResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/ReferenceApiResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ReferenceApiResponse
{
    /**
     * ReferenceNumber
     *
     * @Serializer\Type("string")
     */
    public ?string $referenceNumber = null;

    /**
     * GenerationDate
     *
     * @Serializer\Type("string")
     */
    public ?string $generationDate = null;

    /**
     * ExpirationDate
     *
     * @Serializer\Type("string")
     */
    public ?string $expirationDate = null;

    /**
     * Amount
     *
     * @Serializer\Type("float")
     */
    public ?string $amount = null;

    /**
     * Name
     *
     * @Serializer\Type("string")
     */
    public ?string $name = null;
}
