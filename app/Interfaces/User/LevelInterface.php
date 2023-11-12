<?php

namespace App\Interfaces\User;

use Illuminate\Database\Eloquent\Model;

interface LevelInterface
{
    public function module(): Model;
}