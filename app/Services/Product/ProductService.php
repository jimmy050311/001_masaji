<?php

namespace App\Services\Product;

use App\Repositories\Product\CategoryRelationRepository;
use App\Repositories\Product\ProductImageRepository;
use App\Repositories\Product\ProductRepository;
use App\Services\Service;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProductService extends Service
{
    protected $repository;
    protected $categoryRelationRepository;
    protected $productImageRepository;

    public function __construct(
        ProductRepository $repository,
        CategoryRelationRepository $categoryRelationRepository,
        ProductImageRepository $productImageRepository)
    {
        $this->repository = $repository;
        $this->categoryRelationRepository = $categoryRelationRepository;
        $this->productImageRepository = $productImageRepository;
    }

    public function add($params)
    {
        if(count($params['imageData']) == 0) {
            throw new Exception('圖片不可為空');
        }

        $productImg = [];
        foreach($params['imageData'] as $image) {
            $fileName = "img_".time().rand(10000,99999).".png";
            $imgBase64 = mb_split(",", $image['image'])[1];
            Storage::disk('public')->put(
                $fileName,
                base64_decode($imgBase64)
            );
            $productImg[] = $fileName;
        }

        $product = $this->repository->add([
            'name' => $params['name'],
            'number' => $params['number'],
            'introduction' => $params['introduction'],
            'desc' => nl2br($params['desc']),
            'spec' => $params['spec'],
            'image' => $productImg[0],
            'low_amount' => $params['low_amount'] ?? null,
            'minute' => $params['minute'] ?? null,
            'category_id' => $params['category_id'],
            'status' => $params['status'],
            'type' => $params['type'],
            'price' => $params['price'],
        ]);

        //類別
        $this->categoryRelationRepository->add([
            'product_id' => $product->id,
            'category_id' => $params['category_id']
        ]);

        foreach($productImg as $index => $item) {
            $this->productImageRepository->add([
                'product_id' => $product->id,
                'image' => $item,
                'sort' => $index
            ]);
        }
    }

    public function edit($id, $params)
    {
        if(count($params['imageData']) == 0) {
            throw new Exception('圖片不可為空');
        }

        $productImg = [];
        foreach($params['imageData'] as $image) {
            if(strpos($image['image'], "/storage")) {
                $path = mb_split("storage/", $image['image'])[1];
                $productImg[] = $path;
            }else {
                $fileName = "img_".time().rand(10000,99999).".png";
                $imgBase64 = mb_split(",", $image['image'])[1];
                Storage::disk('public')->put(
                    $fileName,
                    base64_decode($imgBase64)
                );
                $productImg[] = $fileName;
            }
        }

        $this->repository->edit($id, [
            'name' => $params['name'],
            'number' => $params['number'],
            'introduction' => $params['introduction'],
            'desc' => nl2br($params['desc']),
            'spec' => $params['spec'],
            'image' => $productImg[0],
            'low_amount' => $params['low_amount'] ?? null,
            'minute' => $params['minute'] ?? null,
            'category_id' => $params['category_id'],
            'status' => $params['status'],
            'type' => $params['type'],
            'price' => $params['price'],
        ]);

        $this->categoryRelationRepository->del($id);
        $this->categoryRelationRepository->add([
            'product_id' => $id,
            'category_id' => $params['category_id']
        ]);

        $this->productImageRepository->del($id);
        foreach($productImg as $index => $item) {
            $this->productImageRepository->add([
                'product_id' => $id,
                'image' => $item,
                'sort' => $index
            ]);
        }
    }

    public function editLowAmount($id, $params)
    {
        $this->repository->editLowAmount($id, $params);
    }
}