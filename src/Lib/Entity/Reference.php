<?php

/**
 * PHP Version 8.1
 * Reference.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Entity/Reference.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\BaseEntity;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\Collection;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;

/**
 * Reference.
 *
 * @category Entity
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Entity/Reference.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class Reference extends BaseEntity
{
    public int $id;
    public int $referenceId;
    public string $referenceNumber;
    public ?float $amount = null;
    public ?\DateTime $generationDate;
    public ?\DateTime $expirationDate;
    public ?string $name;
    /**
     * Options.
     *
     * @var Collection<Option>|OptionCollection|null
     */
    public Collection|OptionCollection|null $options = null;
}
