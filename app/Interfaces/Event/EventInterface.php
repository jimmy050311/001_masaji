<?php

namespace App\Interfaces\Event;

use Illuminate\Database\Eloquent\Model;

interface EventInterface
{
    public function module(): Model;
}