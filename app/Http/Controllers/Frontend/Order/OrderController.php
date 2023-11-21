<?php

namespace App\Http\Controllers\Frontend\Order;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;
use Exception;

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
            
            auth()->shouldUse('users');
            $params = $request->all();
            $params['user_id'] =  auth('users')->user()->id;
            
            $data = $this->service->searchAll($params);
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

    public function show(Request $request): JsonResponse
    {
        try {
            auth()->shouldUse('users');
            $data = $this->service->searchById($request->id);

            if($data->user_id != auth('users')->user()->id) {
                throw new Exception('此筆非您的銷售紀錄！');
            }

            $response = [
                'success' => 200,
                'message' => '成功',
                'data' => new OrderResource($data),
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
