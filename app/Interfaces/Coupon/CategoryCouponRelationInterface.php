<?php

namespace App\Interfaces\Coupon;

use Illuminate\Database\Eloquent\Model;

interface CategoryCouponRelationInterface
{
    public function module(): Model;
}