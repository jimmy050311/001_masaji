<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Product\CategoryService;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;
use Exception;

class CategoryController extends Controller
{
    private $service;

    public function __construct(CategoryService $service)
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
                'data' => CategoryResource::collection($data),
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
