<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Exception;

class VerifyAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {

            $admin = auth('admins')->user();
            
            if (empty($admin)) {
                
                throw new Exception("查無管理員資訊或驗證已失效, 請重新登入！");
            }

            if (empty($admin->id)) {

                throw new Exception("查無管理員資訊或驗證已失效, 請重新登入！");
            }

            if($admin->status == 0) {
                throw new Exception("帳號已被停權！");
            }

            return $next($request);

        } catch (Exception $e) {
            
            $response = [
                'success' => 401,
                'message' => $e->getMessage(),
                'url' => '/manage/login'
            ];
        }

        return response()->json($response, $response['success']);
    }
}
