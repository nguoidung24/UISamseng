<?php

namespace App\Http\Controllers;

use App\Repositories\ColorRepository;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected $colorRepository;

    public function __construct(
        ColorRepository $colorRepository,
    ) {
        $this->colorRepository = $colorRepository;
    }
    public function index(Request $request)
    {
        $action         = $request->get("action", "");
        $result         = ["Not Action" => $action];
        $att            = [];

        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 1000);

        if ($action == "getAll") {
            $result = $this->colorRepository->listWhere($att);
            return response()->json($result, 200);
        }
    }
}
