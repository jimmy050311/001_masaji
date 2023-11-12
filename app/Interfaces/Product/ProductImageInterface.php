<?php

namespace App\Interfaces\Product;

use Illuminate\Database\Eloquent\Model;

interface ProductImageInterface
{
    public function module(): Model;
}