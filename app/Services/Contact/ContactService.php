<?php

namespace App\Services\Contact;

use App\Repositories\Contact\ContactRepository;
use App\Services\Service;

class ContactService extends Service
{
    protected $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }
    
}