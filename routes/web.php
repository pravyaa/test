<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Models\ProductModel;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});




Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
     // $users = User::All();
    $users = DB::table('users')->get();
    return view('/admin/dashboard',compact('users'));
 
})->name('admin.dashboard');

Route::group(['prefix'=> 'admin', 'middleware'=>['auth:sanctum,admin', 'verified']], function(){
Route::get('product/all',[ProductController::class,'productAll'])->name('product.all');
Route::post('product/add',[ProductController::class,'saveproduct'])->name('product.add');
Route::get('product/edit/{id}',[ProductController::class,'editproduct']);
Route::post('product/update/{id}',[ProductController::class,'updateproduct']);
Route::get('product/delete/{id}',[ProductController::class,'deleteproduct']);
});



Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $products = ProductModel::latest()->paginate(10);
    return view('dashboard',compact('products'));
})->name('dashboard');
