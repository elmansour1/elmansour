<?php

/**
 * PHP Version 8.1
 * ConvertFactory
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/ConvertFactory.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Converter\BasicConverter;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ConfirmRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ConverterFactory as BaseConverterFactory;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;

/**
 * ConvertFactory.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/ConvertFactory.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ConvertFactory implements BaseConverterFactory
{
    /**
     * GenerateConverter.
     *
     * @param string $converterClass converterClass
     * @param string $requestClass   requestClass
     *
     * @return BasicConverter
     *
     * @throws \Exception
     */
    public function generateConverter(string $converterClass, string $requestClass): BasicConverter
    {
        return new $converterClass(
            AppConstants::CONVERTER_REQUEST,
            AppConstants::CONVERTER_FORMAT,
            $requestClass
        );
    }
}
