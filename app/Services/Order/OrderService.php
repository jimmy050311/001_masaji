<?php

namespace App\Services\Order;

use App\Models\Inventory;
use App\Repositories\Inventory\InventoryRepository;
use App\Repositories\Order\OrderDetailRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Product\ProductRepository;
use App\Services\Service;
use Carbon\Carbon;
use Exception;

class OrderService extends Service
{
    protected $repository;
    protected $orderDetailRepository;
    protected $productRepository;
    protected $inventoryRepository;

    public function __construct(
        OrderRepository $repository,
        OrderDetailRepository $orderDetailRepository,
        ProductRepository $productRepository,
        InventoryRepository $inventoryRepository)
    {
        $this->repository = $repository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->productRepository = $productRepository;
        $this->inventoryRepository = $inventoryRepository;
    }

    public function add($params)
    {
        if(count($params['cartData']) == 0) {
            throw new Exception('購買商品不可為空');
        }
        $inventroy = [];
        //判斷庫存
        foreach($params['cartData'] as $item) {
            $product = $this->productRepository->searchById($item['product_id']);
            if($product->type == 2) {
                if(!isset($inventroy[$item['product_id']])) {
                    $inventroy[$item['product_id']] = $item['amount'];
                }else {
                    $inventroy[$item['product_id']] += $item['amount'];
                }
            }
        }
        foreach($inventroy as $key => $value) {
            $product = $this->productRepository->searchById($key);
            if($product->amount < $value) {
                throw new Exception('庫存商品不足');
            }
        }
        $number = $this->createNumber();
        $order = $this->repository->add([
            'number' => $number,
            'user_id' => $params['user_id'],
            'level_id' => $params['level_id'],
            'total' => $params['total'],
            'extra_discount' => 0,
            'total_discount' => $params['total'] - $params['final_total'],
            'amount' => $params['amount'],
            'final_total' => $params['final_total'],
            'status' => $params['status'],
            'remark' => $params['remark'],
            'paid_at' => Carbon::now(),
        ]);

        foreach($params['cartData'] as $item) {
            $product = $this->productRepository->searchById($item['product_id']);
            $this->orderDetailRepository->add([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'category_id' => $product->category_id,
                'category_name' => $product->category->name,
                'type' => $product->type,
                'name' => $product->name,
                'number' => $product->number,
                'price' => $product->price,
                'final_price' => $item['final_price'],
                'amount' => $item['amount'],
                'minute' => $product->minute,
                'image' => $product->image,
                'coupon_id' => $item['coupon_id'],
                'event_id' => $item['event_id'],
                'event_name' => $item['event_name'],
                'coupon_name' => $item['coupon_name'],
                'coupon_discount' => $item['coupon_discount'],
                'event_discount' => $item['event_discount'],
            ]);

            if($product->type == 2) {
                $this->inventoryRepository->add([
                    'product_id' => $product->id,
                    'number' => $number,
                    'type' => 4,
                    'before_quantity' => $product->amount,
                    'quantity' => $item['amount'],
                    'after_quantity' => $product->amount - $item['amount'],
                ]);
                $this->productRepository->edit($product->id, [
                    'amount' => $product->amount - $item['amount'],
                ]);
            }
        }
    }

    public function orderTotal()
    {
        return $this->repository->orderTotal();
    }

    public function getBarChartData()
    {
        $data = [
            $this->repository->calculate(-11),
            $this->repository->calculate(-10),
            $this->repository->calculate(-9),
            $this->repository->calculate(-8),
            $this->repository->calculate(-7),
            $this->repository->calculate(-6),
            $this->repository->calculate(-5),
            $this->repository->calculate(-4),
            $this->repository->calculate(-3),
            $this->repository->calculate(-2),
            $this->repository->calculate(-1),
            $this->repository->calculate(0),
        ];

        return $data;
    }

    public function createNumber()
    {
        $number = '';
        $characters = '0123456789';
        for($i = 0 ; $i < 2 ; $i++) {
            $number .= $characters[mt_rand(0, strlen($characters) - 1)]; 
        }
        $number = 'O' . date('Ymdhi', time()) .$number;
        return $number;
    }
}