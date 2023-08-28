<?php

/**
 * PHP Version 8.1
 * VerifyResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/VerifyResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;

/**
 * PHP Version 8.1
 * VerifyResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/VerifyResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class VerifyResponse extends MessageResponse
{
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(AppConstants::SUCCESS_MESSAGE);
    }
}
