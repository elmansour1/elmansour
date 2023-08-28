<?php

/**
 * PHP Version 8.1
 * ConfigException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/ConfigException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * ConfigException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/ConfigException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ConfigException extends GeneralException
{
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $exceptionDetail = [
            AppConstants::CODE => SystemExceptionMessage::CONFIG_NOT_AUTHORIZED[
                AppConstants::CODE
            ],
            AppConstants::MESSAGE => SystemExceptionMessage::CONFIG_NOT_AUTHORIZED[
                AppConstants::MESSAGE
            ],
        ];

        parent::__construct($exceptionDetail);
    }
}
