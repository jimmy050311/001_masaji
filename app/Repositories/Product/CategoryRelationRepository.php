<?php

namespace App\Repositories\Product;

use App\Interfaces\Product\CategoryRelationInterface;
use App\Models\ProductCategoryRelation;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class CategoryRelationRepository extends Repository implements CategoryRelationInterface
{
    public function module(): Model
    {
        return app(ProductCategoryRelation::class);
    }

    public function del($id)
    {
        return $this->module()->where('product_id', $id)->delete();
    }
}