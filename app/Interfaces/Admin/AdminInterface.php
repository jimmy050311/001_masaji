<?php

namespace App\Interfaces\Admin;

use Illuminate\Database\Eloquent\Model;

interface AdminInterface
{
    public function module(): Model;

    public function getAdminByAccount($params);
}