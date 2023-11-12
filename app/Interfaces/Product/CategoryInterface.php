<?php

namespace App\Interfaces\Product;

use Illuminate\Database\Eloquent\Model;

interface CategoryInterface
{
    public function module(): Model;

    public function deleteAll();
}