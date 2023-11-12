<?php

namespace App\Repositories\User;

use App\Interfaces\User\UserInterface;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository implements UserInterface
{
    public function module(): Model
    {
        return app(User::class);
    }

    public function getUserByAccount($account)
    {
        return $this->module()->where('account', $account)->first();
    }
}