<?php

namespace App\Http\Controllers\Frontend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProductResource;
use Exception;

class ProductController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
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
}
