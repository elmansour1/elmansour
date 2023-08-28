<?php

/**
 * PHP Version 8.1
 * VerifyController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/VerifyController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Controller;

use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller\VerifyController as VfCtrl;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\VerifyRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\VerifyResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\VerifyService;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * VerifyController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/VerifyController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Route('/api/verify')]
class VerifyController extends AbstractController implements VfCtrl
{
    protected VerifyService $verifyService;

    /**
     * Constructor.
     *
     * @param VerifyService $verifyService verifyService
     *
     * @return void
     */
    public function __construct(VerifyService $verifyService)
    {
        $this->verifyService = $verifyService;
    }

    /**
     * Verify API.
     *
     * This call takes to verify the request about payment.
     *
     * @param VerifyRequest $request request
     *
     * @return VerifyResponse
     *
     * @codingStandardsIgnoreStart
     *
     * @ParamConverter("request", converter="VerifyRequestConverter")
     *
     * @OA\Post(
     *   path="/api/verify",
     *   tags={"Verify"},
     *   summary="Verify API",
     *   description="API is used for verifying the request about payment",
     *   operationId="verify",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="reference",
     *                   description="Reference of operation",
     *                   type="string",
     *                   example="1673087627"
     *               ),
     *               @OA\Property(
     *                   property="amount",
     *                   description="Amount of operation",
     *                   type="float",
     *                   example="1000"
     *               ),
     *              @OA\Property(
     *                   property="phone",
     *                   description="phone for receiving notifications",
     *                   type="string",
     *                   example="237696991037"
     *               ),
     *              @OA\Property(
     *                   property="email",
     *                   description="email for receiving notifications",
     *                   type="string",
     *                   example=null
     *               ),
     *              @OA\Property(
     *                   property="option",
     *                   description="Option of payment in case there are specific amounts",
     *                   type="string",
     *                   example=null
     *               ),
     *           )
     *       )
     *   ),
     *  @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="code",
     *                         type="integer",
     *                         description="code of response"
     *                     ),
     *                     @OA\Property(
     *                         property="message",
     *                         type="string",
     *                         description="message of response"
     *                     ),
     *                     @OA\Property(
     *                         property="result",
     *                         type="string",
     *                         description="Result of response"
     *                     ),
     *                     example={
     *                         "code": 200,
     *                         "message": "success",
     *                         "result": "success",
     *                      }
     *                 )
     *             )
     *         }
     *     ),
     *   @OA\Response(response="404", description="URI Not found"),
     *   @OA\Response(response="405",description="(entity) with (field) (value) not found"),
     *   @OA\Response(response="406",description="(entity) with (field) (value) already exist"),
     *   @OA\Response(response="407",description="No (entity) found"),
     *   @OA\Response(response="408",description="Parameter (key) not found, verify configuration"),
     *   @OA\Response(response="409",description="Environment parameter (key) must be specified, verify configuration"),
     *   @OA\Response(response="500",description="General Failure (error)"),
     *   @OA\Response(response="501",description="Network Failure on API (api)"),
     *   @OA\Response(response="502",description="Error occured when getting token on API (api)"),
     *   @OA\Response(response="503",description="Bad API Response format on API (api)"),
     *   @OA\Response(response="504",description="Database Connectivity failure"),
     *   @OA\Response(response="505",description="General Network Failure on API (api)"),
     *   @OA\Response(response="506",description="Configuration view is disabled. Contact support"),
     *   @OA\Response(response="507",description="Mapper Exception (exception)"),
     *   @OA\Response(response="508",description="The type (type) of the value is not (type)"),
     *   @OA\Response(response="509",description="Error occured when cast element of collection (collection)"),
     *   @Security(name="Basic")
     * )
     *
     * @codingStandardsIgnoreEnd
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    #[Post]
    public function verify(VerifyRequest $request): VerifyResponse
    {
        $this->verifyService->verify($request);

        return new VerifyResponse();
    }
}
