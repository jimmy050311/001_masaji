<?php

namespace App\Interfaces\Product;

use Illuminate\Database\Eloquent\Model;

interface ProductInterface
{
    public function module(): Model;
}