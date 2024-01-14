<?php

namespace App\Interfaces\Track;

use Illuminate\Database\Eloquent\Model;

interface TrackInterface
{
    public function module(): Model;
}