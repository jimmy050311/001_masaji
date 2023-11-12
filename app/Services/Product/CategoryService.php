<?php

namespace App\Services\Product;

use App\Repositories\Product\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Services\Service;
use Exception;
use Illuminate\Support\Facades\Storage;

class CategoryService extends Service
{
    protected $repository;
    protected $productRepository;

    public function __construct(
        CategoryRepository $repository,
        ProductRepository $productRepository,)
    {
        $this->repository = $repository;
        $this->productRepository = $productRepository;
    }

    public function add($params) {
        if(count($params['image']) == 0) {
            throw new Exception('類別圖片不可為空');
        }
        //圖片 base64 存入storage
        $fileName = "img_".time().rand(10000,99999).".png";
        $imgBase64 = mb_split(",", $params['image'][0]['image'])[1];
        Storage::disk('public')->put(
            $fileName,
            base64_decode($imgBase64)
        );
        $params['image'] = $fileName;
        $this->repository->add($params);
    }

    public function edit($id, $params)
    {
        if($id == 0) {
            $this->repository->deleteAll();
            foreach($params as $item) {
                $this->repository->add($item);
            }
        }else {
            
            if(count($params['image']) == 0) {
                throw new Exception('類別圖片不可為空');
            }
            if(strpos($params['image'][0]['image'], "/storage")) {
                $fileName = mb_split("storage/", $params['image'][0]['image'])[1];
            }else {
                //圖片 base64 存入storage
                $fileName = "img_".time().rand(10000,99999).".png";
                $imgBase64 = mb_split(",", $params['image'][0]['image'])[1];
                Storage::disk('public')->put(
                    $fileName,
                    base64_decode($imgBase64)
                );
            }
            $params['image'] = $fileName;
            $this->repository->edit($id, $params);
        }
    }

    public function del($id)
    {
        if(count($this->productRepository->searchByCategory(['category_id' => $id])) > 0) {
            throw new Exception('該類別有綁定商品無法刪除!');
        }
        $this->repository->del($id);
    }
}