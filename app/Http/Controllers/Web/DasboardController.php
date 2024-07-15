<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    protected $orderRepository;

    public function __construct(
        OrderRepository $orderRepository,
    ) {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        $order          = $this->getOrder($request);
        $customer       = $this->getCustomer($request);
        $doanhThu       = $this->layDoanhThu($request);
        $pendingOrder   = $this->pendingOrder($request);
        $beingOrder     = $this->beingOrder($request);

        return response()->json([
            'customer'      => $customer,
            'order'         => $order,
            'doanhThu'      => $doanhThu,
            'pendingOrder'  => $pendingOrder,
            'beingOrder'    => $beingOrder

        ], 200);
    }

    protected function pendingOrder(Request $request)
    {
        $result             = [];
        $att                = [];
        $col                = [];
        $id                 = [];
        $col[0]             = 'status';
        $att['getLength']   = true;
        $id[0]              = '1';
        $att['where']       = true;
        $att['page']        = $request->get("page", 1);
        $att['limit']       = $request->get("limit", 1000);
        $result             = $this->orderRepository->listWheres(
            $att,
            $col,
            $id
        );
        return $result;
    }
    protected function beingOrder(Request $request)
    {
        $result             = [];
        $att                = [];
        $col                = [];
        $id                 = [];
        $att['getLength']   = true;
        $col[0]             = 'status';
        $id[0]              = '2';
        $att['where']       = true;
        $att['page']        = $request->get("page", 1);
        $att['limit']       = $request->get("limit", 1000);
        $result             = $this->orderRepository->listWheres(
            $att,
            $col,
            $id
        );
        return $result;
    }
    protected function getOrder(Request $request)
    {
        $month              = date('m');
        $result             = [];
        $year               = date('Y');
        $att                = [];
        $col                = [];
        $id                 = [];
        $col[0]             = 'status';
        $id[0]              = '3';
        $att['where']       = true;
        $att['getLength']   = true;
        $att['year']        = $year;
        $att['page']        = $request->get("page", 1);
        $att['limit']       = $request->get("limit", 1000);
        $totalOrder         = 0;
        for ($i = 0; $i < 12; $i++) {
            $att['month']   = $i + 1;
            array_push($result, $this->orderRepository->listWheres(
                $att,
                $col,
                $id
            ));
            $totalOrder += $result[$i];
        }
        return [
            'dataOrder'  => $result,
            'totalOrder' => $totalOrder
        ];
    }

    protected function getCustomer(Request $request)
    {
        $month              = date('m');
        $result             = [];
        $year               = date('Y');
        $att                = [];
        $col                = [];
        $id                 = [];
        $col[0]             = 'status';
        $id[0]              = '3';
        $att['where']       = true;
        $att['groupBy']     = 'customer_id';
        $att['getLength']   = true;
        $att['year']        = $year;
        $att['page']        = $request->get("page", 1);
        $att['limit']       = $request->get("limit", 1000);
        $totalOrder         = 0;
        for ($i = 0; $i < 12; $i++) {
            $att['month']   = $i + 1;
            array_push($result, $this->orderRepository->listWheres(
                $att,
                $col,
                $id
            ));
            $totalOrder += (int)$result[$i];
        }

        unset($att['month']);
        $att['getLength']   = false;
        $totalOrder =  $this->orderRepository->listWheres(
            [
                "where"             => true,
                "groupBy"           => "customer_id",
                "year"              => $year,
                "page"              => 1,
                "limit"             => 9999999,
                "getTotalCustomer"  => true
            ],
            $col,
            $id
        );
        return [
            'dataCustomer'  => $result,
            'totalCustomer' => $totalOrder
        ];
    }
    protected function layDoanhThu(Request $request)
    {
        $month              = date('m');
        $result             = [];
        $year               = date('Y');
        $att                = [];
        $col                = [];
        $id                 = [];
        $col[0]             = 'status';
        $id[0]              = '3';
        $att['where']       = true;
        $att['getDoanhThu'] = true;
        $att['year']        = $year;
        $att['page']        = $request->get("page", 1);
        $att['limit']       = $request->get("limit", 1000);
        $total              = 0;
        for ($i = 0; $i < 12; $i++) {
            $att['month']   = $i + 1;
            array_push($result, $this->orderRepository->listWheres(
                $att,
                $col,
                $id
            ));
            $total += (int)$result[$i];
        }
        return [
            'data'  => $result,
            'total' => $total
        ];
    }
}
