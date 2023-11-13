<?php

namespace App\Http\Controllers\Backend\Coupon;

use App\Services\Coupon\CouponService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Http\Resources\CouponResource;

class CouponController extends Controller
{
    private $service;

    public function __construct(CouponService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {

            $data = $this->service->searchAll($request->all());
            $dataPage = (int)$this->service->total((int)$request->paginate);

            $response = [
                'success' => 200,
                'message' => '成功',
                'dataPage' => $dataPage,
                'data' => CouponResource::collection($data)
            ];
        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function store(CouponRequest $request): JsonResponse
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

    public function show($id) 
    {
        try {

            $data = $this->service->searchById($id);

            $response = [
                'success' => 200,
                'message' => '成功',
                'data' => new CouponResource($data)
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function update(CouponRequest $request, $id) 
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
                'data' => CouponResource::collection($data)
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
