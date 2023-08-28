<?php

/**
 * PHP Version 8.1
 * Status.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/Status.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model;

/**
 * Status.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/Status.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
enum Status: string
{
    case PENDING = 'PENDING';
    case PROGRESS = 'PROGRESS';
    case SUCCESS = 'SUCCESS';
    case ENABLED = 'ENABLED';
    case FAILED = 'FAILED';
    case CANCELED = 'CANCELED';
}
