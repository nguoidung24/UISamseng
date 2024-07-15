<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ForgetSessionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OutstrandingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Web\UploadFileController;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post(
    "/Menu",
    [MenuController::class, "index",]
);
Route::post(
    "/Category",
    [CategoryController::class, "index",]
);
Route::post(
    "/Products",
    [ProductsController::class, "index",]
);
Route::post(
    "/Order",
    [OrderController::class, "index",]
);
Route::post(
    "/Color",
    [ColorController::class, "index",]
);
Route::post(
    "/Customers",
    [CustomersController::class, "index",]
);




Route::post(
    "/upload",
    [UploadFileController::class, "index",]
);
Route::get(
    "/ForgetSession",
    [ForgetSessionController::class, "index",]
);

Route::get(
    "/zalopay",
    [OrderService::class, "index",]
);


Route::get(
    "/Outstanding",
    [OutstrandingController::class, "index",]
);


Route::get(
    "/Banner",
    [BannerController::class, "index",]
);


Route::get(
    "/Post",
    [PostController::class, "index",]
);


Route::post(
    "/customer-login",
    [CustomersController::class, "login",]
);

Route::post(
    "/customer-register",
    [CustomersController::class, "register",]
);

Route::post(
    "/customer-updated",
    [CustomersController::class, "updated",]
);


Route::post(
    "/contact",
    [ContactController::class, "create",]
);


Route::post(
    "/order-cancel",
    [OrderService::class, "cancel",]
);

Route::post(
    "/customers-info",
    [CustomersController::class, "getInfo",]
);