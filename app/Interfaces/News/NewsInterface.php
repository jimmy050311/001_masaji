<?php

namespace App\Interfaces\News;

use Illuminate\Database\Eloquent\Model;

interface NewsInterface
{
    public function module(): Model;
}