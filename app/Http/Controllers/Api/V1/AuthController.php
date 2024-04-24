<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AuthRequest;
use App\Models\Users;
use App\Http\Resources\V1\UsersResource;

/**
* @OA\Info(
*     title="EventsFull API",
*     version="1.0.0"
* ),
* @OA\SecurityScheme(
*     securityScheme="bearerAuth",
*     type="http",
*     scheme="bearer"
* )
*/
class AuthController extends Controller
{

    /**
     * @OA\Post(
     *      path="/api/v1/auth",
     *      operationId="Auth",
     *      tags={"Authentication"},
     *      summary="Authenticates a user",
     *      description="Authenticates a user by verifying the document and password",
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="document",
     *                  description="User document",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  description="User password",
     *                  type="string",
     *              ),
     *          ),
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"document", "password"},
     *                  @OA\Property(
     *                      property="document",
     *                      description="User document",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      description="User password",
     *                      type="string",
     *                  ),
     *              )
     *          )
     *      ),
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Returns the user data",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="id",
     *                      type="integer",
     *                      description="User ID"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="User Name"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      description="User email"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      description="Encrypted password"
     *                  ),
     *               )
     *           )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized when the document or password is incorrect",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="error",
     *                      type="string",
     *                      description="Unauthorized message"
     *                  ),
     *               )
     *           )
     *      )
     * )
    */
    public function auth( AuthRequest $request)
    {
        $document = $request->document;
        $password = md5($request->password);

        $user = Users::where('document', $document)->where('password', $password)->first();
        if($user){
            return new UsersResource($user);
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
