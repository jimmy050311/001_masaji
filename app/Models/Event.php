<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';

    protected $guarded = [];

    public function categoryEventRelation()
    {
        return $this->hasOne(CategoryEventRelation::class, 'event_id', 'id');
    }
}
