<?php

/**
 * PHP Version 8.1
 * MapperEmptyException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/MapperEmptyException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * MapperEmptyException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/MapperEmptyException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class MapperEmptyException extends MappingException
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
            SystemExceptionMessage::MAPPER_EMPTY_FAILURE[
                AppConstants::MESSAGE
            ],
            $class
        );

        $exceptionDetail = [
            AppConstants::CODE => SystemExceptionMessage::MAPPER_EMPTY_FAILURE[
                AppConstants::CODE
            ],
            AppConstants::MESSAGE => $text,
        ];

        parent::__construct($exceptionDetail);
    }
}
