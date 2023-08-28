<?php

/**
 * PHP Version 8.1
 * ConfigController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/ConfigController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ArrayResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\ConfigException;

/**
 * ConfigController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/ConfigController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface ConfigController
{
    /**
     * Parameters API.
     *
     * @return ArrayResponse
     *
     * @throws ConfigException
     */
    public function parameters(): ArrayResponse;

    /**
     * Exceptions API.
     *
     * @return ArrayResponse
     */
    public function exceptions(): ArrayResponse;
}
