<?php

/**
 * PHP Version 8.1
 * MapperException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/MapperException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * MapperException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/MapperException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class MapperException extends MappingException
{
    /**
     * Constructor.
     *
     * @param string $class   class
     * @param string $toClass toClass
     *
     * @return void
     */
    public function __construct(string $class = null, string $toClass)
    {
        $text = sprintf(
            SystemExceptionMessage::MAPPER_FAILURE[
                AppConstants::MESSAGE
            ],
            $class,
            $toClass
        );

        $exceptionDetail = [
            AppConstants::CODE => SystemExceptionMessage::MAPPER_FAILURE[
                AppConstants::CODE
            ],
            AppConstants::MESSAGE => $text,
        ];

        parent::__construct($exceptionDetail);
    }
}
