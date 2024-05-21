<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;

use App\Models\User;
//use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request)
    {
        $user = User::where('device_id', $request->device_id)->first();

        if (!$user) {
            $user = User::Create(['device_id' => $request->device_id]);

            $user->updateUserDevice();

            $token = $user->createToken('api-token')->plainTextToken;

            $data = ['token' => $token];

            return $this->apiResponse($data);
        }

        $user->tokens()->delete();
        $user->updateUserDevice();

        $token = $user->createToken('api-token')->plainTextToken;

        $data = ['token' => $token];

        return $this->apiResponse($data);
    }
}
