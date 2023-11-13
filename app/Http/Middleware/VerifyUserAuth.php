<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Exception;

class VerifyUserAuth
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
           
            $user = auth('users')->user();
            
            if (empty($user)) {
                
                throw new Exception("查無資訊或驗證已失效, 請重新登入！");
            }

            if (empty($user->id)) {

                throw new Exception("查無資訊或驗證已失效, 請重新登入！");
            }

            if($user->status == 0) {
                throw new Exception("帳號已被停權！");
            }

            return $next($request);

        } catch (Exception $e) {

            $response = [
                'success' => 401,
                'message' => $e->getMessage(),
                'url' => '/login',
            ];
        }

        return response()->json($response, $response['success']);
    }
}
