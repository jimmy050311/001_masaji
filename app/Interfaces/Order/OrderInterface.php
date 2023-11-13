<?php

namespace App\Interfaces\Order;

use Illuminate\Database\Eloquent\Model;

interface OrderInterface
{
    public function module(): Model;
}