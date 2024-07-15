<?php

namespace App\Service;

use App\Models\Contact;
use App\Models\Customers;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactService
{

    public function create($att)
    {
       
        return Contact::create($att);
    }
}
