<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreUsersRequest;
use App\Http\Requests\V1\UpdateUsersRequest;
use App\Models\Users;
use App\Http\Resources\V1\UsersCollection;
use App\Http\Resources\V1\UsersResource;

class UsersController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/v1/users",
     *     tags={"Users"},
     *     summary="List all users",
     *     description="Returns a list of all users",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *          type="array",
     *          @OA\Items(
     *              @OA\Property(
     *                  property="id",
     *                  type="integer"
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="document",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string"
     *              ),
     *          )
     *     )
     *   )
     * )
    */
    public function index()
    {
        return new UsersCollection(Users::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/v1/users/register",
     *     tags={"Users"},
     *      summary="Create user",
     *      description="Create a new user",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *            @OA\Property(
     *              property="name",
     *              type="string",
     *              description="User name"
     *            ),
     *            @OA\Property(
     *              property="email",
     *              type="string",
     *              description="User e-mail"
     *            ),
     *            @OA\Property(
     *              property="document",
     *              type="string",
     *              description="User document"
     *            ),
     *            @OA\Property(
     *              property="password",
     *              type="string",
     *              description="User password"
     *            )
     *         )
     *      ),
     *      @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(
     *           type="object",
     *           @OA\Property(
     *              property="id",
     *             type="integer"
     *           ),
     *           @OA\Property(
     *               property="name",
     *               type="string"
     *           ),
     *           @OA\Property(
     *               property="email",
     *               type="string"
     *           ),
     *           @OA\Property(
     *               property="document",
     *               type="string"
     *           ),
     *           @OA\Property(
     *               property="password",
     *               type="string"
     *           ),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object"
     *              )
     *          )
     *      )
     *   )
     *  )
     * )
     *
    */
    public function store(StoreUsersRequest $request)
    {
        $data = $request->all();
        $data['password'] = md5($data['password']);
        return new UsersResource(Users::create($data));
    }

    /**
     * /**
     * @OA\Get(
     *      path="/api/v1/users/{user}",
     *      tags={"Users"},
     *      summary="Show user",
     *      description="Returns a user by ID",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="user",
     *          in="path",
     *          description="ID of user",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Message",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="id",
     *                  type="integer"
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="document",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string"
     *              ),
     *       ),
     *     )
     * )
     *
    */
    public function show(Users $user)
    {
        return new UsersResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, Users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $users)
    {
        //
    }
}
