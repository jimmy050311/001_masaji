<?php

namespace App\Repositories\Order;

use App\Interfaces\Order\OrderDetailInterface;
use App\Models\OrderDetail;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class OrderDetailRepository extends Repository implements OrderDetailInterface
{
    public function module(): Model
    {
        return app(OrderDetail::class);
    }
}