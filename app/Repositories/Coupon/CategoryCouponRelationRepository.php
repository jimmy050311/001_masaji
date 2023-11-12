<?php

namespace App\Repositories\Coupon;

use App\Interfaces\Coupon\CategoryCouponRelationInterface;
use App\Models\CategoryCouponRelation;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class CategoryCouponRelationRepository extends Repository implements CategoryCouponRelationInterface
{
    public function module(): Model
    {
        return app(CategoryCouponRelation::class);
    }

    public function searchByCouponId($id)
    {
        return $this->module()->where('coupon_id', $id)->first();
    }
}