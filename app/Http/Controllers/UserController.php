<?php

namespace App\Http\Controllers;

use App\Modules\User\DTO\UserTokenDTO;
use App\Modules\User\Models\User;
use App\Modules\User\Services\UserService;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

  function __construct(
    private UserService $userService,
  ) {
  }
  /**
   * @OA\Post(
   *      path="/api/user/token",
   *      operationId="getAuthToken",
   *      @OA\RequestBody(
   *          required=true,
   *          @OA\JsonContent(
   *          ref="#/components/schemas/UserTokenDTO"
   *          )
   *      ),
   *      @OA\Response(
   *          response=201,
   *          description="Successful operation",
   *          @OA\JsonContent(
   *              @OA\Property(property="token", type="string"),
   *          )
   *       )
   * )
   */
  public function getToken(UserTokenDTO $dto)
  {
    $token = $this->userService->getToken($dto);
    return response()->json(['token' => $token], 200);
  }



  //здесь идет описание роутов fortify


  /**
   * @OA\Post(
   *      path="/api/forgot-password",
   *      tags={"fortify"},
   *      operationId="forgotPassword",
   *      @OA\RequestBody(
   *          required=true,
   *          @OA\JsonContent(
   *              @OA\Property(property="email", type="string"),
   *          )
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="Successful operation",
   *          @OA\JsonContent()
   *      )
   * )
   */
  public function forgotPassword(){}

     /**
   * @OA\Post(
   *      path="/api/reset-password",
   *      tags={"fortify"},
   *      operationId="resetPassword",
   *      @OA\RequestBody(
   *          @OA\JsonContent(
   *              @OA\Property(property="email", type="string"),
   *              @OA\Property(property="password", type="string"),
   *              @OA\Property(property="password_confirmation", type="string"),
   *              @OA\Property(property="token", type="string"),
   *          )
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="Successful operation",
   *          @OA\JsonContent()
   *       )
   * )
   */
  public function resetPassword(){}


     /**
   * @OA\Post(
   *      path="/api/register",
   *      tags={"fortify"},
   *      operationId="register",
   *      @OA\RequestBody(
   *          required=true,
   *          @OA\JsonContent(
   *              ref="#/components/schemas/UserRegisterDTO"
   *          )
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="Successful operation",
   *          @OA\JsonContent  
   *       )
   * )
   */
  public function register(){}

     /**
   * @OA\Post(
   *      path="/api/login",
   *      tags={"fortify"},
   *      operationId="login",
   *      @OA\RequestBody(
   *          required=true,
   *          @OA\JsonContent(
   *              @OA\Property(property="email", type="string"),
   *              @OA\Property(property="password", type="string"),
   *          )
   *      ),
   *      @OA\Response(
   *          response=200,
   *          description="Successful operation",
   *          @OA\JsonContent()
   *       )
   * )
   */
  public function login(){}

        /**
   * @OA\Post(
   *      path="/api/logout",
   *      tags={"fortify"},
   *      operationId="logout",
   *      @OA\Response(
   *          response=200,
   *          description="Successful operation",
   *          @OA\JsonContent()
   *       )
   * )
   */
  public function logout(){}

}
