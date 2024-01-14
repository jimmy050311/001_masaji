<?php

namespace App\Services\Track;

use App\Repositories\Track\TrackRepository;
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