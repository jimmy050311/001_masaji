<?php

namespace App\Services\Admin;

use App\Repositories\Admin\AdminRepository;
use Illuminate\Support\Facades\Hash;

class AdminAuthService extends AdminService
{
    protected $repository;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    public function authenticate($account, $password) {
        
        $admin = $this->repository->getAdminByAccount($account);

        if (empty($admin)) {
            throw new \Exception("帳號密碼錯誤");
        }

        if (!Hash::check($password, $admin->password)) {
            throw new \Exception("帳號密碼錯誤");
        }

        if ($admin->status == 0) {
            throw new \Exception("已被停權，請聯絡其他管理員進行開通");
        }

        return true;
    }
}