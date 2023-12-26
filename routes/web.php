<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Google login
Route::get('login/google', [HomeController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [HomeController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [HomeController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [HomeController::class, 'handleFacebookCallback']);


//Home
Route::get('/redirect', [HomeController::class, 'redirect']);
Route::get('/chi-tiet-san-pham/{slug}', [HomeController::class, 'view_detail']);
Route::get('/dien-thoai-cu-gia-re/{slug}', [HomeController::class, 'view_old_product_list']);
Route::get('/chi-tiet-san-pham-cu/{slug}/{id}', [HomeController::class, 'view_old_product_detail']);
Route::post('/order_old_product/{id}', [HomeController::class, 'order_old_product']);
Route::get('/getBranches', [HomeController::class, 'getBranches']);
Route::get('/cua-hang/{slug}', [HomeController::class, 'view_branch_location']);
Route::get('/he-thong-cua-hang', [HomeController::class, 'view_all_branches']);
Route::get('/khuyen-mai', [HomeController::class, 'view_news']);
Route::get('/tuyen-dung', [HomeController::class, 'view_recruitment']);
Route::get('/gioi-thieu', [HomeController::class, 'view_introduce']);
Route::get('/bao-hanh', [HomeController::class, 'view_guarantee']);
Route::get('/lien-he', [HomeController::class, 'view_contact']);
Route::get('/dien-thoai/{slug}', [HomeController::class, 'view_brand_detail']);
Route::get('/gio-hang', [HomeController::class, 'view_cart']);
Route::get('/don-hang', [HomeController::class, 'view_order']);
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
Route::get('/increase_product_cart/{id}', [HomeController::class, 'increase_product_cart']);
Route::get('/decrease_product_cart/{id}', [HomeController::class, 'decrease_product_cart']);
Route::post('/update_user_info/{id}', [HomeController::class, 'update_user_info']);
Route::get('/cash_order', [HomeController::class, 'cash_order']);
Route::post('/order_cancel/{key}', [HomeController::class, 'order_cancel']);
Route::get('/chi-tiet-don-hang/{id}', [HomeController::class, 'view_order_detail']);
Route::get('/san-pham-moi', [HomeController::class, 'view_new_product']);
Route::get('/san-pham-gia-re', [HomeController::class, 'view_cheap_price']);
Route::get('/san-pham-ban-chay', [HomeController::class, 'view_bestseller']);
Route::get('/dien-thoai-cu', [HomeController::class, 'view_all_old_product']);
Route::get('/dien-thoai-chinh-hang', [HomeController::class, 'view_all_products']);
Route::get('/search', [HomeController::class, 'searchdata']);
Route::post('/vnpay_payment', [HomeController::class, 'vnpay_payment']);
Route::get('/thanh-toan-vnpay', [HomeController::class, 'view_vnpayment_return']);


Route::get('/thong-tin-tai-khoan', [HomeController::class, 'view_account']);
Route::get('/chinh-sua-thong-tin', [HomeController::class, 'view_update_account']);
Route::get('/doi-mat-khau', [HomeController::class, 'view_update_pass_account']);
Route::post('/update_account_info/{id}', [HomeController::class, 'update_account_info']);
Route::post('/change-password/{id}', [HomeController::class, 'update_password']);
Route::get('/thong-tin-don-hang', [HomeController::class, 'view_account_order']);


Route::get('/san-pham-tren-20-trieu', [HomeController::class, 'filter_product_over_20']);
Route::get('/san-pham-tu-10-den-20-trieu', [HomeController::class, 'filter_product_from_10_to_20']);
Route::get('/san-pham-tu-4-den-10-trieu', [HomeController::class, 'filter_product_from_4_to_10']);
Route::get('/san-pham-duoi-4-trieu', [HomeController::class, 'filter_product_under_4']);

Route::get('/san-pham-ram-4gb', [HomeController::class, 'filter_product_ram_4gb']);
Route::get('/san-pham-ram-6gb', [HomeController::class, 'filter_product_ram_6gb']);
Route::get('/san-pham-ram-8gb', [HomeController::class, 'filter_product_ram_8gb']);
Route::get('/san-pham-ram-12gb', [HomeController::class, 'filter_product_ram_12gb']);

Route::get('/san-pham-rom-64gb', [HomeController::class, 'filter_product_rom_64gb']);
Route::get('/san-pham-rom-128gb', [HomeController::class, 'filter_product_rom_128gb']);
Route::get('/san-pham-rom-256gb', [HomeController::class, 'filter_product_rom_256gb']);
Route::get('/san-pham-rom-512gb', [HomeController::class, 'filter_product_rom_512gb']);
Route::get('/san-pham-rom-1tb', [HomeController::class, 'filter_product_rom_1tb']);

Route::get('/san-pham-pin-duoi-3000mAh', [HomeController::class, 'filter_product_pin_under_3000mAh']);
Route::get('/san-pham-pin-tu-3000-den-4000mAh', [HomeController::class, 'filter_product_pin_from_3000_to_4000mAh']);
Route::get('/san-pham-pin-tu-4000-den-5000mAh', [HomeController::class, 'filter_product_pin_from_4000_to_5000mAh']);
Route::get('/san-pham-pin-tren-5000mAh', [HomeController::class, 'filter_product_pin_over_5000mAh']);

Route::get('/san-pham-gia-tang-dan', [HomeController::class, 'filter_product_price_increase']);
Route::get('/san-pham-gia-giam-dan', [HomeController::class, 'filter_product_price_decrease']);
Route::get('/san-pham-ten-A-Z', [HomeController::class, 'filter_product_name_AZ']);
Route::get('/san-pham-ten-Z-A', [HomeController::class, 'filter_product_name_ZA']);


//Admin
Route::get('/quan-ly-tai-khoan', [AdminController::class, 'view_account']);
Route::get('/xoa-tai-khoan/{id}', [AdminController::class, 'delete_account']);
Route::get('/search_account', [AdminController::class, 'search_account']);

Route::get('/danh-sach-san-pham-ban-chay', [AdminController::class, 'view_product_bestseller']);
Route::get('/doanh-thu-san-pham', [AdminController::class, 'view_product_revenue']);
Route::get('/danh-sach-hang-ban-chay', [AdminController::class, 'view_brand_bestseller']);

Route::get('/quan-ly-hang', [AdminController::class, 'view_brand']);
Route::get('/them-moi-hang', [AdminController::class, 'view_add_brand']);
Route::post('/add_brand', [AdminController::class, 'add_brand']);
Route::get('/xoa-hang/{id}', [AdminController::class, 'delete_brand']);
Route::get('/chinh-sua-hang/{id}', [AdminController::class, 'view_update_brand']);
Route::post('/update_brand_confirm/{id}', [AdminController::class, 'update_brand_confirm']);
Route::get('/search_brand', [AdminController::class, 'search_brand']);

Route::get('/quan-ly-banner', [AdminController::class, 'view_banner']);
Route::get('/them-moi-banner', [AdminController::class, 'view_add_banner']);
Route::post('/add_banner', [AdminController::class, 'add_banner']);
Route::get('/xoa-banner/{id}', [AdminController::class, 'delete_banner']);
Route::get('/chinh-sua-banner/{id}', [AdminController::class, 'view_update_banner']);
Route::post('/update_banner_confirm/{id}', [AdminController::class, 'update_banner_confirm']);

Route::get('/quan-ly-san-pham', [AdminController::class, 'view_product']);
Route::get('/them-moi-san-pham', [AdminController::class, 'view_add_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/xoa-san-pham/{id}', [AdminController::class, 'delete_product']);
Route::get('/chinh-sua-san-pham/{id}', [AdminController::class, 'view_update_product']);
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);
Route::get('/thong-tin-chi-tiet/{id}', [AdminController::class, 'view_product_detail']);
Route::get('/search_product', [AdminController::class, 'search_product']);

Route::get('/quan-ly-hinh-anh', [AdminController::class, 'view_image']);
Route::get('/them-moi-hinh-anh', [AdminController::class, 'view_add_image']);
Route::get('/get-products/{brand_id}', [AdminController::class, 'getProducts']);
Route::post('/add_image', [AdminController::class, 'add_image']);
Route::get('/xoa-hinh-anh/{id}', [AdminController::class, 'delete_image']);
Route::get('/chinh-sua-hinh-anh/{id}', [AdminController::class, 'view_update_image']);
Route::post('/update_image_confirm/{id}', [AdminController::class, 'update_image_confirm']);
Route::get('/search_image', [AdminController::class, 'search_image']);

Route::get('/quan-ly-don-hang', [AdminController::class, 'view_order']);
Route::get('/quan-ly-don-hang/don-dang-cho-duyet', [AdminController::class, 'view_order_pending']);
Route::get('/quan-ly-don-hang/don-dang-van-chuyen', [AdminController::class, 'view_order_delivery']);
Route::get('/quan-ly-don-hang/don-da-giao-hang', [AdminController::class, 'view_order_done']);
Route::get('/quan-ly-don-hang/don-dang-da-huy', [AdminController::class, 'view_order_cancel']);
Route::get('/quan-ly-don-hang/don-dang-chua-thanh-toan', [AdminController::class, 'view_order_not_payment']);
Route::get('/quan-ly-don-hang/don-dang-da-thanh-toan', [AdminController::class, 'view_order_payment']);
Route::get('/quan-ly-don-hang/don-dang-da-thanh-toan-vnpay', [AdminController::class, 'view_order_payment_vnpay']);
Route::post('/update_order_delivery/{key}', [AdminController::class, 'update_order_delivery']);
Route::post('/update_order_done/{key}', [AdminController::class, 'update_order_done']);
Route::post('/update_order_cancel/{key}', [AdminController::class, 'update_order_cancel']);
Route::post('/update_order_payment/{key}', [AdminController::class, 'update_order_payment']);
Route::post('/update_order_not_payment/{key}', [AdminController::class, 'update_order_not_payment']);
Route::get('/don-hang/{id}', [AdminController::class, 'view_order_detail']);
Route::get('/print_pdf/{key}', [AdminController::class, 'exportToPdf']);
Route::get('/search_order', [AdminController::class, 'search_order']);

Route::get('/quan-ly-chi-nhanh', [AdminController::class, 'view_branch']);
Route::post('/add_branch', [AdminController::class, 'add_branch']);
Route::get('/xoa-chi-nhanh/{id}', [AdminController::class, 'delete_branch']);
Route::get('/chinh-sua-chi-nhanh/{id}', [AdminController::class, 'view_update_branch']);
Route::post('/update_branch_confirm/{id}', [AdminController::class, 'update_branch_confirm']);
Route::get('/search_branch', [AdminController::class, 'search_branch']);

Route::get('/quan-ly-kho', [AdminController::class, 'view_stock']);
Route::post('/add_stock', [AdminController::class, 'add_stock']);
Route::get('/xoa-kho/{id}', [AdminController::class, 'delete_stock']);
Route::get('/get-colors/{product_id}', [AdminController::class, 'getColors']);
Route::get('/chinh-sua-kho/{id}', [AdminController::class, 'view_update_stock']);
Route::post('/update_stock_confirm/{id}', [AdminController::class, 'update_stock_confirm']);
Route::get('/search_stock', [AdminController::class, 'search_stock']);

Route::get('/quan-ly-dien-thoai-cu', [AdminController::class, 'view_old_product']);
Route::get('/them-moi-dien-thoai-cu', [AdminController::class, 'view_add_old_product']);
Route::post('/add_old_product', [AdminController::class, 'add_old_product']);
Route::get('/xoa-dien-thoai-cu/{id}', [AdminController::class, 'delete_old_product']);
Route::get('/xoa-khach-dat-hang/{id}', [AdminController::class, 'delete_order_old_product']);
Route::get('/chinh-sua-dien-thoai-cu/{id}', [AdminController::class, 'view_update_old_product']);
Route::post('/update_old_product_confirm/{id}', [AdminController::class, 'update_old_product_confirm']);
Route::post('/update_order_old_product_done/{id}', [AdminController::class, 'update_order_old_product_done']);
Route::get('/search_old_product', [AdminController::class, 'search_old_product']);
