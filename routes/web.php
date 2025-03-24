<?php

use App\Http\Controllers\admins\CategoriesController;
use App\Http\Controllers\Admins\HomeController as AdminsHomeController;
use App\Http\Controllers\Admins\ProductsController as AdminsProductsController;
use App\Http\Controllers\Admins\CategoriesController as AdminsCategoriesController;
use App\Http\Controllers\Admins\AccountsController as AdminsAccountsController;
use App\Http\Controllers\Admins\OrdersController as AdminsOrdersController;
use App\Http\Controllers\Admins\DiscountsController as AdminsDiscountsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\payments\MoMoController;
use App\Http\Controllers\payments\VNPAYController;
use App\Http\Controllers\users\cartsController;
use App\Http\Controllers\users\CartsController as UsersCartsController;
use App\Http\Controllers\users\ProfileController as UsersProfileController;
use App\Http\Controllers\users\OrdersController as UsersOrdersController;
use App\Http\Controllers\users\CommentsController;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\users\SearchsController;
use App\Http\Controllers\VNPayController as ControllersVNPayController;
use App\Models\Payment;
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

// Route login
Route::prefix('/log')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('form_login');
    Route::get('/register', [AuthController::class, 'register'])->name('form_register');
    Route::post('/login', [LoginController::class, 'store'])->name('login');
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route admin
Route::prefix('/admin')->middleware('auth', 'admin')->group(function () {
    // Route home
    Route::get('/', [AdminsHomeController::class, 'index'])->name('admin.home');
    Route::get('/profile', [AdminsHomeController::class, 'profile'])->name('admin.profile');
    Route::get('/change-password', [AdminsHomeController::class, 'changePasswordForm'])->name('admin.change-password');
    Route::post('/update-password', [AdminsHomeController::class, 'updatePassword'])->name('admin.update-password');

    // Route products
    Route::get('/products', [AdminsProductsController::class, 'index'])->name('admin.products');
    Route::get('/products/add', [AdminsProductsController::class, 'create'])->name('admin.addProduct');
    Route::post('/products/store', [AdminsProductsController::class, 'store'])->name('admin.storeProduct');
    Route::get('/products/edit/{id}', [AdminsProductsController::class, 'edit'])->name('admin.editProduct');
    Route::put('products/update/{id}', [AdminsProductsController::class, 'update'])->name('admin.updateProduct');
    Route::delete('/products/delete/{id}', [AdminsProductsController::class, 'destroy'])->name('admin.deleteProduct');

    // Route categories
    Route::get('/categories', [AdminsCategoriesController::class, 'index'])->name('admin.categories');
    Route::get('/categories/add', [AdminsCategoriesController::class, 'create'])->name('admin.addCategory');
    Route::post('/categories/store', [AdminsCategoriesController::class, 'store'])->name('admin.storeCategory');
    Route::get('/categories/edit/{id}', [AdminsCategoriesController::class, 'edit'])->name('admin.editCategory');
    Route::put('/categories/update/{id}', [AdminsCategoriesController::class, 'update'])->name('admin.updateCategory');
    Route::patch('/categories/hidden/{id}', [AdminsCategoriesController::class, 'updateCategoryStatus'])->name('admin.hiddenCategory');
    Route::patch('/categories/active/{id}', [AdminsCategoriesController::class, 'activateCategory'])->name('admin.activeCategory');

    // Route accounts
    Route::get('/accounts', [AdminsAccountsController::class, 'index'])->name('admin.accounts');
    Route::get('/accounts/add', [AdminsAccountsController::class, 'create'])->name('admin.addAccount');
    Route::post('/accounts/store', [AdminsAccountsController::class, 'store'])->name('admin.storeAccount');
    Route::get('/accounts/edit/{id}', [AdminsAccountsController::class, 'edit'])->name('admin.editAccount');
    Route::put('/accounts/update/{id}', [AdminsAccountsController::class, 'update'])->name('admin.updateAccount');
    Route::patch('/accounts/hidden/{id}', [AdminsAccountsController::class, 'updateAccountStatus'])->name('admin.hiddenAccount');
    Route::patch('/accounts/active/{id}', [AdminsAccountsController::class, 'activateAccount'])->name('admin.activeAccount');

    // Route discounts
    Route::get('/discounts', [AdminsDiscountsController::class, 'index'])->name('admin.discounts');
    Route::get('/discounts/add', [AdminsDiscountsController::class, 'create'])->name('admin.addDiscount');

    // Route orders
    Route::get('/orders', [AdminsOrdersController::class, 'index'])->name('admin.orders');
    Route::get('/orders/{id}/detail', [AdminsOrdersController::class, 'orderDetail'])->name('admin.orders.detail');
    Route::put('/orders/{id}/update-status', [AdminsOrdersController::class, 'updateOrderStatus'])->name('admin.orders.update_status');
    Route::get('/orders/history', [AdminsOrdersController::class, 'orderHistory'])->name('admin.orders.history');
});

// Route user
Route::prefix('/user')->group(function () {
    // Route detail products
    Route::get('/product/detail/{id}', [HomeController::class, 'detail'])->name('user.detailProduct');

    // Route category
    Route::get('/category/{id}', [HomeController::class, 'category'])->name('user.category');

    // Route comment
    Route::post('/comment/add', [CommentsController::class, 'store'])->name('user.addComment');

    // Route cart
    Route::get('/cart', [UsersCartsController::class, 'showCart'])->name('user.cart');
    Route::post('/cart/add', [UsersCartsController::class, 'store'])->name('user.addCart');
    Route::delete('/cart/delete/{id}', [UsersCartsController::class, 'destroy'])->name('user.deleteCartDetail');

    // Route search
    Route::post('/search', [SearchsController::class, 'search'])->name('user.search');

    // Route profile
    Route::get('/profile', [UsersProfileController::class, 'showProfile'])->name('user.profile');
    Route::get('/update/profile{id}', [UsersProfileController::class, 'update_form'])->name('user.updateForm');
    Route::post('update/profile/{id}', [UsersProfileController::class, 'update_profile'])->name('user.updateProfile');

    // Route chage password
    Route::get('/change/pass', [UsersProfileController::class, 'chage_pass'])->name('user.changePass');
    Route::post('/changePass', [UsersProfileController::class, 'changePass'])->name('user.chagePass');

    // Route order
    Route::get('/order', [UsersOrdersController::class, 'index'])->name('user.order');
    Route::post('/order/create', [UsersOrdersController::class, 'create_order'])->name('user.createOrder');
    Route::get('/order/detail', [UsersOrdersController::class, 'my_order'])->name('user.detailOrder');
    Route::get('/order/{id}', [UsersOrdersController::class, 'order_detail'])->name('users.order_detail');
    Route::get('/history/order/detail', [UsersOrdersController::class, 'history_order'])->name('user.historyDetailOrder');

    // Route payment
    // Route::post('/vnpay/payment', [ControllersVNPayController::class, 'createPayment'])->name('vnpay.payment');
    // Route::get('/payment/momo/{order_id}', [MoMoController::class, 'payment'])->name('momo.payment');
});

// Route home
Route::get('/', [HomeController::class, 'index'])->name('home');
