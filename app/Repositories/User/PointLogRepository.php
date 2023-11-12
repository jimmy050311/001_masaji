<?php

namespace App\Repositories\User;

use App\Interfaces\User\PointLogInterface;
use App\Models\UserPointLog;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class PointLogRepository extends Repository implements PointLogInterface
{
    private $page;
    public function module(): Model
    {
        return app(UserPointLog::class);
    }

    public function total()
    {
        return $this->page;
    }

    public function searchAll($params)
    {
        $query = $this->module()->query()->orderBy('created_at', 'desc');
        if (isset($params['user_id']) && !is_null($params['user_id'])) {
            $query = $query->where($this->module()->getTable() . '.user_id', (int) $params['user_id']);
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