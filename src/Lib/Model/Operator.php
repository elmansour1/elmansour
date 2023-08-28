<?php

/**
 * PHP Version 8.1
 * Operator.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/Operator.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model;

/**
 * Operator.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/Operator.php
 *
 * @SuppressWarnings(PHPMD.Superglobals)
 * @SuppressWarnings(PHPMD.ShortVariable)
 *
 * @psalm-suppress MissingConstructor
 */
class Operator
{
    public int $id;
    public string $name;
    public string $slug;
    public string $logoUrl;
    public string $endpoint;
    public string $regex;
    public string $countrycode;
    public bool $manual;
    public bool $comingSoon;
    public bool $alertSeuil;
    public bool $balanceManual;
    public ?float $balance;
    public ?float $balanceMin;
    public ?string $emails;
}
