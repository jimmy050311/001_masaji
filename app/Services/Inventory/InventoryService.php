<?php

namespace App\Services\Inventory;

use App\Repositories\Inventory\InventoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Services\Service;
use Exception;

class InventoryService extends Service
{
    protected $repository;
    protected $productRepository;

    public function __construct(
        InventoryRepository $repository,
        ProductRepository $productRepository)
    {
        $this->repository = $repository;
        $this->productRepository = $productRepository;
    }

    public function add($params)
    {
        $product = $this->productRepository->searchById($params['product_id']);
        $afterAmount = 0;
        if($params['type'] == 3 || $params['type'] == 4 || $params['type'] == 99) {
            $afterAmount = $product->amount - $params['amount'];
        }else {
            $afterAmount = $product->amount + $params['amount'];
        }
        if($afterAmount < 0) {
            throw new Exception('庫存數量不足');
        }
        $this->repository->add([
            'product_id' => $params['product_id'],
            'admin_id' => session()->get('admin')['id'] ?? 0,
            'number' => $this->createNumber(),
            'type' => $params['type'],
            'before_quantity' => $product->amount,
            'quantity' => $params['amount'],
            'after_quantity' => $afterAmount,
            'remark' => $params['remark']
        ]);

        $this->productRepository->edit($params['product_id'], [
            'amount' => $afterAmount,
        ]);
    }

    public function createNumber()
    {
        $number = '';
        $characters = '0123456789';
        for($i = 0 ; $i < 2 ; $i++) {
            $number .= $characters[mt_rand(0, strlen($characters) - 1)]; 
        }
        $number = 'C' . date('Ymdhi', time()) .$number;
        return $number;
    }
}