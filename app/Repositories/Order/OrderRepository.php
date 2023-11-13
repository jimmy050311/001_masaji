<?php

namespace App\Repositories\Order;

use App\Interfaces\Order\OrderInterface;
use App\Models\Order;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderRepository extends Repository implements OrderInterface
{
    private $page;
    public function module(): Model
    {
        return app(Order::class);
    }

    public function total()
    {
        return $this->page;
    }

    public function searchAll($params)
    {
        $query = $this->module()->query()
            ->select($this->module()->getTable() . ".*", 'users.name')
            ->leftJoin('users', $this->module()->getTable() . '.user_id', 'users.id')
            ->orderBy($this->module()->getTable() . '.created_at', 'desc');
        if (isset($params['keyword']) && !is_null($params['keyword'])) {
            $keyValue = $params['keyword'];
            $query->where(function($query) use ($keyValue){
                $query->orWhere('users.name', 'LIKE BINARY', "%$keyValue%");
                $query->orWhere( $this->module()->getTable(). '.number', 'LIKE BINARY', "%$keyValue%");
            });
        }
        if (isset($params['status']) && !is_null($params['status'])) {
            $query = $query->where($this->module()->getTable() . '.status', (int) $params['status']);
        }
        if (isset($params['start_date']) && !is_null($params['start_date'])) {
            $query = $query->where($this->module()->getTable() . '.paid_at', '>=', Carbon::parse($params['start_date']));
        }
        if (isset($params['end_date']) && !is_null($params['end_date'])) {
            $query = $query->where($this->module()->getTable() . '.paid_at', '<=', Carbon::parse($params['end_date'])->addDay());
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