<?php

namespace App\Http\Controllers\Backend\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use App\Services\News\NewsService;
use Exception;
use Illuminate\Http\JsonResponse;

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

    public function store(NewsRequest $request): JsonResponse
    {
        try {
            
            $this->service->add($request->all());

            $response = [
                'success' => 200,
                'message' => '新增成功',
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

    public function update(NewsRequest $request, $id): JsonResponse
    {
        try {
            
            $this->service->edit($id, $request->all());
            $response = [
                'success' => 200,
                'message' => '修改成功'
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function destroy($id): JsonResponse
    {
        try {
            
            $this->service->del($id);
            $response = [
                'success' => 200,
                'message' => '刪除成功'
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function obtain(Request $request): JsonResponse
    {
        try {

            $data = $this->service->obtain($request->all());
            $response = [
                'success' => 200,
                'message' => '成功',
                'data' => NewsResource::collection($data),
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
