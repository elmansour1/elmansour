<?php

/**
 * PHP Version 8.1
 * EntityNotFoundException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/EntityNotFoundException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * EntityNotFoundException.
 *
 * @category Exception
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Exception
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Exception/EntityNotFoundException.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */
class EntityNotFoundException extends GeneralException
{
    /**
     * Constructor.
     *
     * @param string|null $message message
     *
     * @return void
     */
    public function __construct(string $message = null)
    {
        parent::__construct(
            SystemExceptionMessage::ENTITY_NOT_FOUND,
            $message,
            (int)SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::CODE]
        );
    }
}
