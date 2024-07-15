<?php

namespace App\Http\Controllers;

use App\Repositories\OutstrandingReposetory;
use Illuminate\Http\Request;

class OutstrandingController extends Controller
{
    protected $outstandingReposetory;

    public function __construct(
        OutstrandingReposetory $outstandingReposetory,
    ) {
        $this->outstandingReposetory = $outstandingReposetory;
    }
    public function index(Request $request)
    {
        $data = $this->outstandingReposetory->listWhere(
            [
                'page'   => 1,
                "limit"  => 99999999999
            ]
        );
        return response()->json($data, 200);
    }
}
