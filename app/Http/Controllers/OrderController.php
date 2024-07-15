<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(
        OrderRepository $orderRepository,
    ) {
        $this->orderRepository = $orderRepository;
    }
    public function index(Request $request)
    {
        $action         = $request->get("action", "");
        $result         = ["Not Action" => $action];
        $att            = [];

        $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
        $datetime = new DateTime('now', $timezone);
        $currentDateTime = $datetime->format('Y-m-d H:i:s');

        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 1000);

        if ($action == "getAll") {
            $result = $this->orderRepository->listWhere($att);
            return response()->json($result, 200);
        }
        if ($action == "getCart") {
            $att['col']       = 'customer_id';
            $att['math']      = '=';
            $att['where']     = $request->get('customer_id', '');
            $att['getCart']   = true;
            $totalAmount      = 0;
            $with             = ['product'];
            $result = $this->orderRepository->listWhere($att, $with);

            foreach ($result['data'] as $item) {
                $totalAmount += ((int)$item->price * $item->quantity);
            }
            return response()->json([
                "cart"        => $result,
                "totalAmount" => $totalAmount
            ], 200);
        }
        if ($action == "create" || $action == '-quantity') {

            $action == "create"
                ? $math            = '+' . $request->quantity
                : $math            = "-1";
            $att['customer_id']    = $request->customer_id;
            $att['product_id']     = $request->product_id;
            $att['order_date']     = null;
            $att['order_id']       = null;
            $att['price']          = $request->price;
            $att['quantity']       = $request->quantity;
            $att['status']         = $request->status;
            $att['payment_date']   = $request->payment_date;

            $updateWhere = [
                "customer_id" =>  $request->customer_id,
                "product_id"  =>  $request->product_id,
                "status"      =>  $request->status
            ];
            $colUpdate = 'quantity';
            $result = $this->orderRepository->createOrUpdate(
                $att,
                $math,
                $updateWhere,
                $colUpdate
            );
            return response()->json($result, 200);
        }
        if ($action == "delete") {
            $id                    = [];
            $col                   = [];
            $col[0]                = 'status';
            $col[1]                = 'customer_id';
            $col[2]                = 'product_id';
            $id[0]                 = $request->sid;
            $id[1]                 = $request->cid;
            $id[2]                 = $request->pid;

            $result   = $this->orderRepository->deleteByCol($col, $id);
            return response()->json($result, 200);
        }
        if ($action == "edit") {
            // payMethod == 0 ? Thanh Toán Online
            // payMethod == 1 ? Thanh Toán Khi Nhận Hàng
            $payMethod = $request->get("payMethod", -1);
            $order_ids     = $request->order_ids;
            $ids           = explode(",", $order_ids);
            $updateData    = [];
            if (isset($request->updateStatus)) {
                $updateData['status'] = $request->updateStatus;
                if ((int)($request->updateStatus) == 1) {
                    $updateData['order_date'] = $currentDateTime;
                }
            }
            

            if (isset($request->updateLocal))
                $updateData['local'] = $request->updateLocal;


            if ($payMethod . "_" == '1' . "_") {
                $updateData['pay_method'] = "Thanh Toán Khi Nhận Hàng";
            }
            if ($payMethod . "_" == '0' . "_") {
                $updateData['pay_method'] = "Thanh Toán Online";
                if (isset($request->payment_date))
                $updateData['payment_date'] = $request->payment_date;
                // dd($request);
            }
            $result = $this->orderRepository->updateWhereIds($ids, $updateData);
            return response()->json($result, 200);
        }
        if ($action == "updatePayment") {

            return response()->json(["erros" => "...."], 200);
        }
        return response()->json($result, 402);
    }
}
