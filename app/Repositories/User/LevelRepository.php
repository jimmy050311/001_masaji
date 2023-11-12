<?php

namespace App\Repositories\User;

use App\Interfaces\User\LevelInterface;
use App\Models\Level;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class LevelRepository extends Repository implements LevelInterface
{
    public function module(): Model
    {
        return app(Level::class);
    }
}