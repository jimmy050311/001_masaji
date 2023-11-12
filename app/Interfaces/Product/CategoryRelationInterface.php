<?php

namespace App\Interfaces\Product;

use Illuminate\Database\Eloquent\Model;

interface CategoryRelationInterface
{
    public function module(): Model;
}