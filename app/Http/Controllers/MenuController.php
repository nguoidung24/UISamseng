<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MenuRepository;

class MenuController extends Controller
{

    protected $menuRepository;

    public function __construct(
        MenuRepository $menuRepository,
    ) {
        $this->menuRepository = $menuRepository;
    }
    public function index(Request $request)
    {
        $att            = [];
        $action         = $request->get("action", "");
        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 1000);

        switch ($action) {
            case 'getAll':
                $with   = ["menu"];
                $result = $this->menuRepository->listWhere(
                    $att,
                    $with
                );
                return response()->json($result, 200);
                break;

            case 'getById':
                $with          = ["menu"];
                $att["where"]  = true;
                $att['col']    = 'menu_id';
                $att['math']    = '=';
                $att['where']    = $request->get('menu_id', '');
                $result = $this->menuRepository->listWhere(
                    $att,
                    $with
                );
                return response()->json($result, 200);
                break;

            default:
                $result = ["Not Action" => $action];
                return response()->json($result, 402);
                break;
        }
    }
}
