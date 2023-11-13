<?php

namespace App\Services\User;

use App\Repositories\User\LevelLogRepository;
use App\Repositories\User\PointRepository;
use App\Repositories\User\UserRepository;
use App\Services\Service;
use Exception;

class UserService extends Service
{
    protected $repository;
    protected $levelLogRepository;
    protected $pointRepository;
    public function __construct(
        UserRepository $repository,
        LevelLogRepository $levelLogRepository,
        PointRepository $pointRepository,
    )
    {
        $this->repository = $repository;
        $this->levelLogRepository = $levelLogRepository;
        $this->pointRepository = $pointRepository;
    }

    public function add($params)
    {
        $params['refcode'] = $this->makeRefcode();
        $user = $this->repository->add($params);
        $this->pointRepository->add([
            'user_id' => $user->id,
            'point' => 0,
        ]);
    }

    public function edit($id, $params)
    {
        $user = $this->repository->searchById($id);

        if($user->level_id != $params['level_id']) {
            $this->levelLogRepository->add([
                'user_id' => $user->id,
                'admin_id' => $params['admin_id'],
                'ip' => $params['ip'],
                'type' => 2,
                'before_level' => $user->level_id,
                'after_level' => $params['level_id'],
             ]);
        }
        
        $this->repository->edit($id, $params);
    }

    public function updatePassword($id, $params)
    {
        $user = $this->repository->searchById($id);
        if(isset($params['old_password']) && !is_null($params['old_password'])) {
            if($user->password != $params['old_password']) {
                throw new Exception('密碼數入錯誤');
            }   
        }
        $this->repository->edit($id, $params);
    }

    public function userAmount()
    {
        return $this->repository->userAmount();
    }

    public function makeRefcode()
    {
        $str = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 
        'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's', 
        't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D', 
        'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O', 
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z', 
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $keys = array_rand($str, 8);
        $refcode = '';
        for($i = 0; $i < 8; $i++)
        {
            // 将 $length 个数组元素连接成字符串
            $refcode .= $str[$keys[$i]];
        }
        return $refcode;
    }
}