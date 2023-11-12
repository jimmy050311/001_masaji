<?php

namespace App\Repositories\User;

use App\Interfaces\User\LevelLogInterface;
use App\Models\UserLevelLog;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class LevelLogRepository extends Repository implements LevelLogInterface
{
    public function module(): Model
    {
        return app(UserLevelLog::class);
    }
}