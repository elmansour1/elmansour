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

use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Converter\ProviderResponseConverter;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ProviderResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\ReferenceMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\TransactionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ConverterFactory;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\DecisionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller\DecisionController as BaseDecisionController;
use Afrikpaysas\SymfonyThirdpartyAdapter\Model\AppConstants;
use Afrikpaysas\SymfonyThirdpartyAdapter\Service\ReferenceService;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpFoundation\Request;

/**
 * DecisionController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/DecisionController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Route('/api/decision')]
class DecisionController extends AbstractController implements BaseDecisionController
{
    protected DecisionService $decisionService;
    protected ConverterFactory $converterFactory;
    protected string $provResponseClass;
    protected ProviderResponseConverter $converter;
    protected TransactionMapper $transactionMapper;
    protected ReferenceMapper $referenceMapper;
    protected ReferenceService $referenceService;

    /**
     * Constructor.
     *
     * @param DecisionService   $decisionService   decisionService
     * @param ConverterFactory  $converterFactory  converterFactory
     * @param string            $provResponseClass provResponseClass
     * @param TransactionMapper $transactionMapper transactionMapper
     * @param ReferenceMapper   $referenceMapper   referenceMapper
     * @param ReferenceService  $referenceService  referenceService
     *
     * @return void
     */
    public function __construct(
        DecisionService $decisionService,
        ConverterFactory $converterFactory,
        TransactionMapper $transactionMapper,
        ReferenceMapper $referenceMapper,
        ReferenceService $referenceService,
        string $provResponseClass = ProviderResponse::class
    ) {
        $this->decisionService = $decisionService;
        $this->provResponseClass = $provResponseClass;
        $this->converterFactory = $converterFactory;
        $this->converter = $this->converterFactory->generateConverter(
            ProviderResponseConverter::class,
            $this->provResponseClass
        );
        $this->transactionMapper = $transactionMapper;
        $this->referenceMapper = $referenceMapper;
        $this->referenceService = $referenceService;
    }

    /**
     * Decision API.
     *
     * This call takes to make a decision converning a response of a third party
     *
     * @param Request $response response
     *
     * @return PaymentResponse
     *
     * @codingStandardsIgnoreStart
     *
     * @OA\Post(
     *   path="/api/decision",
     *   tags={"Decision"},
     *   summary="Decision API",
     *   description="API is used to make a decision converning a response of a third party",
     *   operationId="decision",
     *   @OA\RequestBody(
     *       required=false
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
    #[Post]
    public function decision(Request $response): PaymentResponse
    {
        $request = $this->converter->getObject($response);
        $transaction = $this->decisionService->process($request);
        $referenceDTO = null;

        if ($_ENV['REFERENCE_API_ENABLED']) {
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
