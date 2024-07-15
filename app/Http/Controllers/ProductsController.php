<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        $att            = [];
        $action         = $request->get("action", "");
        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 1000);

        switch ($action) {
            case 'updateStar':
                $product_id = $request->product_id;
                $star       = $request->star;
                $order_id       = $request->order_id;
                $result     = $this->productsRepository->changeStar(
                    $product_id,
                    (int)$star,
                    $order_id
                );
                return response()->json($result, 200);
                break;
                // add with -------------------
            case 'getAll':
                $with           = ["color"];
                $result = $this->productsRepository->listWhere($att, $with);
                return response()->json($result, 200);
                break;

            case 'getHot':
                $att['col']     = 'product_type';
                $att['math']    = '=';
                $att['where']   = 'Hot';
                $with           = ["color"];
                $result = $this->productsRepository->getProductType(
                    "Hot",
                    $att,
                    $with,
                );
                return response()->json($result, 200);
                break;
            case 'getProductType':
                $with           = ["color"];
                $type           =  $request->type ?: '';
                $result = $this->productsRepository->getProductType(
                    $type,
                    $att,
                    $with,
                );
                return response()->json($result, 200);
                break;

            case 'getDiscount':
                $att['col']     = 'product_type';
                $att['math']    = '=';
                $att['where']   = 'Discount';
                $with           = ["color"];
                $result = $this->productsRepository->getProductType(
                    "Discount",
                    $att,
                    $with,
                );
                return response()->json($result, 200);
                break;
            case 'changeImages':
                $id     = $request->id;
                $value  = $request->value;
                $result = $this->productsRepository->changeImages(
                    $id,
                    $value
                );
                return response()->json($result, 200);
                break;
            case 'listProducts':
                $page         = $request->get('page', 1);
                $limit        = $request->get('limit', 10);
                $keywords     = $request->get('keywords', null);
                $color_id     = $request->get('color_id', null);
                $group_id     = $request->get('group_id', null);
                $category_id  = $request->get('category_id', null);
                $rating       = $request->get('rating', null);
                $sort         = $request->get('sort', null);
                $range        = $request->get('range', null);

             

                $result = $this->productsRepository->listProducts([
                    'page'      => $page,
                    'limit'     => $limit,
                    'keywords'  => $keywords,
                    'sort'      => $sort,
                    'range'     => $range,
                    'where'     => [
                        "group_id"      => $group_id,
                        'color_id'      => $color_id,
                        'category_id'   => $category_id,
                        'rating'        => $rating,
                    ]
                ]);
                return response()->json([
                    'totalPage'     => $result->lastPage(),
                    'total'         => $result->total(),
                    'page'          => $result->currentPage(),
                    'nextPage'      => $result->nextPageUrl(),
                    'prePage'       => $result->previousPageUrl(),
                    'data'          => $result->items(),
                ], 200);
                break;
            case 'getById':
                $att['col']     = 'product_id';
                $att['math']    = '=';
                $att['where']   = $request->id;
                $with           = ["color"];
                $result = $this->productsRepository->listWhere(
                    $att,
                    $with
                );
                return response()->json($result, 200);
                break;
            case 'getByGroupId':
                $groupId   = $request->groupId ?: "0";
                $with           = ["color",'category'];
                
                $result = $this->productsRepository->getByGroupId(
                    $groupId,
                    $att,
                    $with
                );
                return response()->json($result, 200);
                break;
            case 'getByName' || 'getByCategory':
                $action == 'getByName'
                    ? $att['col']      = 'product_name'
                    : $att['col']      = 'category_id';
                $action == 'getByName'
                    ? $att['where']    = '%' . $request->name . '%'
                    : $att['where']    = '%' . $request->cid . '%';
                $att['math']           = 'like';
                $att['range']          = $request->get('range', "");
                $att['color']          = $request->get('color', "");
                $att['star']           = $request->get('star', "");
                $orderBy               = $request->get('orderBy', "");
                $with                  = ["color"];
                $result = $this->productsRepository->listWhere(
                    $att,
                    $with,
                    $orderBy
                );
                return response()->json($result, 200);
                break;
            default:
                $result = ["Not Action" => $action];
                return response()->json([], 402);
                break;
        }
        return response([]);
    }
}
