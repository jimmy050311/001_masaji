<?php

namespace App\Http\Controllers\Frontend\News;

use App\Http\Controllers\Controller;
use App\Services\News\NewsService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\NewsResource;
use Exception;

class NewsController extends Controller
{
    private $service;

    public function __construct(NewsService $service)
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
                'data' => NewsResource::collection($data)
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function show($id): JsonResponse
    {
        try {

            $data = $this->service->searchById($id);
            $response = [
                'success' => 200,
                'message' => '成功',
                'data' => new NewsResource($data)
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
