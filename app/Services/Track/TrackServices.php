<?php

namespace App\Repositories\Track;

use App\Services\Service;

class TrackServices extends Service
{
    protected $repository;
    public function __construct(
        TrackRepository $repository,
    )
    {
        $this->repository = $repository;
    }
}