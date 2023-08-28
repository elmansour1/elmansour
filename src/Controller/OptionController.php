<?php

/**
 * PHP Version 8.1
 * OptionController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/OptionController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 */

namespace Afrikpaysas\SymfonyThirdpartyAdapter\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\View;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Controller\OptionController as OptCtrl;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionListResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequest;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Dto\OptionResponse;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Mapper\OptionMapper;
use Afrikpaysas\SymfonyThirdpartyAdapter\Lib\Service\OptionService;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * OptionController.
 *
 * @category Controller
 * @package  Afrikpaysas\SymfonyThirdpartyAdapter\Controller
 * @author   Willy DAMTCHOU <willy.damtchou@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/afrikpaysas/symfony-thirdparty-adapter/blob/master/Controller/OptionController.php
 *
 * @see https://github.com/afrikpaysas/symfony-thirdparty-adapter
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Route('/api/option')]
class OptionController extends AbstractController implements OptCtrl
{
    protected OptionService $optionService;
    protected OptionMapper $optionMapper;

    /**
     * Constructor.
     *
     * @param OptionService $optionService optionService
     * @param OptionMapper  $optionMapper  optionMapper
     *
     * @return void
     */
    public function __construct(
        OptionService $optionService,
        OptionMapper $optionMapper
    ) {
        $this->optionService = $optionService;
        $this->optionMapper = $optionMapper;
    }

    /**
     * Option create API.
     *
     * This call takes to create an option.
     *
     * @param OptionRequest $request request
     *
     * @return OptionResponse
     *
     * @codingStandardsIgnoreStart
     *
     * @ParamConverter("request", converter="OptionRequestConverter")
     * @OA\Post(
     *   path="/api/option",
     *   tags={"OptionCreate"},
     *   summary="Option Create API",
     *   description="API is used to create an option",
     *   operationId="optioncreate",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="name",
     *                   description="Name of option",
     *                   type="string",
     *                   example="NACT_Surf Day 100"
     *               ),
     *               @OA\Property(
     *                   property="slug",
     *                   description="Slug of option",
     *                   type="string",
     *                   example="nact-surf-day-100"
     *               ),
     *              @OA\Property(
     *                   property="amount",
     *                   description="Amount of option",
     *                   type="float",
     *                   example="100"
     *               ),
     *              @OA\Property(
     *                   property="reference",
     *                   description="Reference",
     *                   type="string",
     *                   example="24552452452"
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
     *                         description="Option created"
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
    #[Post]
    public function create(OptionRequest $request): OptionResponse
    {
        $option = $this->optionService->create($request);

        $optionDTO = $this->optionMapper->asDTO($option);

        return new OptionResponse($optionDTO);
    }

    /**
     * Option list API (no reference).
     *
     * This call takes to get the list of options.
     *
     * @return OptionListResponse
     *
     * @codingStandardsIgnoreStart
     *
     * @OA\Get(
     *   path="/api/option",
     *   tags={"OptionList"},
     *   summary="Option List API",
     *   description="API is used to list options",
     *   operationId="optionlist",
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
    #[Get]
    #[View]
    public function list(): OptionListResponse
    {
        $list = $this->optionMapper->asDTOList(
            $this->optionService->list(null, true)
        );

        return new OptionListResponse($list);
    }
}
