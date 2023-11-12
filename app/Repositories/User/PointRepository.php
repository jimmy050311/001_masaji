<?php

namespace App\Repositories\User;

use App\Interfaces\User\PointInterface;
use App\Models\UserPoint;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class PointRepository extends Repository implements PointInterface
{
    private $page;
    public function module(): Model
    {
        return app(UserPoint::class);
    }

    public function total()
    {
        return $this->page;
    }

    public function searchAll($params)
    {
        $query = $this->module()->query()
            ->select($this->module()->getTable() . '.*', 'users.name', 'users.id', 'users.account')
            ->leftJoin('users', 'users.id', $this->module()->getTable() . '.user_id')
            ->orderBy('created_at', 'desc');

        if (isset($params['keyword']) && !is_null($params['keyword'])) {
            $keyValue = $params['keyword'];
            $query->where(function($query) use ($keyValue){
                $query->orWhere('users.name', 'LIKE BINARY', "%$keyValue%");
                $query->orWhere('users.account', 'LIKE BINARY', "%$keyValue%");
            });
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

    public function searchById($id)
    {
        return $this->module()->where("user_id", $id)->first();
    }

    public function edit($id, $params)
    {
        $this->module()->where("user_id", $id)->update(['point' => $params['point']]);
    }
}