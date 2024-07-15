<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }
}