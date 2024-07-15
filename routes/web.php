<?php

use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\dang_giaoController;
use App\Http\Controllers\Web\DasboardController;
use App\Http\Controllers\Web\duyet_donController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Web\TrainDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/test', fn () => view('test'));

// ================================================ START ================================================

Route::get('/', fn () => view('home'))->middleware("myauth");
Route::get('/word-page', fn () => view('word_page'));

Route::get('/test-word', fn () => view('testWord'));

Route::get('/train', [TrainDataController::class, 'index'])->middleware("myauth");

Route::any("/login", [LoginController::class, 'index'])->name("login");


Route::middleware('myauth')->group(function () {
// ================================================ DUYỆT ĐƠN ================================================

Route::get('/duyet-don',          [duyet_donController::class, 'index'])->name("duyetDon");
Route::get('/duyet-don/delete',   [duyet_donController::class, 'deleteOrder']);
Route::get('/duyet-don/cancel',   [duyet_donController::class, 'cancelOrder']);
Route::get('/duyet-don/accept',   [duyet_donController::class, 'acceptOrder']);


// ================================================ GIAO HÀNG ================================================

Route::get('/dang-giao',          [dang_giaoController::class, 'index'])->name("dangGiao");
Route::get('/dang-giao/success',  [dang_giaoController::class, 'successOrder']);
Route::get('/dang-giao/fail',     [dang_giaoController::class, 'failOrder']);


// ================================================ DANH MỤC ================================================


Route::get('/categorys',          [CategoryController::class, 'index'])->name("categorys");
Route::get('/categorys/create',   [CategoryController::class, 'createCategory']);
Route::get('/categorys/edit',     [CategoryController::class, 'editCategory']);
Route::get('/categorys/delete',   [CategoryController::class, 'deleteCategory']);

// ================================================ PRODUCTS ================================================

Route::get('/products',           [ProductsController::class, 'getAll']);
Route::post('/products',          [ProductsController::class, 'getAll']);
Route::get('/edit_products/{id}', [ProductsController::class, 'getById']);
Route::get('/dasboard',           [DasboardController::class, 'index']);

// ================================================ MENU ================================================

Route::any('/menus',              [MenuController::class, 'index'])->name("menus");
Route::any('/menus/create',       [MenuController::class, 'menuCreate'])->name("menus-create");
Route::any('/menus/delete',       [MenuController::class, 'menuDelete'])->name("menus-delete");

});

// ================================================ END ================================================