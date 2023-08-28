<?php

/**
 * PHP Version 8.1
 * StatusController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/StatusController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller\StatusController as StCtrl;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\StatusRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\ReferenceMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\StatusService;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * StatusController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/StatusController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Route('/api/status')]
class StatusController extends AbstractController implements StCtrl
{
    protected PaymentService $paymentService;
    protected StatusService $statusService;
    protected ReferenceService $referenceService;
    protected TransactionMapper $transactionMapper;
    protected ReferenceMapper $referenceMapper;

    /**
     * Constructor.
     *
     * @param PaymentService    $paymentService    paymentService
     * @param StatusService     $statusService     statusService
     * @param ReferenceService  $referenceService  referenceService
     * @param TransactionMapper $transactionMapper transactionMapper
     * @param ReferenceMapper   $referenceMapper   referenceMapper
     *
     * @return void
     */
    public function __construct(
        PaymentService $paymentService,
        StatusService $statusService,
        ReferenceService $referenceService,
        TransactionMapper $transactionMapper,
        ReferenceMapper $referenceMapper
    ) {
        $this->paymentService = $paymentService;
        $this->statusService = $statusService;
        $this->referenceService = $referenceService;
        $this->transactionMapper = $transactionMapper;
        $this->referenceMapper = $referenceMapper;
    }

    /**
     * Status API.
     *
     * This call takes to get the status about a transaction.
     *
     * @param StatusRequest $request request
     *
     * @return PaymentResponse
     *
     * @ParamConverter("request", converter="StatusRequestConverter")
     *
     * @codingStandardsIgnoreStart
     *
     * @OA\Post(
     *   path="/api/status",
     *   tags={"Status"},
     *   summary="Status API",
     *   description="API is used to get the status about a transaction",
     *   operationId="status",
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
     *                   property="externalId",
     *                   description="Id of external application",
     *                   type="string",
     *                   example="32224545335"
     *               ),
     *              @OA\Property(
     *                   property="requestId",
     *                   description="Id of gateway application",
     *                   type="string",
     *                   example="32224545335"
     *               ),
     *              @OA\Property(
     *                   property="applicationId",
     *                   description="Id of application",
     *                   type="string",
     *                   example="OSS-32224545335"
     *               ),
     *              @OA\Property(
     *                   property="financialId",
     *                   description="Id of CBS transaction",
     *                   type="string",
     *                   example="4534t536536"
     *               ),
     *              @OA\Property(
     *                   property="transactionId",
     *                   description="Id of transaction",
     *                   type="string",
     *                   example="4534t536536"
     *               ),
     *              @OA\Property(
     *                   property="providerId",
     *                   description="Id of provider transaction",
     *                   type="string",
     *                   example="4534t536536"
     *               )
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
     *                         type="mixed",
     *                         description="Result of response"
     *                     ),
     *                     @OA\Property(
     *                         property="referenceData",
     *                         type="mixed",
     *                         description="Informations about reference"
     *                     ),
     *                     @OA\Property(
     *                         property="externalId",
     *                         type="integer",
     *                         description="externalId"
     *                     ),
     *                     @OA\Property(
     *                         property="requestId",
     *                         type="string",
     *                         description="requestId"
     *                     ),
     *                     @OA\Property(
     *                         property="applicationId",
     *                         type="string",
     *                         description="applicationId"
     *                     ),
     *                     @OA\Property(
     *                         property="financialId",
     *                         type="string",
     *                         description="financialId"
     *                     ),
     *                     @OA\Property(
     *                         property="providerId",
     *                         type="string",
     *                         description="providerId"
     *                     ),
     *                     @OA\Property(
     *                         property="transactionId",
     *                         type="integer",
     *                         description="transactionId"
     *                     ),
     *                     example={
     *                         "code": 200,
     *                         "message": "success",
     *                         "result": {},
     *                         "referenceData": {},
     *                         "externalId": "AFP1223r23",
     *                         "requestId": "455454545454",
     *                         "applicationId": "OSS-1311313131",
     *                         "financialId": "1413434244",
     *                         "providerId": "3254545452",
     *                         "transactionId": 4424543454534
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
    public function status(StatusRequest $request): PaymentResponse
    {
        $transaction = $this->statusService->status($request);

        $referenceDTO = null;

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['REFERENCE_API_ENABLED']) {
            $transaction->referenceData = $this
                ->referenceService
                ->findByReferenceNumber(
                    $transaction->reference
                );
            $referenceDTO = $this->referenceMapper->asDTO(
                $transaction->referenceData
            );
        }

        $transactionDTO = $this->transactionMapper->asDTO($transaction);

        return new PaymentResponse($transactionDTO, $referenceDTO);
    }
}
