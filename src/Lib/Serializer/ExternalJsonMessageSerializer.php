<?php

/**
 * PHP Version 8.1
 * ExternalJsonMessageSerializer.
 *
 * @category Serializer
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Serializer
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Serializer/ExternalJsonMessageSerializer.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Serializer;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\MessageDecodingFailedException;
use Symfony\Component\Messenger\Stamp\NonSendableStampInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Messenger\Transport\Serialization\PhpSerializer;

/**
 * ExternalJsonMessageSerializer.
 *
 * @category Serializer
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Serializer
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Serializer/ExternalJsonMessageSerializer.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ExternalJsonMessageSerializer extends PhpSerializer
{
    /**
     * {@inheritdoc}
     */
    public function decode(array $encodedEnvelope): Envelope
    {
        if (empty($encodedEnvelope['body'])) {
            throw new MessageDecodingFailedException('Encoded envelope should have at least a "body", or maybe you should implement your own serializer.');
        }

        if (!str_ends_with($encodedEnvelope['body'], '}')) {
            $encodedEnvelope['body'] = base64_decode($encodedEnvelope['body']);
        }

        $serializeEnvelope = stripslashes($encodedEnvelope['body']);

        return $this->safelyUnserialize($serializeEnvelope);
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Envelope $envelope): array
    {
        $envelope = $envelope->withoutStampsOfType(NonSendableStampInterface::class);

        $body = addslashes(serialize($envelope));

        if (!preg_match('//u', $body)) {
            $body = base64_encode($body);
        }

        return [
            'body' => $body,
        ];
    }

    private function safelyUnserialize(string $contents)
    {
        if ('' === $contents) {
            throw new MessageDecodingFailedException('Could not decode an empty message using PHP serialization.');
        }

        $signalingException = new MessageDecodingFailedException(sprintf('Could not decode message using PHP serialization: %s.', $contents));
        $prevUnserializeHandler = ini_set('unserialize_callback_func', self::class.'::handleUnserializeCallback');
        $prevErrorHandler = set_error_handler(function ($type, $msg, $file, $line, $context = []) use (&$prevErrorHandler, $signalingException) {
            return $prevErrorHandler ? $prevErrorHandler($type, $msg, $file, $line, $context) : false;
        });

        try {
            $meta = unserialize($contents);
        } finally {
            restore_error_handler();
            ini_set('unserialize_callback_func', $prevUnserializeHandler);
        }

        return $meta;
    }

    /**
     * @internal
     */
    public static function handleUnserializeCallback(string $class):never
    {
        throw new MessageDecodingFailedException(sprintf('Message class "%s" not found during decoding.', $class));
    }
}
