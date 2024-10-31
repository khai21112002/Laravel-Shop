<?php

use App\Http\Controllers\manageCategory;
use App\Http\Controllers\ManageCategoryController;
use App\Http\Controllers\ManageOrder;
use App\Http\Controllers\manageProduct;
use App\Http\Controllers\ManageProductController;
use App\Http\Controllers\ManageProductImages;
use App\Http\Controllers\ManageStatistic;
use App\Http\Controllers\ManageUser;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchEngineController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\EnsureUserIsAuthenticated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserOrderController;
use App\Http\Middleware\AdminMiddleware;


//Part Thinh-cart, checkout,product detail
Route::get('/product/{product_slug}', [ShopController::class, 'product_details'])->name('shop.product.details');
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add_to_cart'])->name('add');
    Route::patch('/update/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{id}', [CartController::class, 'destroy'])->name('destroy');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    Route::middleware([EnsureUserIsAuthenticated::class])->group(function () {
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    });
});
Route::name('order.')->group(function () {
    Route::post('/order/store', [OrderController::class, 'store'])->name('store');
    Route::get('/order-confirmation', [OrderController::class, 'order_confirmation'])->name('confirmation');
    Route::get('/order/{orderId}/detail', [OrderController::class, 'order_detail'])->name('detail');
    Route::put('/account-order/cancel-order', [OrderController::class, 'cancelOrder'])->name('cancel');
    Route::put('/account-order/receive-order', [OrderController::class, 'receiveOrder'])->name('receive');
});
//Part Khai- Home,My order
Route::name('site.')->group(function () {
    Route::get('/', [HomeController::class, 'displayProductHome'])->name('index');
    Route::get('/product', [ProductController::class, 'displayProductList'])->name('product');
    Route::get('/about', function () {
        return view('site.about');
    })->name('about');
    Route::get('/contact', function () {
        return view('site.contact');
    })->name('contact');
    Route::get('/order', [UserOrderController::class, 'getOrdersByUser'])->name('order');
});


// Admin
Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get("/dashboard", [ManageStatistic::class, 'index'])->name('dashboard');
    Route::resource('/categories', ManageCategoryController::class);
    Route::get('/search-categories', [SearchEngineController::class]);
    Route::resource('/products', ManageProductController::class);
    Route::resource('/ProductImage', ManageProductImages::class);
    Route::resource('/users', ManageUser::class);
    Route::resource('/orders', ManageOrder::class);
    Route::get('/search-engine/{type}', [SearchEngineController::class, 'search']);
});


Route::get('/admin', function () {
    return view('admin');
})->name('admin.admin');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

