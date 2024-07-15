<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ColorRepository;
use App\Repositories\MenuRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class TrainDataController extends Controller
{

    protected $productsRepository;


    public function __construct(
        ProductRepository $productsRepository,
    ) {
        $this->productsRepository = $productsRepository;
    }
    
    public function index(Request $request)
    {
        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 9999999999999999999999999999);
        $with           = ['color', "category"];
      

        $result = [
            "data"   => $this->productsRepository->listWhere($att, $with)["data"],
        ];
        return view('train_data', $result);
    }
}
