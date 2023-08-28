<?php

/**
 * PHP Version 8.1
 * ReferenceNotFoundException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/ReferenceNotFoundException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * ReferenceNotFoundException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/ReferenceNotFoundException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class ReferenceNotFoundException extends ReferenceException
{
    /**
     * Constructor.
     *
     * @param string|null $reference reference
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(?string $reference = null)
    {
        $referenceTxt = $reference ?? '';
        parent::__construct(
            [
                AppConstants::CODE => sprintf(
                    SystemExceptionMessage::REFERENCE_NOT_FOUND[
                        AppConstants::CODE
                    ],
                    $_ENV['APP_CODE']
                ),
                AppConstants::MESSAGE => sprintf(
                    SystemExceptionMessage::REFERENCE_NOT_FOUND[
                        AppConstants::MESSAGE
                    ],
                    $referenceTxt
                ),
            ]
        );
    }
}
