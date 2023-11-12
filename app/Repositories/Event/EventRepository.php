<?php

namespace App\Repositories\Event;

use App\Interfaces\Event\EventInterface;
use App\Models\Event;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class EventRepository extends Repository implements EventInterface
{
    public function module(): Model
    {
        return app(Event::class);
    }
}