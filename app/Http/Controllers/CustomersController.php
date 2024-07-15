<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Repositories\CustomersRepository;
use App\Repositories\OrderRepository;
use App\Service\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomersController extends Controller
{
    protected $customersRepository;
    protected $orderRepository;
    protected $customerService;


    public function __construct(
        CustomersRepository $customersRepository,
        OrderRepository $orderRepository,
        CustomerService $customerService

    ) {
        $this->customersRepository = $customersRepository;
        $this->orderRepository = $orderRepository;
        $this->customerService = $customerService;
    }
    public function index(Request $request)
    {
        $action         = $request->get("action", "");
        $result         = ["Not Action" => $action];
        $att            = [];

        $att['page']    = $request->get("page", 1);
        $att['limit']   = $request->get("limit", 1000);

        if ($action == "getInfo") {
            $att['where'] = $request->customer_id;
            $att['math']  = '=';
            $att['col']   = 'customer_id';
            $result = $this->customersRepository->listWhere(
                $att,
            );
            return response()->json($result, 200);
        }
        if ($action == "getOrder") {
            $att['where'] = $request->customer_id;
            $att['math']  = '=';
            $att['col']   = 'customer_id';
            $with         = ['product'];

            $result = $this->orderRepository->listWhere(
                $att,
                $with
            );
            return response()->json($result, 200);
        }
        return response()->json($result, 402);
    }

    public function login(Request $request)
    {
        $phone     = $request->get('phone');
        $password  = $request->get('password');
        $response  = $this->customerService->login($phone, $password);
        if ($response) {
            return response()->json(['success' => true, 'message' => 'Login successful', ...$response], 200);
        }
        return response()->json(['success' => false, 'message' => 'Login fail'], 200);
    }

    public function register(Request $request)
    {
        $att                   = [];
        $att['phone']          = $request->get('phone');
        $att['password']       = $request->get('password');
        $att['customer_name']  = '#' . $request->get('phone');
        $att['customer_id']    = $this->generateIdByDateTimeWithRandom();

        $response  = $this->customerService->register($att);
        if ($response) {
            return response()->json(['success' => true, 'message' => 'Register successful'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Register fail'], 200);
    }


    public function updated(Request $request)
    {
        $att                   = [];
        $id                    = $request->get('id', null);
        $att['phone']          = $request->get('phone', null);
        $att['password']       = $request->get('password', null);
        $att['address']        = $request->get('address', null);
        $att['customer_name']  = $request->get('customer_name', null);

        $response  = $this->customerService->updated($id, $att);
        if ($response) {
            return response()->json(['success' => true, 'message' => 'Updated successful'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Updated fail'], 200);
    }

    public function getInfo(Request $request)
    {
        $customer_id = $request->get('id', null);
        $response =  Customers::where('customer_id', '=', $customer_id)->first();
        unset($response['password']);
        return response()->json($response, 200);
    }


    function generateIdByDateTimeWithRandom()
    {
        // Lấy ngày, tháng, năm, giờ, phút, giây hiện tại
        $day = date('d'); // Ngày
        $month = date('m'); // Tháng
        $year = date('Y'); // Năm
        $hour = date('H'); // Giờ
        $minute = date('i'); // Phút
        $second = date('s'); // Giây

        // Tạo một số ngẫu nhiên từ 1 đến 9999
        $randomNumber = rand(1, 9999);

        // Kết hợp lại thành ID
        $id = $year . $month . $day . $hour . $minute . $second . $randomNumber;

        return $id;
    }



    // $att                   = [];
    // $att['avater']         = $request->get('avater');
    // $att['address']        = $request->get('address');
    // $att['phone']          = $request->get('phone');
    // $att['password']       = $request->get('password');
}
