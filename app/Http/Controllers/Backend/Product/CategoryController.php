<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\Product\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            
            $data = $this->service->searchAll($request->all());
            $response = [
                'success' => 200,
                'message' => '成功',
                'data' => $data
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->service->add($request->all());
            $response = [
                'success' => 200,
                'message' => '新增成功'
            ];
            
        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage(),
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
                'data' => new CategoryResource($data),
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            
            $this->service->edit($id, $request->all());
            $response = [
                'success' => 200,
                'message' => '更新成功'
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage(),
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
                'data' => new CategoryResource($data),
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
