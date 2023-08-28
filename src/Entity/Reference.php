<?php

/**
 * PHP Version 8.1
 * Reference.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Entity/Reference.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Entity;

use Afrikpaysas\SymfonyThirdpartyAdapter\Repository\ReferenceRepository;
use Doctrine\ORM\Mapping as ORM;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Reference as BaseReference;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * Reference.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Entity/Reference.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class Reference extends BaseReference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(name: 'referenceId', type: 'bigint', unique: true, nullable: false)]
    public int $referenceId;

    #[ORM\Column(name: 'referenceNumber', unique: true, nullable: false)]
    public string $referenceNumber;

    #[ORM\Column(nullable: true)]
    public ?float $amount = null;

    #[ORM\Column(name: 'createdDate', type: 'datetime', nullable: false)]
    public \DateTime $createdDate;

    #[ORM\Column(name: 'lastUpdatedDate', type: 'datetime', nullable: false)]
    public \DateTime $lastUpdatedDate;

    #[ORM\Column(nullable: false)]
    public Status $status;

    #[ORM\Column(name: 'generationDate', type: 'datetime', nullable: true)]
    public ?\DateTime $generationDate;

    #[ORM\Column(name: 'expirationDate', type: 'datetime', nullable: true)]
    public ?\DateTime $expirationDate;

    #[ORM\Column(name: 'name', type: 'string', nullable: true)]
    public ?string $name;

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
