<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $menuRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        MenuRepository $menuRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->menuRepository = $menuRepository;
    }

    public function index(Request $request)
    {
        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 9999999999999999);
        $res            = $this->categoryRepository->listWhere($att, ['menu']);
        $data = [
            "data"    => $res,
        ];
        return view('categorys', $data);
    }
    public function createCategory(Request $request)
    {

        if (isset($request['create'])) {
            $res = $this->categoryRepository->create([
                "category_name"  => $request['category_name'],
                "thumbnail"      => $request['thumbnail'],
                "menu_id"        => $request['menu_id'],
                "parent_id"      => 0,

            ]);
            if ($res) {
                return redirect()->route('categorys')->with("success", "Thêm mới thành công!");
            }
        }
        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 9999999999999999);
        $menu = $this->menuRepository->listWhere($att);
        $data = [
            'isCreate' => true,
            "menu"     => $menu
        ];
        return view('edit_category', $data);
    }
    public function editCategory(Request $request)
    {
        $id  = $request->get('id', 0);

        if (isset($request['edit'])) {
            $update  = [
                "category_name"  => $request['category_name'],
                "thumbnail"      => $request['thumbnail'],
                "menu_id"        => $request['menu_id'],
                "parent_id"      => 0,

            ];
            $res = $this->categoryRepository->edit(
                ["category_id"],
                [$id],
                $update,
            );
            if ($res) {
                return redirect()->route('categorys')->with("success", "Sửa thành công!");
            }
            return redirect()->route('categorys')->with("fail", "Sửa không thành công!");
        }

        $att_cate['page']    = $att_menu['page']    = $request->get("page", 1);
        $att_menu['limit']   = $att_cate['limit']   = $request->get("limit", 9999999999999999);
        $att_cate['where']   = $id;
        $att_cate['math']    = "=";
        $att_cate['col']     = "category_id";

        $category = $this->categoryRepository->listWhere($att_cate);
        $menu     = $this->menuRepository->listWhere($att_menu);
        $data = [
            'isCreate' => false,
            "menu"     => $menu,
            "category" => $category['data'][0]
        ];
        return view('edit_category', $data);
    }
    public function deleteCategory(Request $request)
    {
        $res = $this->categoryRepository->deleteByCol(['category_id'], [$request['id']]);
        if ($res) {
            return redirect()->route('categorys')->with("success", "Xóa thành công!");
        }

        return redirect()->route('categorys')->with("fail", "Xóa không thành công!");
    }
}
