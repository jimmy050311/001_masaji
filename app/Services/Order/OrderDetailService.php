<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderDetailRepository;
use App\Repositories\Product\ProductRepository;
use App\Services\Service;

class OrderDetailService extends Service
{
    protected $repository;
    protected $productRepository;

    public function __construct(
        OrderDetailRepository $repository,
        ProductRepository $productRepository)
    {
        $this->repository = $repository;
        $this->productRepository = $productRepository;
    }

    public function getPieChartData()
    {
        $data = $this->repository->groupCal();

        $result = [];
        foreach($data as $item) {
            $result['name'][] = $this->productRepository->searchById($item->product_id)->name;
            $result['sum'][] = $item->sum;
        }

        return $result;
    }
}