<?php

/**
 * PHP Version 8.1
 * NotificationService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/NotificationService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Service;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\MessagingService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\NotificationService as NotfS;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\VerifyService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\SendAdminEmailMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\SendAdminSMSMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\SendClientEmailMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\SendClientSMSMessage;
use DateTimeZone;
use DateTime;
use Symfony\Component\Messenger\MessageBusInterface;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;

/**
 * NotificationService.
 *
 * @category Service
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Service
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Service/NotificationService.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.Superglobals)
 */
class NotificationService implements NotfS
{
    protected MessagingService $messagingService;
    protected ReferenceService $referenceService;
    protected VerifyService $verifyService;
    protected MessageBusInterface $bus;
    protected TransactionMapper $transactionMapper;

    /**
     * Constructor.
     *
     * @param MessagingService    $messagingService  messagingService
     * @param ReferenceService    $referenceService  referenceService
     * @param VerifyService       $verifyService     verifyService
     * @param MessageBusInterface $bus               bus
     * @param TransactionMapper   $transactionMapper transactionMapper
     *
     * @return void
     */
    public function __construct(
        MessagingService $messagingService,
        ReferenceService $referenceService,
        VerifyService $verifyService,
        MessageBusInterface $bus,
        TransactionMapper $transactionMapper
    ) {
        $this->messagingService = $messagingService;
        $this->referenceService = $referenceService;
        $this->verifyService = $verifyService;
        $this->bus = $bus;
        $this->transactionMapper = $transactionMapper;
    }

    /**
     * Notification.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @psalm-suppress PossiblyNullArgument
     * @psalm-suppress PossiblyUndefinedArrayOffset
     */
    public function notification(Transaction $transaction): void
    {
        $transactionDTO = $this->transactionMapper->asDTO($transaction);

        $this->bus->dispatch(new SendClientSMSMessage($transactionDTO));
        $this->bus->dispatch(new SendClientEmailMessage($transactionDTO));
        $this->bus->dispatch(new SendAdminSMSMessage($transactionDTO));
        $this->bus->dispatch(new SendAdminEmailMessage($transactionDTO));
    }

    /**
     * GenerateClientSMS.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function generateClientSMS(Transaction $transaction): ?array
    {
        return [];
    }

    /**
     * GenerateAdminSMS.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function generateAdminSMS(Transaction $transaction): ?array
    {
        return [];
    }

    /**
     * GenerateClientEmail.
     *
     * @param Transaction $transaction transaction
     *
     * @return string
     */
    public function generateClientEmail(Transaction $transaction): string
    {
        return $transaction->toEmailString(AppConstants::TRANSACTIONS_DETAILS);
    }

    /**
     * GenerateAdminEmail.
     *
     * @param Transaction $transaction transaction
     *
     * @return string
     */
    public function generateAdminEmail(Transaction $transaction): string
    {
        return $transaction->toEmailString(AppConstants::TRANSACTIONS_DETAILS);
    }

    /**
     * SendClientSMS.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function sendClientSMS(Transaction $transaction): void
    {
        $condition = AppConstants::PARAMETER_TRUE_VALUE == $_ENV['PHONE_ENABLED'] &&
            AppConstants::PARAMETER_TRUE_VALUE == $_ENV['SMS_ENABLED'];

        if ($condition) {
            $this->verifyService->verifyPhone($transaction->phone);

            $this->messagingService->sendSMS(
                $transaction->phone,
                $this->generateClientSMSText($transaction)
            );
        }
    }

    /**
     * SendAdminSMS.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function sendAdminSMS(Transaction $transaction): void
    {
        $condition = $_ENV['ADMIN_PHONES'] &&
            AppConstants::PARAMETER_TRUE_VALUE == $_ENV['SMS_ENABLED'];

        if ($condition) {
            $this->messagingService->sendSMSList(
                $_ENV['ADMIN_PHONES'],
                $this->generateAdminSMSText($transaction)
            );
        }
    }

    /**
     * SendClientEmail.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function sendClientEmail(Transaction $transaction): void
    {
        $condition = AppConstants::PARAMETER_TRUE_VALUE == $_ENV['EMAIL_ENABLED'] &&
            AppConstants::PARAMETER_TRUE_VALUE == $_ENV['EMAIL_API_ENABLED'];

        if ($condition) {
            $this->verifyService->verifyEmail($transaction->email);

            $this->messagingService->sendEmail(
                $transaction->email,
                $this->generateClientEmail($transaction),
                $_ENV['EMAIL_CLIENT_OBJECT']
            );
        }
    }

    /**
     * sendAdminEmail.
     *
     * @param Transaction $transaction transaction
     *
     * @return void
     */
    public function sendAdminEmail(Transaction $transaction): void
    {
        $condition = $_ENV['ADMIN_EMAILS'] &&
            $_ENV['EMAIL_ADMIN_OBJECT'] &&
            AppConstants::PARAMETER_TRUE_VALUE == $_ENV['EMAIL_API_ENABLED'];

        if ($condition) {
            $this->messagingService->sendEmailList(
                $_ENV['ADMIN_EMAILS'],
                $this->generateAdminEmail($transaction),
                $_ENV['EMAIL_ADMIN_OBJECT']
            );
        }
    }

    /**
     * GenerateClientSMSText.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    protected function generateClientSMSText(Transaction $transaction): string
    {
        $data = $this->generateClientSMS($transaction);

        return sprintf(
            $_ENV['NOTIF_SMS_MESSAGE'],
            ...$data
        );
    }

    /**
     * GenerateAdminSMSText.
     *
     * @param Transaction $transaction transaction
     *
     * @return array|null
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    protected function generateAdminSMSText(Transaction $transaction): string
    {
        $data = $this->generateAdminSMS($transaction);

        return sprintf(
            $_ENV['NOTIF_SMS_ADMIN_MESSAGE'],
            ...$data
        );
    }
}
