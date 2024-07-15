<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function index(Request $request)
    {
        $file = $request->file('image');
        if (isset($request->images_detail)) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/images_detail'), $fileName);
            return response()->json('image/images_detail/'.$fileName, 200);
        }
        if (isset($request->product)) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/product'), $fileName);
            return response()->json('image/product/'.$fileName, 200);
        }
        if (isset($request->category)) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image/category'), $fileName);
            return response()->json('image/category/'.$fileName, 200);
        }
        return false;
    }
}
