<?php

namespace App\Services\User;

use App\Repositories\User\PointLogRepository;
use App\Services\Service;

class PointLogService extends Service
{
    protected $repository;

    public function __construct(PointLogRepository $repository)
    {
        $this->repository = $repository;
    }
}