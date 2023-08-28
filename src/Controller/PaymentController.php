<?php

/**
 * PHP Version 8.1
 * PaymentController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/PaymentController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller\PaymentController as PyCtrl;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\ReferenceMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\PaymentService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * PaymentController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/PaymentController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Route('/api/payment')]
class PaymentController extends AbstractController implements PyCtrl
{
    protected PaymentService $paymentService;
    protected ReferenceService $referenceService;
    protected TransactionMapper $transactionMapper;
    protected ReferenceMapper $referenceMapper;

    /**
     * Constructor.
     *
     * @param PaymentService    $paymentService    paymentService
     * @param ReferenceService  $referenceService  referenceService
     * @param TransactionMapper $transactionMapper transactionMapper
     * @param ReferenceMapper   $referenceMapper   referenceMapper
     *
     * @return void
     */
    public function __construct(
        PaymentService $paymentService,
        ReferenceService $referenceService,
        TransactionMapper $transactionMapper,
        ReferenceMapper $referenceMapper
    ) {
        $this->paymentService = $paymentService;
        $this->referenceService = $referenceService;
        $this->transactionMapper = $transactionMapper;
        $this->referenceMapper = $referenceMapper;
    }

    /**
     * Payment API.
     *
     * This call takes to make a payment.
     *
     * @param PaymentRequest $request request
     *
     * @return PaymentResponse
     *
     * @codingStandardsIgnoreStart
     *
     * @ParamConverter("request", converter="PaymentRequestConverter")
     *
     * @OA\Post(
     *   path="/api/payment",
     *   tags={"Payment"},
     *   summary="Payment API",
     *   description="API is used for making a payment",
     *   operationId="payment",
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
     *                   property="accountName",
     *                   description="Account holder name",
     *                   type="string",
     *                   example="Willy"
     *               ),
     *               @OA\Property(
     *                   property="accountNumber",
     *                   description="CBS Account number",
     *                   type="string",
     *                   example="2234354546"
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
     *              @OA\Property(
     *                   property="externalId",
     *                   description="Id of external application",
     *                   type="string",
     *                   example="34252455425"
     *               ),
     *              @OA\Property(
     *                   property="requestId",
     *                   description="Id of gateway",
     *                   type="string",
     *                   example="34252455425"
     *               ),
     *               @OA\Property(
     *                   property="applicationId",
     *                   description="Id of internal application",
     *                   type="string",
     *                   example="34252455425"
     *               ),
     *               @OA\Property(
     *                   property="financialId",
     *                   description="Id of transaction in Core Banking system",
     *                   type="string",
     *                   example="34252455425"
     *               ),
     *               @OA\Property(
     *                   property="callbackUrl",
     *                   description="the callback Url use to send the notification of payment after payment",
     *                   type="string",
     *                   example="https://callback.dev"
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
     *                         "externalId": "AFP1223r23",
     *                         "requestId": "435543534534534",
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
    public function pay(PaymentRequest $request): PaymentResponse
    {
        $transaction = $this->paymentService->pay($request);

        $referenceDTO = null;

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['REFERENCE_API_ENABLED']) {
            $referenceDTO = $this->referenceMapper->asDTO(
                $transaction->referenceData
            );
        }

        $transactionDTO = $this->transactionMapper->asDTO($transaction);

        return new PaymentResponse($transactionDTO, $referenceDTO);
    }
}
