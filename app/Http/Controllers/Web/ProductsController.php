<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $productsRepository;

    public function __construct(
        ProductRepository $productsRepository,
    ) {
        $this->productsRepository = $productsRepository;
    }
    public function getAll(Request $request)
    {
        $action         = $request->get("action", "getAll");
        $search         = $request->get("search", "");
        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 5);
        $with           = ['color', 'category'];
        switch ($action) {
            case 'getAll':
                if ($search) {
                    $att['where']  = '%' . $search . '%';
                    $att['col']    =  'product_name';
                    $att['math']   =  'like';
                }
                $result = [
                    "data"   => $this->productsRepository->listWhere($att, $with),
                    "search" => $search
                ];
                break;
            case 'create':
                $request->validate([
                    'product_id'      => 'required',
                    'product_name'    => 'required',
                    'thumbnail'       => 'required',
                    'color_id'        => 'required',
                    'category_id'     => 'required',
                    'sold'            => 'required',
                    'price'           => 'required',
                    'rating'          => 'required',
                    'total_rating'    => 'required',
                    'status'          => 'required',
                    'discount'        => 'required',
                    'quantity'        => 'required',
                ], [
                    'required'        => 'Không được bỏ trống',

                ]);
                $attribute = [
                    'product_id'      => $request->product_id,
                    'product_name'    => $request->product_name,
                    'thumbnail'       => $request->thumbnail,
                    'color_id'        => $request->color_id,
                    'category_id'     => $request->category_id,
                    'product_type'    => $request->product_type,
                    'sold'            => $request->sold,
                    'price'           => $request->price,
                    'rating'          => $request->rating,
                    'total_rating'    => $request->total_rating,
                    'status'          => $request->status,
                    'discount'        => $request->discount,
                    'quantity'        => $request->quantity,
                    'group_id'        => $request->group_id,

                ];
                // dd($attribute);
                $result = $this->productsRepository->create($attribute);
                return $attribute;
                break;
            case 'delete':
                $id                    = [];
                $col                   = [];
                $col[0]                = 'product_id';
                $id[0]                 = $request->product_id;
                $result = $this->productsRepository->deleteByCol($col, $id);
                return $result;
                break;
            case 'update':
                $request->validate([
                    'product_id'      => 'required',
                    'product_name'    => 'required',
                    'thumbnail'       => 'required',
                    'color_id'        => 'required',
                    'category_id'     => 'required',
                    'sold'            => 'required',
                    'price'           => 'required',
                    'rating'          => 'required',
                    'total_rating'    => 'required',
                    'status'          => 'required',
                    'discount'        => 'required',
                    'quantity'        => 'required',
                ], [
                    'required'        => 'Không được bỏ trống',

                ]);
                $attribute = [
                    'product_id'      => $request->product_id,
                    'product_name'    => $request->product_name,
                    'thumbnail'       => $request->thumbnail,
                    'color_id'        => $request->color_id,
                    'category_id'     => $request->category_id,
                    'product_type'    => $request->product_type,
                    'sold'            => $request->sold,
                    'price'           => $request->price,
                    'rating'          => $request->rating,
                    'total_rating'    => $request->total_rating,
                    'status'          => $request->status,
                    'discount'        => $request->discount,
                    'quantity'        => $request->quantity,
                    'group_id'        => $request->group_id,

                ];
                $col       = [];
                $id        = [];
                $col[0]    = 'product_id';
                $id[0]     = $request->product_id;
                $result = $this->productsRepository->edit($col, $id, $attribute);
                return $result;
                break;
        }
        return view('products', [
            'data' => $result
        ]);
    }
    public function getById(Request $result)
    {
        $att['page']    = 1;
        $att['limit']   = 1000;
        $id             = $result->route('id');
        $with           = ['color'];
        $att['where']   = $id;
        $att['math']    = '=';
        $att['col']     = 'product_id';
        
        $_att            = [];
        $_att['page']    = $result->get("page", 1);
        $_att['limit']   = $result->get("limit", 999999999999999);
        $products        = $this->productsRepository->listWhere($_att, $with, "_name_");
        if ($id == 'new') {
            return view('edit_products', [
                'data'     => ['data' => ['new']],
                "products" => $products
            ]);
        }

        $result = $this->productsRepository->listWhere($att, $with);

        return view('edit_products', [
            'data' => $result,
            "products" => $products
        ]);
    }
}
