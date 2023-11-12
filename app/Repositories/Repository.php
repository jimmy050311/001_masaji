<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Repository
{
    private $page;

    public function module(): Model
    {
        return app(Model::class);
    }

    public function total()
    {
        return $this->page;
    }

    public function searchAll($params)
    {
        $query = $this->module()->query()->orderBy('created_at', 'desc');
        if (isset($params['keyword']) && !is_null($params['keyword'])) {
            $query = $query->where($this->module()->getTable() . '.name', 'like', '%' . $params['keyword'] . '%');
        }
        if (isset($params['number']) && !is_null($params['number'])) {
            $query = $query->where($this->module()->getTable() . '.number', 'like', '%' . $params['number'] . '%');
        }
        if (isset($params['status']) && !is_null($params['status'])) {
            $query = $query->where($this->module()->getTable() . '.status', (int) $params['status']);
        }
        if (isset($params['type']) && !is_null($params['type'])) {
            $query = $query->where($this->module()->getTable() . '.type', (int) $params['type']);
        }
        if (isset($params['start_date']) && !is_null($params['start_date'])) {
            $query = $query->where($this->module()->getTable() . '.created_at', '>=', Carbon::parse($params['start_date']));
        }
        if (isset($params['end_date']) && !is_null($params['end_date'])) {
            $query = $query->where($this->module()->getTable() . '.created_at', '<=', Carbon::parse($params['end_date'])->addDay());
        }
        if (isset($params['column']) && !is_null($params['column']) && isset($params['order']) && !is_null($params['order']) && $params['order'] != false) {
            if($params['order'] == 'ascend') {
                $query = $query->orderBy($params['column'], 'asc');
            }else if($params['order'] == 'descend') {
                $query = $query->orderBy($params['column'], 'desc');
            }
        }
        //取的符合資料
        $this->page = $query->count();
        $query = $query->paginate($params['paginate']);

        return $query;
    }

    public function obtain($params)
    {
        $query = $this->module()->query()->orderBy('created_at', 'desc');
        if (isset($params['status']) && !is_null($params['status'])) {
            $query = $query->where($this->module()->getTable() . '.status', (int) $params['status']);
        }
        $query = $query->get();
        
        return $query;
    }

    public function searchById($id)
    {
        return $this->module()->find($id);
    }

    public function add($params)
    {
        return $this->module()->create($params);
    }

    public function edit($id, $params)
    {
        return $this->searchById($id)->update($params);
    }

    public function del($id)
    {
        return $this->module()->find($id)->delete();
    }
}