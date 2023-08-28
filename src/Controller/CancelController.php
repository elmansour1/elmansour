<?php

/**
 * PHP Version 8.1
 * CancelController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/CancelController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Controller;

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller\CancelController as CCCtrl;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\ReferenceMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\CancelService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * CancelController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/CancelController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Route('/api/cancel')]
class CancelController extends AbstractController implements CCCtrl
{
    protected CancelService $cancelService;
    protected ReferenceService $referenceService;
    protected TransactionMapper $transactionMapper;
    protected ReferenceMapper $referenceMapper;

    /**
     * Constructor.
     *
     * @param CancelService     $cancelService     cancelService
     * @param ReferenceService  $referenceService  referenceService
     * @param TransactionMapper $transactionMapper transactionMapper
     * @param ReferenceMapper   $referenceMapper   referenceMapper
     *
     * @return void
     */
    public function __construct(
        CancelService $cancelService,
        ReferenceService $referenceService,
        TransactionMapper $transactionMapper,
        ReferenceMapper $referenceMapper
    ) {
        $this->cancelService = $cancelService;
        $this->referenceService = $referenceService;
        $this->transactionMapper = $transactionMapper;
        $this->referenceMapper = $referenceMapper;
    }

    /**
     * Cancel API.
     *
     * This call takes to cancel a transaction.
     *
     * @param int $transactionId transactionId
     *
     * @return PaymentResponse
     *
     * @codingStandardsIgnoreStart
     *
     * @OA\Post(
     *   path="/api/cancel/{transactionId}",
     *   tags={"Cancel"},
     *   summary="Cancel API",
     *   description="API is used to cancel a transaction",
     *   operationId="cancel",
     *   @OA\Parameter(
     *          name="transactionId",
     *          in="path",
     *          required=true,
     *          description="The transactionId of the transaction",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          example="455435435435345",
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
     *                         "referenceData": {},
     *                         "result": {},
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
    #[Post("/{transactionId}")]
    public function cancel(int $transactionId): PaymentResponse
    {
        $transaction = $this->cancelService->cancel($transactionId);
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
