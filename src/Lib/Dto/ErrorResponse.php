<?php

/**
 * PHP Version 8.1
 * ErrorResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/ErrorResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\BasicResponse as ModelBasicResp;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ErrorResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/ErrorResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ErrorResponse extends JsonResponse
{
    /**
     * Constructor.
     *
     * @param int    $code    code
     * @param string $message message
     *
     * @return void
     *
     * @psalm-suppress PossiblyInvalidArgument
     */
    public function __construct(int $code, string $message)
    {
        $response = new ModelBasicResp();

        $response->code = $code;
        $response->message = $message;
        $response->result = null;

        parent::__construct($response);
    }
}
