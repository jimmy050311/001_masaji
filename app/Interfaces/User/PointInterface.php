<?php

namespace App\Interfaces\User;

use Illuminate\Database\Eloquent\Model;

interface PointInterface
{
    public function module(): Model;
}