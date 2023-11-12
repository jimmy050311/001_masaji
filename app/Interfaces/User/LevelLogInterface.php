<?php

namespace App\Interfaces\User;

use Illuminate\Database\Eloquent\Model;

interface LevelLogInterface
{
    public function module(): Model;
}