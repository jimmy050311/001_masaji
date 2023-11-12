<?php

namespace App\Interfaces\User;

use Illuminate\Database\Eloquent\Model;

interface PointLogInterface
{
    public function module(): Model;
}