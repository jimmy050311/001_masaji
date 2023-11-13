<?php

namespace App\Interfaces\Contact;

use Illuminate\Database\Eloquent\Model;

interface ContactInterface
{
    public function module(): Model;
}