<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request['isLogout'])) {
            Session::forget('adminID');
            Session::forget('isLogin');
        }

       
        if (isset($request['isLogin'])) {

            $phone    = $request->get("phone", "");
            $password = $request->get("password", "");

            $checkLogin = User::query();
            $checkLogin->where(['phone' => $phone, 'password' => $password]);
            $result = count($checkLogin->get());
            if ($result > 0) {
                Session::put('adminID', $checkLogin->get()[0]['id']);
                Session::put('isLogin', true);
                return redirect("/");
            }
        }

        if (Session::get('isLogin')) {
            return redirect("/");
        }
      
        return view('login');
    }
}
