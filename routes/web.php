<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryCpntroller;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UnitController;
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

// back end route
Route::get('/admins', [AdminController::class, 'index'])->name('admin.loging');
Route::get('/admin/home', [SuperAdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [SuperAdminController::class, 'logout'])->name('logout');
Route::post('/admin/dashboard', [AdminController::class, 'showDashboard']);
// caTEGORY
Route::resource('/categories', CategoryCpntroller::class);
Route::get('/category-deactive/{id}',[CategoryCpntroller::class, 'deactive'])->name('category.deactive');
Route::get('/category-active/{id}',[CategoryCpntroller::class, 'active'])->name('category.active');
// sub category
Route::resource('subcategory', SubCategoryController::class);
Route::get('/subcategory-deactive/{id}',[SubCategoryController::class, 'deactive'])->name('subcategory.deactive');
Route::get('/subcategory-active/{id}',[SubCategoryController::class, 'active'])->name('subcategory.active');
// brads
Route::resource('brand', BrandController::class);
Route::get('/brand-deactive/{id}',[BrandController::class, 'deactive'])->name('brand.deactive');
Route::get('/brand-active/{id}',[BrandController::class, 'active'])->name('brand.active');
// Units
Route::resource('units', UnitController::class);
Route::get('/units-deactive/{id}',[UnitController::class, 'deactive'])->name('units.deactive');
Route::get('/units-active/{id}',[UnitController::class, 'active'])->name('units.active');
// Size 
Route::resource('sizes', SizeController::class);
Route::get('/sizes-deactive/{id}',[SizeController::class, 'deactive'])->name('sizes.deactive');
Route::get('/sizes-active/{id}',[SizeController::class, 'active'])->name('sizes.active');
// solor
Route::resource('colors', ColorController::class);
Route::get('/colors-deactive/{id}',[ColorController::class, 'deactive'])->name('colors.deactive');
Route::get('/colors-active/{id}',[ColorController::class, 'active'])->name('colors.active');
// product
Route::resource('products', ProductController::class);
Route::get('/products-deactive/{id}',[ProductController::class, 'deactive'])->name('products.deactive');
Route::get('/products-active/{id}',[ProductController::class, 'active'])->name('products.active');
// route for front end
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/product-page/{id}', [HomeController::class, 'singlepage'])->name('singlepage');
Route::get('/product/by/category/{id}', [HomeController::class, 'categorywiseProduct'])->name('product.by-category');
Route::get('/product/by/subcategory/{id}', [HomeController::class, 'subcategorywiseProduct'])->name('product.by-subcategory');
Route::get('/product/by/brand/{id}', [HomeController::class, 'brandwiseProduct'])->name('product.by-brand');
Route::post('/add/to/cart', [CartController::class, 'AddToCart'])->name('add-to-cart');
Route::get('cart/delete/{id}', [CartController::class, 'delete']);
// checkout
Route::get('check/out', [CheckController::class, 'index'])->name('checkout');
// login check 
Route::get('login/check/', [CheckController::class, 'UserLoginCheck'])->name('user.login.check');
// customer login reg logout
Route::post('/user/login/', [CustomerController::class, 'UserLogin'])->name('user.login');
Route::post('/user/registration/', [CustomerController::class, 'UserRegistration'])->name('user.registration');
Route::post('/user/logout/', [CustomerController::class, 'logout'])->name('user.logout');