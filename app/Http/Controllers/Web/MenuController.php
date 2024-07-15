<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

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
        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 9999999999999999);
        $att['action']  = 'getAll';
        $menus = $this->menuRepository->listWhere($att);
        $data = [
            'menus'    => $menus['data'],
            "linkBack" => route('categorys').'/'.$request->get("action",'').'?id='.$request->get("id",'')
        ];
        return view("menu", $data);
    }
    public function menuCreate(Request $request)
    {
        if (isset($request['create'])) {
            $res = true;
            $res = $this->menuRepository->create([
                "menu_name"    => $request['menu_name'],
                "display_name" => $request['display_name'],
            ]);
            if ($res) {
                return redirect()->route('menus')->with('data', ['success','Tạo thành công',$request['linkBack']]);
            } else {
                return redirect()->route('menus')->with("data", ['warning','Tạo không thành công!',$request['linkBack']]);
            }
        }
    }
    public function menuDelete(Request $request)
    {
        $res = $this->menuRepository->deleteByCol(
            ['menu_id'],
            [$request->get("id", 0)]
        );
        if ($res) {
            return redirect()->route('menus')->with('success', 'Xóa thành công');
        } else {
            return redirect()->route('menus')->with("fail", 'Xóa không thành công!');
        }
    }
}
