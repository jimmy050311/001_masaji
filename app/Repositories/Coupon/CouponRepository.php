<?php

namespace App\Repositories\Coupon;

use App\Interfaces\Coupon\CouponInterface;
use App\Models\Coupon;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CouponRepository extends Repository implements CouponInterface
{
    public function module(): Model
    {
        return app(Coupon::class);
    }

    public function obtain($params)
    {
        $query = $this->module()->query()
            ->select($this->module()->getTable() . ".*", "category_coupon_relation.category_id")
            ->leftJoin("category_coupon_relation", $this->module()->getTable() . ".id", "category_coupon_relation.coupon_id")
            ->orderBy('created_at', 'desc');
        $query = $query->where($this->module()->getTable() . '.end_date', '>=', Carbon::now());
        $query = $query->where($this->module()->getTable() . '.start_date', '<=', Carbon::now());
        if (isset($params['category_id']) && !is_null($params['category_id'])) {
            $query = $query->where($this->module()->getTable() . '.category_id', (int) $params['category_id']);
        }
        if (isset($params['status']) && !is_null($params['status'])) {
            $query = $query->where($this->module()->getTable() . '.status', (int) $params['status']);
        }
        
        $query = $query->get();
        
        return $query;
    }
}