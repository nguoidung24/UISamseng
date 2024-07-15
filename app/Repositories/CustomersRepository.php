<?php

namespace App\Repositories;

use App\Models\Customers;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class CustomersRepository extends BaseRepository
{
    public function model()
    {
        return Customers::class;
    }
}