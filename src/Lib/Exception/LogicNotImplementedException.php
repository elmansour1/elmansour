<?php

/**
 * PHP Version 8.1
 * LogicNotImplementedException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/LogicNotImplementedException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * LogicNotImplementedException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/LogicNotImplementedException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class LogicNotImplementedException extends GeneralException
{
    /**
     * Constructor.
     *
     * @param string|null $message message
     *
     * @return void
     */
    public function __construct(string $message = null)
    {
        parent::__construct(
            SystemExceptionMessage::LOGIC_NOT_IMPLEMETED,
            $message,
            (int)SystemExceptionMessage::LOGIC_NOT_IMPLEMETED[AppConstants::CODE]
        );
    }
}
