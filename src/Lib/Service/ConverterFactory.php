<?php

/**
 * PHP Version 8.1
 * ConverterFactory.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/ConverterFactory.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Converter\BasicConverter;

/**
 * ConverterFactory.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Service/ConverterFactory.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
interface ConverterFactory
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
    public function generateConverter(string $converterClass, string $requestClass): BasicConverter;
}
