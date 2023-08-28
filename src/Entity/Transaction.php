<?php

/**
 * PHP Version 8.1
 * Transaction.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Entity/Transaction.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Entity;

use Afrikpaysas\SymfonyThirdpartyAdapter\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * Transaction.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Entity/Transaction.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.TooManyFields)
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class Transaction extends BaseTransaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(
        name: 'transactionId',
        type: 'bigint',
        unique: true,
        nullable: false
    )]
    public int $transactionId;

    #[ORM\Column(length: 255, nullable: false)]
    public string $reference;

    #[ORM\Column(name: 'accountNumber', length: 255, nullable: false)]
    public string $accountNumber;

    #[ORM\Column(name: 'accountName', length: 255, nullable: false)]
    public string $accountName;

    #[ORM\Column(nullable: false)]
    public float $amount;

    #[ORM\Column(name: 'createdDate', type: 'datetime', nullable: false)]
    public \DateTime $createdDate;

    #[ORM\Column(name: 'lastUpdatedDate', type: 'datetime', nullable: false)]
    public \DateTime $lastUpdatedDate;

    #[ORM\Column(nullable: false)]
    public Status $status;

    #[ORM\Column(nullable: true)]
    public ?string $phone;

    #[ORM\Column(nullable: true)]
    public ?string $email;

    #[ORM\Column(name: 'optionSlug', nullable: true)]
    public ?string $option;

    #[ORM\Column(name: 'externalId', unique: true, nullable: false)]
    public string $externalId;

    #[ORM\Column(name: 'requestId', unique: true, nullable: false)]
    public string $requestId;

    #[ORM\Column(name: 'applicationId', unique: true, nullable: false)]
    public string $applicationId;

    #[ORM\Column(name: 'financialId', unique: true, nullable: false)]
    public string $financialId;

    #[ORM\Column(name: 'providerId', unique: true, nullable: true)]
    public ?string $providerId = null;

    #[ORM\Column(name: 'providerStatus', nullable: true)]
    public ?string $providerStatus;

    #[ORM\Column(name: 'providerDate', nullable: true)]
    public ?string $providerDate;

    #[ORM\Column(name: 'providerMessage', nullable: true)]
    public ?string $providerMessage;

    #[ORM\Column(name: 'providerBalance', nullable: true)]
    public ?float $providerBalance;

    #[ORM\Column(name: 'callbackUrl', nullable: true)]
    public ?string $callbackUrl;

    /**
     * Constructor.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
    }
}
