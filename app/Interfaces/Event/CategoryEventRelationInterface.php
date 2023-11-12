<?php

namespace App\Interfaces\Event;

use Illuminate\Database\Eloquent\Model;

interface CategoryEventRelationInterface
{
    public function module(): Model;
}