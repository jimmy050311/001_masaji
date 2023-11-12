<?php

namespace App\Repositories\Product;

use App\Interfaces\Product\ProductInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Repositories\Repository;
use Carbon\Carbon;

class ProductRepository extends Repository implements ProductInterface
{
    private $page;
    public function module(): Model
    {
        return app(Product::class);
    }

    public function total()
    {
        return $this->page;
    }

    public function searchAll($params)
    {
        $query = $this->module()->query()->orderBy('created_at', 'desc');
        if (isset($params['keyword']) && !is_null($params['keyword'])) {
            $keyValue = $params['keyword'];
            $query->where(function($query) use ($keyValue){
                $query->orWhere('name', 'LIKE BINARY', "%$keyValue%");
                $query->orWhere('number', 'LIKE BINARY', "%$keyValue%");
            });
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
        if (isset($params['type']) && !is_null($params['type'])) {
            $query = $query->where($this->module()->getTable() . '.type', (int) $params['type']);
        }
        $query = $query->get();
        
        return $query;
    }

    public function searchByCategory($params)
    {
        $query = $this->module()->query()->where('status', 1);
        if(isset($params['category_id']) && !is_null($params['category_id'])) {
            $query = $query->where('category_id', $params['category_id']);
        }
        $query = $query->orderBy('created_at', 'desc');

        return $query->get();
    }

    public function editLowAmount($id, $params) {
        $this->module()->find($id)->update($params);
    }
}