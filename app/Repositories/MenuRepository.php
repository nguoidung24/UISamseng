<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class MenuRepository extends BaseRepository
{
    public function model()
    {
        return Menu::class;
    }
}