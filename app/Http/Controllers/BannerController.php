<?php

namespace App\Http\Controllers;

use App\Repositories\BannerReposetory;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $bannerReposetory;

    public function __construct(
        BannerReposetory $bannerReposetory,
    ) {
        $this->bannerReposetory = $bannerReposetory;
    }
    public function index(Request $request)
    {
        $data = $this->bannerReposetory->listWhere(
            [
                'page'   => 1,
                "limit"  => 99999999999
            ]
        );
        return response()->json($data, 200);
    }
}
