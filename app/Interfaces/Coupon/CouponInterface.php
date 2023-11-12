<?php

namespace App\Interfaces\Coupon;

use Illuminate\Database\Eloquent\Model;

interface CouponInterface
{
    public function module(): Model;
}