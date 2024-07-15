<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
    ) {
        $this->categoryRepository = $categoryRepository;
    }
    public function index(Request $request)
    {
        $action         = $request->get("action", "");
        $result         = ["Not Action" => $action];
        $att            = [];

        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 1000);

        if ($action == "getAll") {
            $result = $this->categoryRepository->listWhere($att, ["menu"]);
            return response()->json($result, 200);
        }
        if ($action == "create") {
            $att['category_id']     = $request->category_id;
            $att['menu_id']         = $request->menu_id;
            $att['category_name']   = $request->category_name;
            $att['thumbnail']       = $request->thumbnail;
            $att['parent_id']       = $request->parent_id;
   
            $result = $this->categoryRepository->create(
                $att
            );
            return response()->json($result, 200);
        }
        return response()->json($result, 402);
    }
}
