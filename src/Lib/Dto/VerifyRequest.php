<?php

/**
 * PHP Version 8.1
 * AppResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/AppResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto;

use JMS\Serializer\Annotation as Serializer;

/**
 * PHP Version 8.1
 * VerifyRequest.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/VerifyRequest.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class VerifyRequest
{
    /**
     * Reference
     *
     * @Serializer\Type("string")
     */
    public ?string $reference = null;

    /**
     * Amount
     *
     * @Serializer\Type("float")
     */
    public ?float $amount = null;

    /**
     * Phone
     *
     * @Serializer\Type("string")
     */
    public ?string $phone = null;

    /**
     * Email
     *
     * @Serializer\Type("string")
     */
    public ?string $email = null;

    /**
     * Option
     *
     * @Serializer\Type("string")
     */
    public ?string $option = null;
}
