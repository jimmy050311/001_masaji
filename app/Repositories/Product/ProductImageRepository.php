<?php

namespace App\Repositories\Product;

use App\Interfaces\Product\ProductImageInterface;
use App\Models\ProductImage;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class ProductImageRepository extends Repository implements ProductImageInterface
{
    public function module(): Model
    {
        return app(ProductImage::class);
    }

    public function del($id)
    {
        return $this->module()->where('product_id', $id)->delete();
    }
}