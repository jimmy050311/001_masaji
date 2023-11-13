<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Admin\AdminAuthService;
use App\Services\Admin\AdminService;
use Exception;
use Illuminate\Http\JsonResponse;
use Mews\Captcha\Facades\Captcha;

class LoginController extends Controller
{
    private $adminService;
    private $adminAuthService;

    public function __construct(
        AdminService $adminService, 
        AdminAuthService $adminAuthService)
    {
        $this->adminService = $adminService;
        $this->adminAuthService = $adminAuthService;
    }

    public function login(LoginRequest $request)
    {

        try {
            
            $crendencials = $request->only('account', 'password');
            
            $this->adminAuthService->authenticate($crendencials['account'], $crendencials['password']);

            $admin = $this->adminService->getAdminByAccount($crendencials['account']);

            auth()->shouldUse('admins');
            
            $access_token = auth('admins')->login($admin);

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

            auth()->shouldUse('admins');
            
            auth('admins')->logout();

            $response = [
                'success' => 200,
                'message' => '登出成功',
            ];

        } catch (Exception $e) {

            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }
}
