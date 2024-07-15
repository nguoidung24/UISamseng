<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class OrderRepository extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }
}