<?php

namespace App\Services\News;

use App\Repositories\News\NewsRepository;
use App\Services\Service;
use Exception;
use Illuminate\Support\Facades\Storage;

class NewsService extends Service
{
    protected $repository;

    public function __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function add($params)
    {
        if(count($params['image']) == 0) {
            throw new Exception('圖片不可為空');
        }
        $fileName = "img_".time().rand(10000,99999).".png";
        $imgBase64 = mb_split(",", $params['image'][0]['image'])[1];
        Storage::disk('public')->put(
            $fileName,
            base64_decode($imgBase64)
        );

        $params['image'] = $fileName;
        $this->repository->add($params);
    }

    public function edit($id, $params) {
        if(count($params['image']) == 0) {
            throw new Exception('圖片不可為空');
        }
        //圖片 base64 存入storage
        $fileName = '';
        if(strpos($params['image'][0]['image'], "/storage")) {
            $fileName = mb_split("storage/", $params['image'][0]['image'])[1];
        }else {
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