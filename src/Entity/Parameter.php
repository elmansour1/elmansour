<?php

/**
 * PHP Version 8.1
 * Parameter.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Entity/Parameter.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Entity;

use Afrikpaysas\SymfonyThirdpartyAdapter\Repository\ParameterRepository;
use Doctrine\ORM\Mapping as ORM;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Parameter as BaseParameter;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * Parameter.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Entity/Parameter.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class Parameter extends BaseParameter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(name: 'parameterId', type: 'bigint', unique: true, nullable: false)]
    public int $parameterId;

    #[ORM\Column(name: 'name', unique: true, nullable: false)]
    public string $name;

    #[ORM\Column(name: 'slug', unique: true, nullable: false)]
    public string $slug;

    #[ORM\Column(name: 'value', nullable: false)]
    public string $value;

    #[ORM\Column(name: 'createdDate', type: 'datetime', nullable: false)]
    public \DateTime $createdDate;

    #[ORM\Column(name: 'lastUpdatedDate', type: 'datetime', nullable: false)]
    public \DateTime $lastUpdatedDate;

    #[ORM\Column(nullable: false)]
    public Status $status;

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
