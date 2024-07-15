<?php

namespace App\Repositories;

use App\Models\Outstanding;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class OutstrandingReposetory extends BaseRepository
{
    public function model()
    {
        return Outstanding::class;
    }
}