<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class dang_giaoController extends Controller
{
    protected $orderRepository;
    protected $productRepository;


    public function __construct(
        OrderRepository $orderRepository,
        ProductRepository $productRepository,

    ) {
        $this->orderRepository    = $orderRepository;
        $this->productRepository  = $productRepository;
    }

    public function index(Request $request)
    {
        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 9999999999999999);
        $att['col']     = "status";
        $att['math']    = "=";
        $att['where']   =  "2";
        $res            = $this->orderRepository->listWhere($att, ['product']);
        $data = [
            "data"    => $res,
        ];

        return view('dang_giao', $data);
    }
    public function successOrder(Request $request)
    {
        $order_id      =  $request->get('order_id', null);
        $quantity      =  $request->get('quantity', null);
        $product_id    =  $request->get('product_id', null);
        $payment_date  =  $request->get('payment_date', null);

        if($payment_date){
            $res = $this->orderRepository->updateWhereIds([$order_id], ['status' => "3"]);
        }else{
            $res = $this->orderRepository->updateWhereIds([$order_id], ['status' => "3", "payment_date" => date("Y-m-d")]);
        }
        $data = [
            "data" => $res
        ];
        if ($data['data'] == 1) {
            $p    =  $this->productRepository->findById($product_id);
            $res  = $this->productRepository->updateWhereIds([$product_id], ['sold' => (int)$p['sold'] + (int)$quantity], "product_id");
            $data = [
                "data" => $res
            ];
            if ($data['data'] == 1) {
                return redirect()->route('dangGiao')->with('success', 'Giao thành công!');
            }
        }
        return redirect()->route('dangGiao')->with('fail', 'Chuyển trạng thái không thành công!');
    }
    public function failOrder(Request $request)
    {
        $order_id  =  $request->get('order_id', null);
        $res = $this->orderRepository->updateWhereIds([$order_id], ['status' => "4"]);
        $data = [
            "data" => $res
        ];
        if ($data['data'] == 1)
            return redirect()->route('dangGiao')->with('success', 'Chuyển thành "Giao không thành công!"');
        return redirect()->route('dangGiao')->with('fail', 'Chuyển trạng thái không thành công!');
    }
}
