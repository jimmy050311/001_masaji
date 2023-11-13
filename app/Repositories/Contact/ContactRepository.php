<?php

namespace App\Repositories\Contact;

use App\Interfaces\Contact\ContactInterface;
use App\Models\Contact;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class ContactRepository extends Repository implements ContactInterface
{
    public function module(): Model
    {
        return app(Contact::class);
    }
}