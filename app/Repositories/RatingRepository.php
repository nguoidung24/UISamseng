<?php

namespace App\Repositories;

use App\Models\Rating;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class RatingRepository extends BaseRepository
{
    public function model()
    {
        return Rating::class;
    }
}