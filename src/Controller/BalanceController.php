<?php

/**
 * PHP Version 8.1
 * BalanceController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/BalanceController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller\BalanceController as BalCtrl;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\BalanceResponse;
// @codingStandardsIgnoreLine
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\BalanceService as BalanceSv;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Model\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * BalanceController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/BalanceController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Route('/api/balance')]
class BalanceController extends AbstractController implements BalCtrl
{
    protected BalanceSv $balanceService;

    /**
     * Constructor.
     *
     * @param BalanceSv $balanceService balanceService
     *
     * @return void
     */
    public function __construct(BalanceSv $balanceService)
    {
        $this->balanceService = $balanceService;
    }

    /**
     * Balance API.
     *
     * This call takes to verify the request about payment.
     *
     * @return BalanceResponse
     *
     * @codingStandardsIgnoreStart
     *
     * @OA\Get(
     *   path="/api/balance",
     *   tags={"Balance"},
     *   summary="Balance API",
     *   description="API is used for getting balance of third party",
     *   operationId="Balance",
     *   @OA\RequestBody(
     *       required=false
     *   ),
     *  @OA\Response(
     *      response="200",
     *      description="Successful response",
     *      content={
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
     *                         type="float",
     *                         description="Balance of third party"
     *                     ),
     *                     example={
     *                         "code": 200,
     *                         "message": "success",
     *                         "result": 1000000
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
     */
    #[Get]
    public function balance(): BalanceResponse
    {
        return new BalanceResponse($this->balanceService->balance());
    }
}
