<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\User\UserAuthService;
use App\Services\User\UserService;
use Exception;

class LoginController extends Controller
{
    private $userService;
    private $userAuthService;

    public function __construct(
        UserService $userService,
        UserAuthService $userAuthService,
    )
    {
        $this->userService = $userService;
        $this->userAuthService = $userAuthService;
    }

    public function login(LoginRequest $request)
    {
        try {
            
            $crendencials = $request->only('account', 'password');

            $this->userAuthService->authenticate($crendencials['account'], $crendencials['password']);

            $user = $this->userService->getUserByAccount($crendencials['account']);
            
            auth()->shouldUse('users');
            
            $access_token = auth('users')->login($user);

            $response = [
                'success' => 200,
                'message' => '登入成功',
                'access_token' => "Bearer $access_token"
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function logout()
    {
        try {

            auth()->shouldUse('users');
            
            auth('users')->logout();

            $response = [
                'success' => 200,
                'message' => '登出成功',
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }
}
