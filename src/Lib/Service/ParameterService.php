<?php

/**
 * PHP Version 8.1
 * ParameterService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/ParameterService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Parameter;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\ParameterEnvNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\ParameterNotFoundException;

/**
 * ParameterService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/ParameterService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface ParameterService
{
    /**
     * Get.
     *
     * @param string $key   key
     * @param bool   $throw throw
     *
     * @return string|null
     *
     * @throws ParameterNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function get(string $key, bool $throw = true): ?string;

    /**
     * GetEnv.
     *
     * @param string $key   key
     * @param bool   $throw throw
     *
     * @return array|bool|string|int|float|\UnitEnum|null
     *
     * @throws ParameterNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function getEnv(
        string $key,
        bool $throw = true
    ): array|bool|string|int|float|\UnitEnum|null;

    /**
     * GetParameter.
     *
     * @param string $key   key
     * @param bool   $throw throw
     *
     * @return Parameter|null
     *
     * @throws ParameterNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function getParameter(string $key, bool $throw = true): ?Parameter;

    /**
     * SetParameter.
     *
     * @param string $key   key
     * @param string $value value
     *
     * @return void
     *
     * @throws \Exception
     */
    public function setParameter(string $key, string $value): void;
}
