<?php

/**
 * PHP Version 8.1
 * BasicResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/BasicResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\BasicResponse as ModelBasicResp;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * BasicResponse.
 *
 * @category Dto
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Lib/Dto/BasicResponse.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class BasicResponse extends JsonResponse
{
    /**
     * Constructor
     *
     * @param mixed $result result
     *
     * @return void
     *
     * @psalm-suppress PossiblyInvalidArgument
     */
    public function __construct(mixed $result)
    {
        $response = new ModelBasicResp();

        $response->code = AppConstants::SUCCESS_CODE;
        $response->message = AppConstants::SUCCESS_MESSAGE;
        $response->result = $result;

        parent::__construct($response);
    }
}
