<?php

/**
 * PHP Version 8.1
 * ProviderResponseConverter.
 *
 * @category Converter
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Converter
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Converter/ProviderResponseConverter.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Converter;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

/**
 * PHP Version 8.1
 * ProviderResponseConverter.
 *
 * @category Converter
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Converter
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Converter/ProviderResponseConverter.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ProviderResponseConverter extends BasicConverter
{
    /**
     * Constructor.
     *
     * @param string $converterName   converterName
     * @param string $converterFormat converterFormat
     * @param string $converterClass  converterClass
     *
     * @return void
     */
    public function __construct(
        string $converterName = AppConstants::CONVERTER_REQUEST,
        string $converterFormat = AppConstants::CONVERTER_FORMAT,
        string $converterClass = ProviderResponse::class
    ) {
        $this->converterClass = $converterClass;
        $this->converterFormat = $converterFormat;
        $this->converterName = $converterName;
    }

    /**
     * Apply.
     *
     * @param Request        $request       request
     * @param ParamConverter $configuration configuration
     *
     * @return bool
     */
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $this->processData($request, $this->converterClass, $configuration);

        return true;
    }
}
