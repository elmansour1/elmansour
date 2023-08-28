<?php

/**
 * PHP Version 8.1
 * AfrikpaysasSymfonyThirdpartyAdapterExtension.
 *
 * @category Extension
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\DependencyInjection
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/DependencyInjection/AfrikpaysasSymfonyThirdpartyAdapterExtension.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * AfrikpaysasSymfonyThirdpartyAdapterExtension.
 *
 * @category Extension
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\DependencyInjection
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/DependencyInjection/AfrikpaysasSymfonyThirdpartyAdapterExtension.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.LongClassName)
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class AfrikpaysasSymfonyThirdpartyAdapterExtension extends Extension
{
    /**
     * Load.
     *
     * @param array            $configs          configs
     * @param ContainerBuilder $containerBuilder containerBuilder
     *
     * @return void
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $containerBuilder)
    {
        $loader = new YamlFileLoader(
            $containerBuilder,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.yaml');
    }
}
