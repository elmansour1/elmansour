<?php

/**
 * PHP Version 8.1
 * OptionController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/OptionController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionListResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\OptionException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\VerifyException;

/**
 * OptionController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Controller/OptionController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface OptionController
{
    /**
     * Create API.
     *
     * @param OptionRequest $request request
     *
     * @return OptionResponse
     *
     * @throws VerifyException|OptionException
     */
    public function create(OptionRequest $request): OptionResponse;

    /**
     * List API.
     *
     * @return OptionListResponse
     *
     * @throws VerifyException|OptionException
     */
    public function list(): OptionListResponse;
}
