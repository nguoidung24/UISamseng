<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $post_id = $request->get('post_id');
        $data = Posts::where('post_id','=', $post_id)->get()[0];
        return $data;
    }
}
