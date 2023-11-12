<?php

namespace App\Interfaces\User;

use Illuminate\Database\Eloquent\Model;

interface UserInterface
{
    public function module(): Model;
}