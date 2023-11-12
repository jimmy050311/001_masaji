<?php

namespace App\Services;

class Service
{
    protected $repository;

    public function total($paginate)
    {
        return ceil($this->repository->total()/$paginate);
    }

    public function searchAll($params)
    {
        return $this->repository->searchAll($params);
    }

    public function obtain($params)
    {
        return $this->repository->obtain($params);
    }

    public function searchById($id)
    {
        return $this->repository->searchById($id);
    }

    public function add($params)
    {
        return $this->repository->add($params);
    }

    public function edit($id, $params)
    {
        return $this->repository->edit($id, $params);
    }

    public function del($id)
    {
        return $this->repository->del($id);
    }
}