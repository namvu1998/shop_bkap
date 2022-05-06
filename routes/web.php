<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

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
//Trang người dùng
Route::get('/', [IndexController::class,'index'])->name('home');

//Shop
Route::get('/shop', [ShopController::class,'index'])->name('shop');

//Chi tiết san phẩm
Route::get('/productDetail', [ShopController::class,'ProductDetail'])->name('productDetail');

//Đăng nhập, Đăng ký
Route::get('/signin',[AuthController::class,'index'])->name('signin');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login-user',[AuthController::class,'loginUser'])->name('loginUser');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

//Trang Admin
Route::prefix('admin')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('admin.index');

    Route::prefix('category')->group(function()
    {
        Route::get('/',[CategoryController::class,'index'])->name('admin.category.index');
        Route::get('/create',[CategoryController::class,'create'])->name('admin.category.create');
        Route::post('/create',[CategoryController::class,'store']);
        Route::get('/update/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
        Route::post('/update/{id}',[CategoryController::class,'update']);
        Route::get('/{id}',[CategoryController::class,'delete'])->name('admin.category.delete');
        Route::get('/active/{cate_id}',[CategoryController::class, 'active'])->name('cate.active');
        Route::get('/unacive/{cate_id}',[CategoryController::class, 'unactive'])->name('cate.unactive');
    });

    Route::prefix('attribute_value')->group(function()
    {
        Route::get('/',[AttributeValueController::class,'index'])->name('admin.attributeValue.index');
        Route::get('/create/{id?}',[AttributeValueController::class,'create'])->name('admin.attributeValue.create');
        Route::post('/create/{id?}',[AttributeValueController::class,'store'])->name('admin.attributeValue.store');
        Route::get('/update/{id}',[AttributeValueController::class, 'edit'])->name('admin.attributeValue.edit');
        Route::post('/update/{id}',[AttributeValueController::class, 'update']);
        Route::get('/{id}',[AttributeValueController::class, 'delete'])->name('admin.attributeValue.delete');
    });

    Route::prefix('attribute')->group(function()
    {
        Route::get('/',[AttributeController::class,'index'])->name('admin.attribute.index');
        Route::get('/create',[AttributeController::class,'create'])->name('admin.attribute.create');
        Route::post('/create',[AttributeController::class,'store']);
        Route::get('/update/{id}',[AttributeController::class, 'edit'])->name('admin.attribute.edit');
        Route::post('/update/{id}',[AttributeController::class, 'update']);
        Route::get('/{id}',[AttributeController::class, 'delete'])->name('admin.attribute.delete');
    });

    Route::prefix('product')->group(function()
    {
        Route::get('/',[ProductController::class,'index'])->name('admin.product.index');
        Route::get('/create',[ProductController::class,'create'])->name('admin.product.create');
        Route::post('/create',[ProductController::class,'store']);
        Route::get('/update/{id}',[ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/update/{id}',[ProductController::class, 'update']);
        Route::get('/{id}',[ProductController::class, 'delete'])->name('admin.product.delete');
        Route::get('/active/{product_id}',[ProductController::class, 'active'])->name('product.active');
        Route::get('/unacive/{product_id}',[ProductController::class, 'unactive'])->name('product.unactive');
        
        Route::prefix('detail')->group(function()
        {
        Route::get('/list/{id}',[ProductController::class, 'detail'])->name('admin.product.detail');
            Route::get('/create/{id}',[ProductController::class, 'createDetail'])->name('admin.product.createDetail');
            Route::post('/create/{id}',[ProductController::class, 'storeDetail']);

        });
    });
});