<?php

namespace App\Services\Order;

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

    public function __construct(
        OrderRepository $repository,
        OrderDetailRepository $orderDetailRepository,
        ProductRepository $productRepository,)
    {
        $this->repository = $repository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->productRepository = $productRepository;
    }

    public function add($params)
    {
        if(count($params['cartData']) == 0) {
            throw new Exception('購買商品不可為空');
        }
        $order = $this->repository->add([
            'number' => $this->createNumber(),
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
        }
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