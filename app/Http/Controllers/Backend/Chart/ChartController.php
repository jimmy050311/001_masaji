<?php

namespace App\Http\Controllers\Backend\Chart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Order\OrderDetailService;
use App\Services\Order\OrderService;
use App\Services\User\UserService;
use Carbon\Carbon;
use Exception;

class ChartController extends Controller
{
    private $userService;
    private $orderService;
    private $orderDetailService;

    public function __construct(
        UserService $userService,
        OrderService $orderService,
        OrderDetailService $orderDetailService)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    public function barChart()
    {
        try {
            
            $userAmount = $this->userService->userAmount();
            $orderTotal = $this->orderService->orderTotal();
            $monthArray = [
                (string)Carbon::now()->startOfMonth()->addMonths(-11)->month . "月",
                (string)Carbon::now()->startOfMonth()->addMonths(-10)->month . "月",
                (string)Carbon::now()->startOfMonth()->addMonths(-9)->month . "月",
                (string)Carbon::now()->startOfMonth()->addMonths(-8)->month . "月",
                (string)Carbon::now()->startOfMonth()->addMonths(-7)->month . "月",
                (string)Carbon::now()->startOfMonth()->addMonths(-6)->month . "月",
                (string)Carbon::now()->startOfMonth()->addMonths(-5)->month . "月",
                (string)Carbon::now()->startOfMonth()->addMonths(-4)->month . "月",
                (string)Carbon::now()->startOfMonth()->addMonths(-3)->month . "月",
                (string)Carbon::now()->startOfMonth()->addMonths(-2)->month . "月",
                (string)Carbon::now()->startOfMonth()->addMonths(-1)->month . "月",
                (string)Carbon::now()->month . "月",
            ];
            
            $response = [
                'success' => 200,
                'message' => '成功',
                'user_amount' => $userAmount,
                'order_total' => $orderTotal,
                'month_array' => $monthArray,
                'data' => $this->orderService->getBarChartData(),
            ];
            
        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function pieChart()
    {
        try {

            $data = $this->orderDetailService->getPieChartData();
            $response = [
                'success' => 200,
                'message' => '成功',
                'product_array' => $data['name'],
                'data' => $data['sum'],
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
