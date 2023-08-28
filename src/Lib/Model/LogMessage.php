<?php

/**
 * PHP Version 8.1
 * LogMessage.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/LogMessage.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model;

use Psr\Log\LogLevel;

/**
 * LogMessage.
 *
 * @category Model
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Model/LogMessage.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
final class LogMessage
{
    public const APP_DEFAULT = [
        AppConstants::MESSAGE_START => 'Starting Application status verification',
        AppConstants::MESSAGE_END => 'Application successfuly verified'
    ];
}
