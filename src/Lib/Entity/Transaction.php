<?php

/**
 * PHP Version 8.1
 * Transaction.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Entity/Transaction.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\BaseEntity;

/**
 * Transaction.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Entity/Transaction.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ShortVariable)
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class Transaction extends BaseEntity
{
    public int $id;
    public int $transactionId;
    public string $reference;
    public string $accountNumber;
    public string $accountName;
    public float $amount;
    public ?string $phone;
    public ?string $email;
    public ?string $option;
    public string $externalId;
    public string $requestId;
    public string $applicationId;
    public string $financialId;
    public ?string $providerId;
    public ?string $providerStatus;
    public ?string $providerDate;
    public ?string $providerMessage;
    public ?float $providerBalance;
    public ?string $callbackUrl;
    public ?Reference $referenceData;
}
