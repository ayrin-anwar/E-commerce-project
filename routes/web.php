<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CheckoutController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {

//   return view('frontend.main', [
//       "go" => "go",
//   ]);
// });
Route::get('/dashboard', function () {
   return view('dashboard');
 })->middleware(['auth'])->name('dashboard');
 Route::get('/dashboard', function () {
  return view('customerdashboard');
})->middleware(['auth'])->name('customerdashboard');

 require __DIR__.'/auth.php';
Route::get('contact',[FrontendController::class,'contact']);
Route::get('contact','FrontendController@contact');
Route::get('/',[FrontendController::class,'frontend'])->name('frontend');
Route::get('/productDetails/{slug}',[FrontendController::class,'productDetails'])->name('productDetails');
Route::get('/carts',[CartController::class,'Cart'])->name('Cart');
Route::get('/carts/{coupon_name}',[CartController::class,'Cart']);
Route::post('/cartpost',[CartController::class,'CartPost'])->name('CartPost');

Route::get('/get/color/size/{c_id}/{p_id}',[FrontendController::class,'GetColorSize'])->name('GetColorSize');
Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::get('categories',[CategoryController::class,'categories'])->name('categories');

Route::get('add-category',[CategoryController::class,'addcategory'])->name('addcategory');
Route::get('delete-category/{bilai}',[CategoryController::class,'deletecategory'])->name('deletecategory');
Route::post('post-category',[CategoryController::class,'postcategory'])->name('postcategory');
Route::post('update-category',[CategoryController::class,'updatecategory'])->name('updatecategory');
Route::get('edit-category/{bilai}',[CategoryController::class,'editcategory'])->name('editcategory');
Route::get('trashed-category',[CategoryController::class,'trashcategory'])->name('trashcategory');
Route::get('restore-category/{bilai}',[CategoryController::class,'restorecategory'])->name('restorecategory');
Route::get('permanentdelete-category/{bilai}',[CategoryController::class,'permanentdeletecategory'])->name('permanentdeletecategory');

Route::get('add-subcategory',[SubCategoryController::class,'addcategory'])->name('addcategory');
Route::post('post-subcategory',[SubCategoryController::class,'postsubcategory'])->name('postsubcategory');
Route::get('subcategories',[SubCategoryController::class,'subcategories'])->name('subcategories');
Route::post('all-subcategory-delete',[SubCategoryController::class,'allsubcategorydelete'])->name('allsubcategorydelete');
Route::get('delete-subcategory/{id}',[SubCategoryController::class,'deletesubcategory'])->name('deletesubcategory');
Route::get('trashed-subcategory',[SubCategoryController::class,'trashsubcategory'])->name('trashsubcategory');
Route::get('restore-subcategory/{bilai}',[SubCategoryController::class,'restoresubcategory'])->name('restoresubcategory');
Route::get('permanentdelete-subcategory/{bilai}',[SubCategoryController::class,'permanentdeletesubcategory'])->name('permanentdeletesubcategory');








Route::get('add-product',[ProductController::class,'addproduct'])->name('addproduct')->middleware(['auth']);
Route::post('post-product',[ProductController::class,'postproduct'])->name('postproduct');
Route::get('products',[ProductController::class,'products'])->name('products');
Route::post('update-product',[ProductController::class,'updateproduct'])->name('updateproduct');
Route::get('edit-product/{bilai}',[ProductController::class,'editproduct'])->name('editproduct');
Route::get('trashed-product',[ProductController::class,'trashproduct'])->name('trashproduct');
Route::get('restore-product/{bilai}',[ProductController::class,'restoreproduct'])->name('restoreproduct');
Route::get('permanentdelete-product/{bilai}',[ProductController::class,'permanentdeleteproduct'])->name('permanentdeleteproduct');
Route::get('delete-product/{bilai}',[ProductController::class,'deleteproduct'])->name('deleteproduct');



Route::get('add-color',[ColorController::class,'addcolor'])->name('addcolor');
Route::post('post-color',[ColorController::class,'postcolor'])->name('postcolor');
Route::get('colors',[ColorController::class,'colors'])->name('colors');


Route::get('add-size',[SizeController::class,'addsize'])->name('addsize');
Route::post('post-size',[SizeController::class,'postsize'])->name('postsize');
Route::get('sizes',[SizeController::class,'sizes'])->name('sizes');

Route::get('add-coupon',[CouponController::class,'addcoupon'])->name('addcoupon');
Route::post('post-coupon',[CouponController::class,'postcoupon'])->name('postcoupon');
Route::get('coupons',[CouponController::class,'coupons'])->name('coupons');
Route::post('update-coupon',[CouponController::class,'updatecoupon'])->name('updatecoupon');
Route::get('edit-coupon/{bilai}',[CouponController::class,'editcoupon'])->name('editcoupon');
Route::get('delete-coupon/{bilai}',[CouponController::class,'deletecoupon'])->name('deletecoupon');
Route::get('trashed-coupon',[CouponController::class,'trashcoupon'])->name('trashcoupon');
Route::get('restore-coupon/{bilai}',[CouponController::class,'restorecoupon'])->name('restorecoupon');
Route::get('permanentdelete-coupon/{bilai}',[CouponController::class,'permanentdeletecoupon'])->name('permanentdeletecoupon');
Route::resource('role',RoleController::class);
Route::get('assign/user',[RoleController::class,'assignuser'])->name('assign.user');
Route::post('assign/user',[RoleController::class,'assignuserstore'])->name('assign.user.store');

Route::get('add-user',[RoleController::class,'adduser'])->name('adduser');
Route::post('post-user',[RoleController::class,'postuser'])->name('postuser');
Route::get('checkout',[CheckoutController::class,'checkout'])->middleware(['auth'])->name('checkout');
//Route::post('get/city/list',[CheckoutController::class,'getcitylist'])->name('getcitylist');
Route::get('get/city/list/{country_id}',[CheckoutController::class,'getcitylist'])->name('getcitylist');
Route::post('checkoutpost',[CheckoutController::class,'checkoutpost'])->name('checkoutpost');