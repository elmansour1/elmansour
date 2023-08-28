<?php

/**
 * PHP Version 8.1
 * ParameterService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/ParameterService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Parameter;
use Afrikpaysas\SymfonyThirdpartyAdapter\Entity\Parameter as EntityParameter;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\ParameterEnvNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\ParameterNotFoundException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Repository\ParameterRepository;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ParameterService as BaseParamS;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * ParameterService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/ParameterService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ParameterService implements BaseParamS
{
    protected ParameterRepository $parameterRepository;
    protected ParameterBagInterface $parameterBag;

    /**
     * Constructor.
     *
     * @param ParameterRepository   $parameterRepository parameterRepository
     * @param ParameterBagInterface $parameterBag        parameterBag
     *
     * @return void
     */
    public function __construct(
        ParameterRepository $parameterRepository,
        ParameterBagInterface $parameterBag
    ) {
        $this->parameterRepository = $parameterRepository;
        $this->parameterBag = $parameterBag;
    }

    /**
     * Get.
     *
     * @param string $key   key
     * @param bool   $throw throw
     *
     * @return string|null
     *
     * @throws ParameterNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function get(string $key, bool $throw = true): ?string
    {
        $parameter = $this->parameterRepository->findOneBySlug($key, $throw);

        return $parameter?->value;
    }

    /**
     * GetEnv.
     *
     * @param string $key   key
     * @param bool   $throw throw
     *
     * @return array|bool|string|int|float|\UnitEnum|null
     *
     * @throws ParameterEnvNotFoundException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function getEnv(
        string $key,
        bool $throw = true
    ): array|bool|string|int|float|\UnitEnum|null {
        if (!$this->parameterBag->has($key)) {
            if ($throw) {
                throw new ParameterEnvNotFoundException($key);
            }
        }

        return $this->parameterBag->get($key);
    }

    /**
     * GetParameter.
     *
     * @param string $key   key
     * @param bool   $throw throw
     *
     * @return Parameter|null
     *
     * @throws ParameterNotFoundException
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function getParameter(string $key, bool $throw = true): ?Parameter
    {
        return $this->parameterRepository->findOneBySlug($key, $throw);
    }

    /**
     * SetParameter.
     *
     * @param string $key   key
     * @param string $value value
     *
     * @return void
     *
     * @throws \Exception
     */
    public function setParameter(string $key, string $value): void
    {
        $parameter = $this->getParameter($key, false);
        $save = false;

        if (!$parameter) {
            $parameter = new EntityParameter();
            $parameter->slug = $key;
            $parameter->name = ucfirst($key);
            $save = true;
        }

        $parameter->value = $value;

        $save ? $this->parameterRepository->save($parameter) :
            $this->parameterRepository->update($parameter);
    }
}
