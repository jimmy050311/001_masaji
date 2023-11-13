<?php

namespace App\Repositories\Event;

use App\Interfaces\Event\EventInterface;
use App\Models\Event;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EventRepository extends Repository implements EventInterface
{
    public function module(): Model
    {
        return app(Event::class);
    }

    public function obtain($params)
    {
        $query = $this->module()->query()
            ->select($this->module()->getTable() . ".*", "category_event_relation.category_id")
            ->leftJoin("category_event_relation", $this->module()->getTable() . ".id", "category_event_relation.event_id")
            ->orderBy('created_at', 'desc');
        $query = $query->where($this->module()->getTable() . '.end_date', '>=', Carbon::now());
        $query = $query->where($this->module()->getTable() . '.start_date', '<=', Carbon::now());
        if (isset($params['category_id']) && !is_null($params['category_id'])) {
            $query = $query->where($this->module()->getTable() . '.category_id', (int) $params['category_id']);
        }
        if (isset($params['status']) && !is_null($params['status'])) {
            $query = $query->where($this->module()->getTable() . '.status', (int) $params['status']);
        }
        
        $query = $query->get();
        
        return $query;
    }
}