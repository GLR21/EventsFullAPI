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
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersRequest $request)
    {
        $data = $request->all();
        $data['password'] = md5($data['password']);
        return new UsersResource(Users::create($data));
    }

    /**
     * Display the specified resource.
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
