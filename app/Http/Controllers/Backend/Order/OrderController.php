<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\Order\OrderService;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $service;

    public function __construct(OrderService $service)
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
                'data' => OrderResource::collection($data)
            ];
        }catch(Exception $e){
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
                'message' => '訂單新增成功',
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
                'data' => new OrderResource($data),
            ];

        }catch(Exception $e){
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
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
}
