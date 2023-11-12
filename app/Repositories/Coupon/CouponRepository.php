<?php

namespace App\Repositories\Coupon;

use App\Interfaces\Coupon\CouponInterface;
use App\Models\Coupon;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class CouponRepository extends Repository implements CouponInterface
{
    public function module(): Model
    {
        return app(Coupon::class);
    }
}