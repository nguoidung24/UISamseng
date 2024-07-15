<?php

namespace App\Service;

use App\Models\Customers;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerService
{

    public function login($phone, $password)
    {
        $data = [];
        $customer = Customers::where('phone', '=', $phone)->where('password', '=', $password)->first();
        if ($customer) {

            return [
                'ssid'          => $customer->customer_id,
                'customer_name' => $customer->customer_name,
                'phone'         => $customer->phone,
                'address'       => $customer->address,
            ];
        }
        return $customer;
    }
    public function register($att)
    {
        // try {
            return Customers::create($att);
        // } catch (\Exception $e) {
            // return false;
        // }
    }
    public function updated($id, $att)
    {
        foreach ($att as $key => $val) {
            if (!$val) {
                unset($att[$key]);
            }
        }
        try {
            return Customers::where('customer_id', '=', $id)->update($att);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function uploadImage($image, $id){

       
        // $file


        return true;
    }
}
