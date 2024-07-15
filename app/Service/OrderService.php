<?php

namespace App\Service;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderService
{
    protected $orderRepository;

    public function __construct(
        OrderRepository $orderRepository,
    ) {
        $this->orderRepository = $orderRepository;
    }
    public function index(Request $request)
    {
        $config = [
            "appid" => 553,
            "key1" => "9phuAOYhan4urywHTh0ndEXiV3pKHr5Q",
            "key2" => "Iyz2habzyr7AG8SgvoBCbKwKi3UzlLi3",
            "endpoint" => "https://sandbox.zalopay.com.vn/v001/tpe/createorder"
        ];
        $embeddata = [
            "merchantinfo" => "embeddata123"
        ];
        $items = [
            ["itemid" => "knb", "itemname" => "kim nguyen bao", "itemprice" => 198400, "itemquantity" => 1]
        ];
        $order = [
            "appid"         => $config["appid"],
            "apptime"       => round(microtime(true) * 1000), // miliseconds
            "apptransid"    => date("ymd") . "_" . uniqid(), // mã giao dich có định dạng yyMMdd_xxxx
            "appuser"       => "demo",
            "item"          => json_encode($items, JSON_UNESCAPED_UNICODE),
            "embeddata"     => json_encode($embeddata, JSON_UNESCAPED_UNICODE),
            "amount"        => 100000,
            // "phone"         => "0934568239",
            "description"   => "thegioidilac.shop/muadienthoai",
            "bankcode"      => "zalopayapp"
        ];

        // appid|apptransid|appuser|amount|apptime|embeddata|item
        $data = $order["appid"] . "|" . $order["apptransid"] . "|" . $order["appuser"] . "|" . $order["amount"]
            . "|" . $order["apptime"] . "|" . $order["embeddata"] . "|" . $order["item"];
        $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);
        $context = stream_context_create([
            "http" => [
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($order)
            ]
        ]);

        $resp = file_get_contents($config["endpoint"], false, $context);
        $result = json_decode($resp, true);
        return json_encode($result);
    }

    public function cancel(Request $request)
    {
        $ids = explode(',', $request->get('ids'));
        foreach ($ids as $key => $value) {
            Order::where('order_id', '=', $value)->update([
                'status' => -1,
                'note'   => "Khách hàng hủy đơn!"
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
    }

    // { id: -1, value: 'Đơn bị hủy' },
    // 		{ id: 2, value: 'Đang Giao' },
    // 		{ id: 1, value: 'Chờ Duyệt' },
    // 		{ id: 3, value: 'Đã Giao' },
    // 		{ id: 4, value: 'Thất Bại' },
}
