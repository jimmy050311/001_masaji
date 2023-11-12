<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PointLogResource;
use App\Services\User\PointLogService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PointLogController extends Controller
{
    private $service;

    public function __construct(PointLogService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        try {

            $data = $this->service->searchAll($request->all());
            $dataPage = (int)$this->service->total((int)$request->paginate);

            $response = [
                'success' => 200,
                'message' => '成功',
                'dataPage' => $dataPage,
                'data' => PointLogResource::collection($data)
            ];

        }catch(Exception $e){
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }
}
