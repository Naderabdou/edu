<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Requests\Api\ForgetPasswordRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use App\Http\Resources\Api\UserResources;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request)
    {

        $loginType = $this->determineLoginType($request->username_or_email);
        $request->merge([$loginType => $request->username_or_email]);



        $credentials = $request->only($loginType, 'password');


        if (!auth()->attempt($credentials)) {
            return $this->ApiResponse(null, transWord('بيانات الدخول غير صحيحة'), 401);
        }
        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Delete all existing firebase tokens for the user

        // Generate a new random key
        $token_firebase = $this->generateRandomKey();

        // Create a new firebase token record for the user
       $user->updateUserDevice($token_firebase);


        return $this->ApiResponse(
            [
                'token' => $token,
                'user' => new UserResources($user),
            ],
            transWord('تم تسجيل الدخول بنجاح')
        );
    }

    public function logout()
    {
        $user = auth()->user();



        $user->firebase_tokens()->delete();

        $user->tokens()->delete();

        return $this->ApiResponse(null, transWord('تم تسجيل الخروج بنجاح'));
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['user_type'] = 'student';
        $user = User::create($data);
        $user->assignRole('student');
        auth()->login($user);

        $token = $user->createToken('auth_token')->plainTextToken;
        $token_firebase = $this->generateRandomKey();

        $user->firebase_tokens()->create([
            'device_id' => $token_firebase,
            'token_firebase' => $token_firebase,
        ]);

        return $this->ApiResponse(
            [
                'token' => $token,
                'user' => new UserResources($user),
            ],
            transWord('تم تسجيل الحساب بنجاح')
        );
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->ApiResponse(null, transWord('هذا الحساب غير موجود'), 404);
        }
        $user->sendEmailVerificationNotification();
        return $this->ApiResponse(null, transWord('تم ارسال كوده استعادة كلمة المرور'));
    }
    public function generateRandomKey($length = 163)
    {
        // Check if openssl_random_pseudo_bytes is available
        if (function_exists('openssl_random_pseudo_bytes')) {
            // Generate a random string of the specified length
            $bytes = openssl_random_pseudo_bytes($length / 2);
        } else {
            // Fallback to a less secure random_bytes if openssl_random_pseudo_bytes is not available
            $bytes = random_bytes($length / 2);
        }
        // Convert the binary data into hexadecimal representation
        $key = bin2hex($bytes);
        return $key;
    }











    private  function determineLoginType($input)
    {
        $emailPattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($emailPattern, $input) ? 'email' : 'username';
    }
}
