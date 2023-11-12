<?php 

namespace App\Services\Admin;

use App\Interfaces\Admin\AdminInterface;
use App\Repositories\Admin\AdminRepository;
use App\Services\Service;
use Illuminate\Support\Facades\Hash;

class AdminService extends Service
{
    protected $repository;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    public function add($params)
    {
        // 密碼加密
        $params['password'] = Hash::make($params['password']);

        return $this->repository->add($params);
    }

    public function edit($id, $params)
    {
        // 密碼加密
        if(isset($params['password']) && !is_null($params['password'])) {
            $params['password'] = Hash::make($params['password']);
        }
        return $this->repository->edit($id, $params);
    }

    public function getAdminByAccount($account)
    {
        return $this->repository->getAdminByAccount($account);
    }
}