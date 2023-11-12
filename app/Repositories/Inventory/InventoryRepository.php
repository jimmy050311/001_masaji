<?php

namespace App\Repositories\Inventory;

use App\Interfaces\Inventory\InventoryInterface;
use App\Models\Inventory;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InventoryRepository extends Repository
{
    private $page;

    public function module(): Model
    {
        return app(Inventory::class);
    }

    public function total()
    {
        return $this->page;
    }

    public function searchAll($params)
    {
        $query = $this->module()->query()
            ->select('inventories.*', 'products.name', 'products.number as product_number')
            ->leftJoin('products', 'product_id', 'products.id')->orderBy('inventories.created_at', 'desc');
        if (isset($params['keyword']) && !is_null($params['keyword'])) {
            $keyValue = $params['keyword'];
            $query->where(function($query) use ($keyValue){
                $query->orWhere('products.name', 'LIKE BINARY', "%$keyValue%");
                $query->orWhere('inventories.number', 'LIKE BINARY', "%$keyValue%");
            });
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