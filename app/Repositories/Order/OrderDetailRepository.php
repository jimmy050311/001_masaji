<?php

namespace App\Repositories\Order;

use App\Interfaces\Order\OrderDetailInterface;
use App\Models\OrderDetail;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderDetailRepository extends Repository implements OrderDetailInterface
{
    public function module(): Model
    {
        return app(OrderDetail::class);
    }

    public function groupCal()
    {
        $query = $this->module()->query();
        $query = $query->where($this->module()->getTable() . '.created_at', '>=', Carbon::now()->startOfMonth()->addMonths(-6));
        $query = $query->where($this->module()->getTable() . '.created_at', '<=', Carbon::now()->addDay());
        $data = $query
                ->selectRaw('SUM(amount) as sum, product_id')
                ->groupBy('product_id')
                ->orderBy('sum', 'desc')
                ->take(10)
                ->get();
        
        return $data;
    }
}