<?php

namespace App\Interfaces\Order;

use Illuminate\Database\Eloquent\Model;

interface OrderDetailInterface
{
    public function module(): Model;
}