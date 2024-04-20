<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AuthRequest;
use App\Models\Users;
use App\Http\Resources\V1\UsersResource;

class AuthController extends Controller
{
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
