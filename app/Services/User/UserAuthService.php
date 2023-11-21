<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;

class UserAuthService extends UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function authenticate($account, $password) {
        
        $user = $this->repository->getUserByAccount($account);
        
        if (empty($user)) {
            throw new \Exception("帳號密碼錯誤");
        }

        if ($user->password != $password) {
            throw new \Exception("帳號密碼錯誤");
        }

        if ($user->status == 0) {
            throw new \Exception("已被停權，請聯絡其他管理員進行開通");
        }
        
        return true;
    }
}