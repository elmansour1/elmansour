<?php

/**
 * PHP Version 8.1
 * CallbackMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/CallbackMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\HandlerMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\CallbackNotificationService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\CallbackMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;

/**
 * CallbackMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/CallbackMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.Superglobals)
 */
class CallbackMessageHandler
{
    protected CallbackNotificationService $callbackNotificationService;
    protected TransactionMapper $transactionMapper;
    protected ReferenceService $referenceService;

    /**
     * Constructor.
     *
     * @param CallbackNotificationService $callbackNotificationService callbackNotificationService
     * @param TransactionMapper           $transactionMapper           transactionMapper
     * @param ReferenceService            $referenceService            referenceService
     *
     * @return void
     */
    public function __construct(
        CallbackNotificationService $callbackNotificationService,
        TransactionMapper $transactionMapper,
        ReferenceService $referenceService
    ) {
        $this->callbackNotificationService = $callbackNotificationService;
        $this->transactionMapper = $transactionMapper;
        $this->referenceService = $referenceService;
    }

    /**
     * Invoke.
     *
     * @param CallbackMessage $transaction transaction
     *
     * @return void
     */
    public function __invoke(CallbackMessage $transaction)
    {
        if (!isset($transaction->callbackUrl) || !$transaction->callbackUrl) {
            return;
        }

        echo sprintf(
            HandlerMessage::CALLBACK_BEFORE_PAYMENT,
            $transaction->transactionId,
            $transaction->transactionId,
            $transaction->callbackUrl
        );

        $result = $this->transactionMapper->asEntity($transaction);

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['REFERENCE_API_ENABLED']) {
            $result->referenceData = $this
                ->referenceService
                ->findByReferenceNumber(
                    $result->reference
                );
        }

        $this->callbackNotificationService->callback($result);

        echo sprintf(
            HandlerMessage::CALLBACK_AFTER_PAYMENT,
            $transaction->transactionId,
            $transaction->transactionId,
            $transaction->callbackUrl
        );
    }
}
