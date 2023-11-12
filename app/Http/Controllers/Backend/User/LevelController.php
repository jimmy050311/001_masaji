<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\LevelResource;
use App\Services\User\LevelService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    private $service;

    public function __construct(LevelService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        try {

            $data = $this->service->obtain([]);
            $response = [
                'success' => 200,
                'message' => '成功',
                'data' => new LevelResource($data)
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
