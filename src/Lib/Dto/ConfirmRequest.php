<?php

/**
 * PHP Version 8.1
 * ConfirmRequest.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/ConfirmRequest.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto;

use JMS\Serializer\Annotation as Serializer;

/**
 * ConfirmRequest.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/ConfirmRequest.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ConfirmRequest
{
    /**
     * TransactionId
     *
     * @Serializer\Type("int")
     */
    public ?int $transactionId = null;

    /**
     * ProviderId
     *
     * @Serializer\Type("string")
     */
    public ?string $providerId = null;
}
