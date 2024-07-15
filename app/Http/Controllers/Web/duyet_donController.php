<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class duyet_donController extends Controller
{
    protected $orderRepository;

    public function __construct(
        OrderRepository $orderRepository,
    ) {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 9999999999999999);
        $att['col']     = "status";
        $att['math']    = "=";
        $att['where']   =  "1";
        $res            = $this->orderRepository->listWhere($att, ['product']);
        $data = [
            "data"    => $res,
        ];

        return view('duyet_don', $data);
    }
    public function deleteOrder(Request $request)
    {
        $id   =  $request->get('id', 0);
        $res  = $this->orderRepository->deleteByCol(['order_id'], [$id]);
        $data = [
            "data" => $res
        ];
        if ($data['data'])
            return redirect()->route('duyetDon')->with('success', 'Xóa thành công');
        return redirect()->route('duyetDon')->with('fail', 'Xóa không thành công');
    }

    public function cancelOrder(Request $request)
    {
        $note      = $request->get('note', null);
        $order_id  =  $request->get('order_id', null);
        $res = $this->orderRepository->updateWhereIds([$order_id], ['status' => "-1", 'note' => $note]);
        $data = [
            "data" => $res
        ];
        if ($data['data'] == 1)
            return redirect()->route('duyetDon')->with('success', 'Đã hủy đơn!');
        return redirect()->route('duyetDon')->with('fail', 'Hủy đơn không thành công');
    }
    public function acceptOrder(Request $request)
    {
        $order_id  =  $request->get('order_id', null);
        $res = $this->orderRepository->updateWhereIds([$order_id], ['status' => "2"]);
        $data = [
            "data" => $res
        ];
        if ($data['data'] == 1)
            return redirect()->route('duyetDon')->with('success', 'Đã duyệt đơn!');
        return redirect()->route('duyetDon')->with('fail', 'Duyệt đơn không thành công');
    }
}
