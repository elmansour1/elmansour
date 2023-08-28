<?php

/**
 * PHP Version 8.1
 * OptionResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/OptionResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto;

/**
 * OptionResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/OptionResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class OptionResponse extends BasicResponse
{
    /**
     * Constructor.
     *
     * @param OptionDTO $response response
     *
     * @return void
     */
    public function __construct(OptionDTO $response)
    {
        parent::__construct($response);
    }
}
