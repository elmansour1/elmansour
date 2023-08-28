<?php

/**
 * PHP Version 8.1
 * Option.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Entity/Option.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Entity;

use Afrikpaysas\SymfonyThirdpartyAdapter\Repository\OptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Option as BaseOption;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * Option.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Entity/Option.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class Option extends BaseOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(name: 'optionId', type: 'bigint', unique: true, nullable: false)]
    public int $optionId;

    #[ORM\Column(unique: true, nullable: false)]
    public string $name;

    #[ORM\Column(unique: true, nullable: false)]
    public string $slug;

    #[ORM\Column(nullable: false)]
    public float $amount;

    #[ORM\Column(name: 'createdDate', type: 'datetime', nullable: false)]
    public \DateTime $createdDate;

    #[ORM\Column(name: 'lastUpdatedDate', type: 'datetime', nullable: false)]
    public \DateTime $lastUpdatedDate;

    #[ORM\Column(nullable: false)]
    public Status $status;

    #[ORM\Column(nullable: true)]
    public ?string $reference;

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
        $this->status = Status::ENABLED;
    }
}
