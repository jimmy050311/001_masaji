<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\User\UserService;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function show(Request $request): JsonResponse
    {
        try {

            auth()->shouldUse('users');

            $data = $this->service->searchById(auth('users')->user()->id);

            $response = [
                'success' => 200,
                'message' => '成功',
                'data' => new UserResource($data),
            ];
            
        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function updatePassword(UserRequest $request): JsonResponse
    {
        try {

            auth()->shouldUse('users');
            
            $this->service->updatePassword(auth('users')->user()->id, $request->all());

            $response = [
                'success' => 200,
                'message' => '更新成功'
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
