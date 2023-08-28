<?php

/**
 * PHP Version 8.1
 * ParameterEnvNotFoundException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/ParameterEnvNotFoundException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * ParameterEnvNotFoundException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/ParameterEnvNotFoundException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ParameterEnvNotFoundException extends GeneralException
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
            SystemExceptionMessage::PARAMETER_NOT_FOUND,
            $message,
            (int)SystemExceptionMessage::PARAMETER_NOT_FOUND[AppConstants::CODE]
        );
    }
}
