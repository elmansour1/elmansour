<?php

/**
 * PHP Version 8.1
 * UpdateReferenceStatusMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/MessageHandler/UpdateReferenceStatusMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\HandlerMessage;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\Message\UpdateReferenceStatusMessage;

/**
 * UpdateReferenceStatusMessageHandler.
 *
 * @category MessageHandler
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Messenger\MessageHandler
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Messenger/UpdateReferenceStatusMessageHandler/UpdateProviderIdMessageHandler.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class UpdateReferenceStatusMessageHandler
{
    protected ReferenceService $referenceService;

    /**
     * Constructor.
     *
     * @param ReferenceService $referenceService
     *
     * @return void
     */
    public function __construct(ReferenceService $referenceService)
    {
        $this->referenceService = $referenceService;
    }

    /**
     * Invoke.
     *
     * @param UpdateReferenceStatusMessage $reference reference
     *
     * @return void
     */
    public function __invoke(UpdateReferenceStatusMessage $reference)
    {
        if (!$reference->reference) {
            echo HandlerMessage::UPDATE_REFERENCE_STATUS_CHECK_REFERENCE;

            return;
        }

        if (!$reference->status) {
            echo sprintf(
                HandlerMessage::UPDATE_REFERENCE_STATUS_CHECK_STATUS,
                $reference->reference,
                $reference->reference
            );

            return;
        }

        echo sprintf(
            HandlerMessage::UPDATE_REFERENCE_STATUS_BEFORE_PAYMENT,
            $reference->reference,
            $reference->reference,
            $reference->status->value
        );

        $result = $this->referenceService->updateStatus(
            $reference->reference,
            $reference->status
        );

        echo sprintf(
            HandlerMessage::UPDATE_REFERENCE_STATUS_AFTER_PAYMENT,
            $reference->reference,
            $result->referenceNumber,
            $result->status->value
        );
    }
}
