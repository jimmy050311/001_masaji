<?php

namespace App\Repositories\Track;

use App\Interfaces\Track\TrackInterface;
use App\Models\Track;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class TrackRepository extends Repository implements TrackInterface
{
    public function module(): Model
    {
        return app(Track::class);
    }
}