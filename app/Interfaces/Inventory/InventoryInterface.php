<?php

namespace App\Repositories\Inventory;

use Illuminate\Database\Eloquent\Model;

interface InventoryInterface
{
    public function module(): Model;
}