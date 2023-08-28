<?php

/**
 * PHP Version 8.1
 * VerifyService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/VerifyService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\VerifyRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadEmailException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadPhoneException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\BadReferenceException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\InvalidAmountException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\InvalidAmountOptionException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\InvalidOptionException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\ReferenceApiDisabledException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\VerifyService as VerifyServ;

/**
 * VerifyService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/VerifyService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class VerifyService implements VerifyServ
{
    protected OptionService $optionService;

    /**
     * Constructor.
     *
     * @param OptionService $optionService optionService
     *
     * @return void
     */
    public function __construct(OptionService $optionService)
    {
        $this->optionService = $optionService;
    }

    /**
     * VerifyReference.
     *
     * @param string|null $reference reference
     *
     * @return void
     *
     * @throws BadReferenceException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function verifyReference(?string $reference = null): void
    {
        if (!preg_match($_ENV['REFERENCE_REGEX'], $reference ?? '')) {
            throw new BadReferenceException($reference);
        }
    }

    /**
     * VerifyAmount.
     *
     * @param float|null $amount amount
     *
     * @return void
     *
     * @throws InvalidAmountException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function verifyAmount(?float $amount = null): void
    {
        $condition = AppConstants::PARAMETER_TRUE_VALUE == $_ENV['AMOUNT_ENABLED'] &&
            (
                $amount > $_ENV['AMOUNT_MAX'] ||
                $amount < $_ENV['AMOUNT_MIN']
            );
        if ($condition) {
            throw new InvalidAmountException($amount);
        }
    }

    /**
     * VerifyOption.
     *
     * @param string|null $option option
     * @param float|null  $amount amount
     *
     * @return void
     *
     * @throws InvalidOptionException|InvalidAmountOptionException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function verifyOption(?string $option = null, ?float $amount = null): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['OPTION_ENABLED']) {
            if (!$option) {
                throw new InvalidOptionException($option);
            }
            $optionO = $this->optionService->findOneBySlug($option, false);
            if (!$optionO) {
                throw new InvalidOptionException($option);
            }
            if ($amount && $amount != $optionO->amount) {
                throw new InvalidAmountOptionException($option, $amount);
            }
        }
    }

    /**
     * VerifyPhone.
     *
     * @param string|null $phone phone
     *
     * @return void
     *
     * @throws BadPhoneException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function verifyPhone(?string $phone = null): void
    {
        $condition = AppConstants::PARAMETER_TRUE_VALUE == $_ENV['PHONE_ENABLED'] &&
            !preg_match($_ENV['PHONE_REGEX'], $phone ?? '');

        if ($condition) {
            throw new BadPhoneException($phone);
        }
    }

    /**
     * VerifyEmail.
     *
     * @param string|null $email email
     *
     * @return void
     *
     * @throws BadEmailException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function verifyEmail(?string $email = null): void
    {
        $condition = AppConstants::PARAMETER_TRUE_VALUE == $_ENV['EMAIL_ENABLED'] &&
            !filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($condition) {
            throw new BadEmailException($email);
        }
    }

    /**
     * Verify.
     *
     * @param VerifyRequest $request request
     *
     * @return void
     *
     * @throws BadReferenceException|InvalidAmountException|InvalidOptionException|InvalidAmountOptionException|BadPhoneException|BadEmailException
     */
    public function verify(VerifyRequest $request): void
    {
        $this->verifyReference($request->reference);
        $this->verifyAmount($request->amount);
        $this->verifyOption($request->option, $request->amount);
        $this->verifyPhone($request->phone);
        $this->verifyEmail($request->email);
    }

    /**
     * VerifyReferenceAPI.
     *
     * @return void
     *
     * @throws ReferenceApiDisabledException
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function verifyReferenceAPI(): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['REFERENCE_API_ENABLED']) {
            throw new ReferenceApiDisabledException();
        }
    }
}
