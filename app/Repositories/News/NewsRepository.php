<?php

namespace App\Repositories\News;

use App\Interfaces\News\NewsInterface;
use App\Models\News;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NewsRepository extends Repository implements NewsInterface
{
    private $page;
    public function module(): Model
    {
        return app(News::class);
    }

    public function total()
    {
        return $this->page;
    }

    public function searchAll($params)
    {
        $query = $this->module()->query()->orderBy('created_at', 'desc');
        if (isset($params['keyword']) && !is_null($params['keyword'])) {
            $query = $query->where($this->module()->getTable() . '.title', 'like', '%' . $params['keyword'] . '%');
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
}