<?php

namespace App\Services\Coupon;

use App\Repositories\Coupon\CategoryCouponRelationRepository;
use App\Repositories\Coupon\CouponRepository;
use App\Services\Service;
use Carbon\Carbon;
use Exception;

class CouponService extends Service
{
    protected $repository;
    protected $categoryCouponRelationRepository;

    public function __construct(
        CouponRepository $repository,
        CategoryCouponRelationRepository $categoryCouponRelationRepository)
    {
        $this->repository = $repository;
        $this->categoryCouponRelationRepository = $categoryCouponRelationRepository;
    }

    public function add($params)
    {
        if($params['discount'] >= 1 || $params['discount'] < 0) {
            throw new Exception('折扣欄位請填入0~0.99的數字');
        }
        if(Carbon::parse($params['start_date'])->greaterThanOrEqualTo(Carbon::parse($params['end_date']))) {
            throw new Exception('結束時間必須大於開始時間');
        }
        $coupon = $this->repository->add([
            'name' => $params['name'],
            'desc' => $params['desc'],
            'status' => $params['status'],
            'discount' => $params['discount'],
            'start_date' => $params['start_date'],
            'end_date' => $params['end_date'],
            'code' => $this->makeCode(),
        ]);
        $this->categoryCouponRelationRepository->add([
            'coupon_id' => $coupon->id,
            'category_id' => $params['category_id'],
        ]);
    }

    public function edit($id, $params)
    {
        if($params['discount'] >= 1 || $params['discount'] < 0) {
            throw new Exception('折扣欄位請填入0~0.99的數字');
        }
        if(Carbon::parse($params['start_date'])->greaterThanOrEqualTo(Carbon::parse($params['end_date']))) {
            throw new Exception('結束時間必須大於開始時間');
        }
        $this->repository->edit($id, [
            'name' => $params['name'],
            'desc' => $params['desc'],
            'status' => $params['status'],
            'discount' => $params['discount'],
            'start_date' => $params['start_date'],
            'end_date' => $params['end_date'],
            'code' => $params['code'],
        ]);
        $relationId = $this->categoryCouponRelationRepository->searchByCouponId($id)->id;
        $this->categoryCouponRelationRepository->edit($relationId, [
            'category_id' => $params['category_id'],
        ]);
    }

    public function makeCode()
    {
        $str = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 
        'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's', 
        't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D', 
        'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O', 
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z', 
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $keys = array_rand($str, 10);
        $refcode = '';
        for($i = 0; $i < 10; $i++)
        {
            // 将 $length 个数组元素连接成字符串
            $refcode .= $str[$keys[$i]];
        }
        return $refcode;
    }
}