<?php

/**
 * PHP Version 8.1
 * BaseEntity.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/BaseEntity.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model;

use DateTime;
use DateTimeZone;

/**
 * BaseEntity.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/BaseEntity.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class BaseEntity
{
    public DateTime $createdDate;
    public DateTime $lastUpdatedDate;
    public DateTime $date;
    public Status $status;

    /**
     * Constructor.
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @return void
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdDate = new DateTime(
            $_ENV['DEFAULT_DATE_TIME'],
            new DateTimeZone($_ENV['TIME_ZONE'])
        );
        $this->lastUpdatedDate = $this->createdDate;
        $this->date = $this->lastUpdatedDate;
        $this->status = Status::PENDING;
    }

    /**
     * ToArray.
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * ToEmailString.
     *
     * @param string|null $title title
     *
     * @return string
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress MixedAssignment
     */
    public function toEmailString(?string $title = null): string
    {
        $inline = $_ENV['EMAIL_TEMPLATING_INLINE'];
        $text = "$title$inline";

        foreach ($this->toArray() as $key => $value) {
            if ($value instanceof DateTime) {
                $value = $value->format($_ENV['API_DATE_FORMAT']);
            } elseif ($value instanceof Status) {
                $value = $value->value;
            } elseif ($value instanceof BaseEntity) {
                $value = $value->toEmailString();
            } elseif (is_object($value)) {
                $value = $_ENV['EMAIL_TEMPLATING_OBJECT'];
            }
            $text .= "$key : $value$inline";
        }

        return $text;
    }
}
