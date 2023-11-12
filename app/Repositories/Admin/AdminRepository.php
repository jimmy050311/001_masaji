<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\AdminInterface;
use App\Models\Admin;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class AdminRepository extends Repository implements AdminInterface
{
    public function module(): Model
    {
        return app(Admin::class);
    }

    public function getAdminByAccount($account)
    {
        return $this->module()->where('account', $account)->first();
    }
}