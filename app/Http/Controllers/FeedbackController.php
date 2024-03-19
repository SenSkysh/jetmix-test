<?php

namespace App\Http\Controllers;

use App\Modules\Base\DTO\PaginateParamsDTO;
use App\Modules\Feedback\DTO\FeedbackStoreDTO;
use App\Modules\Feedback\DTO\RequestIndexDTO;
use App\Modules\Feedback\DTO\RequestStoreDTO;
use App\Modules\Feedback\DTO\RequestResolveDTO;
use App\Modules\Feedback\Models\Feedback;
use App\Modules\Feedback\Requests\RequestStoreRequest;
use App\Modules\Feedback\Requests\RequestUpdateRequest;
use App\Modules\Feedback\Requests\RequestIndexRequest;

use App\Modules\Feedback\Services\FeedbackService;
use App\Modules\Feedback\Resources\RequestResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    public function __construct(
        private FeedbackService $feedbackService
    )
    {
        $this->authorizeResource(Feedback::class, Feedback::class);
    }
    /**
     * @OA\Get(
     *      path="/api/feedback",
     *      operationId="getFeedbackList",
     *      @OA\Response(
     *          response=200,
     *          description="getFeedbackList",
     *          @OA\JsonContent(
     *            @OA\Property(
     *                  property="data", 
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/FeedbackDTO")
     *             ),
     *          )
     *       )
     * )
     */
    public function index(Request $request)
    {
        $paginateParams = PaginateParamsDTO::fromRequest($request);
        $list = $this->feedbackService->getPaginated($paginateParams);
        return  JsonResource::collection($list);
    }

    /**
     * @OA\Post(
     *      path="/api/feedback",
     *      operationId="storeFeedback",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/FeedbackStoreDTO")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      )
     * )
     */
    public function store(Request $request, FeedbackStoreDTO $dto)
    {
        $user = Auth::user();
        $this->feedbackService->createFeedback($dto, $user->id);
    }

    /**
     * @OA\Get(
     *      path="/api/feedback/{id}",
     *      operationId="getFeedback",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="getFeedback",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="data", 
     *                  type="object",
     *                  ref="#/components/schemas/FeedbackDTO"
     *             ),
     *         )
     *      )
     * )
     */
    public function show(Request $request, int $id)
    {
        $feedback = $this->feedbackService->getById($id);
        return JsonResource::make($feedback);
    }

}
