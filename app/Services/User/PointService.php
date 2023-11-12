<?php

namespace App\Services\User;

use App\Repositories\User\PointLogRepository;
use App\Repositories\User\PointRepository;
use App\Services\Service;

class PointService extends Service
{
    protected $repository;
    protected $pointLogRepository;

    public function __construct(
        PointRepository $repository,
        PointLogRepository $pointLogRepository,)
    {
        $this->repository = $repository;
        $this->pointLogRepository = $pointLogRepository;
    }

    public function edit($id, $params)
    {
        $point = $this->repository->searchById($id)->point;
        $this->pointLogRepository->add([
            'user_id' => $id,
            'admin_id' => $params['admin_id'],
            'ip' => $params['ip'],
            'before_point' => $point,
            'balance' => $params['point'] - $point,
            'after_point' => $params['point'],
            'remark' => $params['remark']
        ]);
        $this->repository->edit($id, $params);
    }
}