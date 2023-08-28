<?php

/**
 * PHP Version 8.1
 * MapperConfigException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/MapperConfigException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * MapperConfigException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/MapperConfigException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class MapperConfigException extends MappingException
{
    /**
     * Constructor.
     *
     * @param string $class class
     *
     * @return void
     */
    public function __construct(string $class)
    {
        $text = sprintf(
            SystemExceptionMessage::MAPPER_CONFIG_FAILURE[
                AppConstants::MESSAGE
            ],
            $class
        );

        $exceptionDetail = [
            AppConstants::CODE => SystemExceptionMessage::MAPPER_CONFIG_FAILURE[
                AppConstants::CODE
            ],
            AppConstants::MESSAGE => $text,
        ];

        parent::__construct($exceptionDetail);
    }
}
