<?php

/**
 * PHP Version 8.1
 * MessagingService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/MessagingService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\Email;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\SMS;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\EmailApiDisabled;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception\SMSApiDisabled;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\MessagingService as BasMesServ;

/**
 * MessagingService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/MessagingService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class MessagingService implements BasMesServ
{
    protected HttpService $httpService;

    /**
     * Constructor.
     *
     * @param HttpService $httpService httpService
     *
     * @return void
     */
    public function __construct(HttpService $httpService)
    {
        $this->httpService = $httpService;
    }

    /**
     * Sms.
     *
     * @param SMS $sms sms
     *
     * @return void
     *
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function sms(SMS $sms): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['SMS_ENABLED']) {
            throw new SMSApiDisabled();
        }

        $this->httpService->sendPOST($_ENV['API_SMS'], $sms->toArray());
    }

    /**
     * Email.
     *
     * @param Email $email email
     *
     * @return void
     *
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function email(Email $email): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['EMAIL_API_ENABLED']) {
            throw new EmailApiDisabled();
        }

        $this->httpService->sendPOST($_ENV['API_EMAIL'], $email->toArray());
    }

    /**
     * SmsWith.
     *
     * @param string $sender  sender
     * @param string $phone   phone
     * @param string $message message
     * @param string $country country
     *
     * @return void
     *
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     */
    public function smsWith(
        string $sender,
        string $phone,
        string $message,
        string $country
    ): void {
        $sms = new SMS();

        $sms->sender = $sender;
        $sms->phone = $phone;
        $sms->message = $message;
        $sms->country = $country;

        $this->sms($sms);
    }

    /**
     * EmailWith.
     *
     * @param string $sender  sender
     * @param string $email   email
     * @param string $message message
     * @param string $object  object
     *
     * @return void
     *
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     */
    public function emailWith(
        string $sender,
        string $email,
        string $message,
        string $object
    ): void {
        $mail = new Email();

        $mail->sender = $sender;
        $mail->email = $email;
        $mail->message = $message;
        $mail->object = $object;

        $this->email($mail);
    }

    /**
     * SendSMS.
     *
     * @param string $phone   phone
     * @param string $message message
     *
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function sendSMS(string $phone, string $message): void
    {
        $this->smsWith($_ENV['SMS_SENDER'], $phone, $message, $_ENV['SMS_COUNTRY']);
    }

    /**
     * SendEmail.
     *
     * @param string $email   email
     * @param string $message message
     * @param string $object  object
     *
     * @return void
     *
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function sendEmail(string $email, string $message, string $object): void
    {
        $this->emailWith($_ENV['EMAIL_SENDER'], $email, $message, $object);
    }

    /**
     * SendSMSList.
     *
     * @param string $phones  phones
     * @param string $message message
     *
     * @return void
     *
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function sendSMSList(string $phones, string $message): void
    {
        foreach (explode($_ENV['SMS_SEPARATOR'], $phones) as $value) {
            $this->sendSMS($value, $message);
        }
    }

    /**
     * SendEmailList.
     *
     * @param string $emails  emails
     * @param string $message message
     * @param string $object  object
     *
     * @return void
     *
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function sendEmailList(
        string $emails,
        string $message,
        string $object
    ): void {
        foreach (explode($_ENV['EMAIL_SEPARATOR'], $emails) as $value) {
            $this->sendEmail($value, $message, $object);
        }
    }
}
