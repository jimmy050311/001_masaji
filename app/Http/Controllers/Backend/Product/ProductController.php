<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\Product\ProductService;
use Exception;

class ProductController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        try {
           
            $data = $this->service->searchAll($request->all());
			$dataPage = (int)$this->service->total($request->paginate);
            
            $response = [
                'success' => 200,
                'message' => '成功',
                'dataPage' => $dataPage,
                'data' => ProductResource::collection($data)
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function store(ProductRequest $request): JsonResponse
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
                'data' => new ProductResource($data)
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function update(ProductRequest $request, $id): JsonResponse
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

    public function obtain(Request $request): JsonResponse
    {
        try {
            
            $data = $this->service->obtain($request->all());
            $response = [
                'success' => 200,
                'message' => '成功',
                'data' => ProductResource::collection($data)
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function updateLowAmount(ProductRequest $request, $id): JsonResponse
    {
        try {

            $this->service->editLowAmount($id, $request->all());
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
