<?php

/**
 * PHP Version 8.1
 * ReferenceController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/ReferenceController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\View;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller\ReferenceController as RfC;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionListResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\ReferenceResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\OptionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\ReferenceMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\OptionService;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * ReferenceController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/ReferenceController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Route('/api/reference')]
class ReferenceController extends AbstractController implements RfC
{
    protected OptionService $optionService;
    protected ReferenceService $referenceService;
    protected ReferenceMapper $referenceMapper;
    protected OptionMapper $optionMapper;

    /**
     * Constructor.
     *
     * @param OptionService    $optionService    optionService
     * @param ReferenceService $referenceService referenceService
     * @param ReferenceMapper  $referenceMapper  referenceMapper
     * @param OptionMapper     $optionMapper     optionMapper
     *
     * @return void
     */
    public function __construct(
        OptionService $optionService,
        ReferenceService $referenceService,
        ReferenceMapper $referenceMapper,
        OptionMapper $optionMapper
    ) {
        $this->optionService = $optionService;
        $this->referenceService = $referenceService;
        $this->referenceMapper = $referenceMapper;
        $this->optionMapper = $optionMapper;
    }

    /**
     * Reference Option list API.
     *
     * This call takes to get the list of options about a reference.
     *
     * @param string $reference reference
     *
     * @return OptionListResponse
     *
     * @codingStandardsIgnoreStart
     *
     * @OA\Get(
     *   path="/api/reference/{reference}/option",
     *   tags={"OptionList"},
     *   summary="Option List API",
     *   description="API is used to list options about a reference",
     *   operationId="referenceOptionlist",
     *   @OA\Parameter(
     *          name="reference",
     *          in="path",
     *          required=true,
     *          description="The reference",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *          example="1673087627",
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
     *                         description="List of options"
     *                     ),
     *                     example={
     *                         "code": 200,
     *                         "message": "success",
     *                         "result": {},
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
    #[Get("/{reference}/option")]
    #[View]
    public function listReference(string $reference): OptionListResponse
    {
        $options = $this->optionMapper->asDTOList(
            $this->optionService->list($reference, true)
        );

        return new OptionListResponse($options);
    }

    /**
     * Reference API.
     *
     * This call takes to get informations about a reference.
     *
     * @param string $reference reference
     *
     * @return ReferenceResponse
     *
     * @codingStandardsIgnoreStart
     *
     * @OA\Get(
     *   path="/api/reference/{reference}",
     *   tags={"Reference"},
     *   summary="Reference API",
     *   description="API is used to get informations about a reference",
     *   operationId="reference",
     *   @OA\Parameter(
     *          name="reference",
     *          in="path",
     *          required=true,
     *          description="The reference",
     *          @OA\Schema(
     *              type="string"
     *          ),
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
     *                         description="Reference Details"
     *                     ),
     *                     example={
     *                         "code": 200,
     *                         "message": "success",
     *                         "result": {},
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
    #[Get("/{reference}")]
    #[View]
    public function reference(string $reference): ReferenceResponse
    {
        $referenceObject = $this->referenceService->findByReferenceNumber(
            $reference
        );
        $referenceDTO = $this->referenceMapper->asDTO($referenceObject);
        $optionsDTO = $referenceObject->options ?
            $this->optionMapper->asDTOList($referenceObject->options) :
            null
        ;

        return new ReferenceResponse($referenceDTO, $optionsDTO);
    }
}
