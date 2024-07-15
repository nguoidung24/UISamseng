<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class BannerReposetory extends BaseRepository
{
    public function model()
    {
        return Banner::class;
    }
}