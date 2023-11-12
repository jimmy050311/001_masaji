<?php

namespace App\Services\User;

use App\Repositories\User\LevelRepository;
use App\Services\Service;

class LevelService extends Service
{
    protected $repository;

    public function __construct(LevelRepository $repository)
    {
        $this->repository = $repository;
    }
}