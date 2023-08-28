<?php

/**
 * PHP Version 8.1
 * BasicConverter.
 *
 * @category Converter
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Converter
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Converter/BasicConverter.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Converter;

//@codingStandardsIgnoreStart

use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

// @codingStandardsIgnoreEnd

/**
 * BasicConverter.
 *
 * @category Converter
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Converter
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Converter/BasicConverter.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
abstract class BasicConverter implements ParamConverterInterface
{
    protected string $converterClass;

    protected string $converterFormat;

    protected string $converterName;

    /**
     * Apply.
     *
     * @param Request        $request       request
     * @param ParamConverter $configuration configuration
     *
     * @return bool
     */
    abstract public function apply(
        Request $request,
        ParamConverter $configuration
    ): bool;

    /**
     * Supports.
     *
     * @param ParamConverter $configuration configuration
     *
     * @return bool
     */
    public function supports(ParamConverter $configuration): bool
    {
        return $configuration->getName() === $this->converterName;
    }

    /**
     * ProcessData.
     *
     * @param Request        $request       request
     * @param string         $requestClass  requestClass
     * @param ParamConverter $configuration configuration
     *
     * @return void
     *
     * @throws \Exception
     *
     * @psalm-suppress MixedAssignment
     */
    protected function processData(
        Request $request,
        string $requestClass,
        ParamConverter $configuration
    ): void {
        $object = $this->getObject($request, $requestClass);
        $request->attributes->set($configuration->getName(), $object);
    }

    /**
     * GetObject.
     *
     * @param Request $request request
     *
     * @return mixed
     *
     * @throws \Exception
     *
     * @psalm-suppress MixedAssignment
     */
    public function getObject(Request $request): mixed
    {
        $data = (string) ($request->getContent());

        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(
                new SerializedNameAnnotationStrategy(
                    new IdenticalPropertyNamingStrategy()
                )
            )
            ->build();

        return $serializer->deserialize(
            $data,
            $this->converterClass,
            $this->converterFormat
        );
    }
}
