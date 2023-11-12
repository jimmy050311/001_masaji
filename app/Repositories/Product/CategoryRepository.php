<?php

namespace App\Repositories\Product;

use App\Interfaces\Product\CategoryInterface;
use App\Models\Category;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends Repository implements CategoryInterface
{
    public function module(): Model
    {
        return app(Category::class);
    }

    public function searchAll($params)
    {
        $query = $this->module()->orderBy('sort', 'asc');
        if (isset($params['status']) && !is_null($params['status'])) {
            $query = $query->where($this->module()->getTable() . '.status', (int) $params['status']);
        }
        return $query->get();
    }

    public function deleteAll()
    {
        $this->module()->truncate();
    }
}