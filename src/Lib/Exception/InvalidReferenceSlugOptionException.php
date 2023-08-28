<?php

/**
 * PHP Version 8.1
 * InvalidReferenceSlugOptionException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/InvalidReferenceSlugOptionException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * InvalidReferenceSlugOptionException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/InvalidReferenceSlugOptionException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class InvalidReferenceSlugOptionException extends VerifyException
{
    /**
     * Constructor.
     *
     * @param string $reference reference
     * @param string $slug      slug
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(string $reference, string $slug)
    {
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::OPTION_REFERENCE_SLUG_NOT_FOUND[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE']
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::OPTION_REFERENCE_SLUG_NOT_FOUND[
                        AppConstants::MESSAGE
                    ],
                    $slug,
                    $reference
                ),
            ]
        );
    }
}
