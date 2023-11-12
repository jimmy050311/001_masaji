<?php

namespace App\Repositories\Event;

use App\Interfaces\Event\CategoryEventRelationInterface;
use App\Models\CategoryEventRelation;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class CategoryEventRelationRepository extends Repository implements CategoryEventRelationInterface
{
    public function module(): Model
    {
        return app(CategoryEventRelation::class);
    }

    public function searchByEventId($id)
    {
        return $this->module()->where('event_id', $id)->first();
    }
}