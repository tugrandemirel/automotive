<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Company\CompanyController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\ProfileController;
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
Route::middleware(['auth'])->group(function (){
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/firma-bilgilerim', [IndexController::class, 'getMeCompany'])->name('company');

    Route::prefix('sepetim')->as('cart.')->group(function (){
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/store', [CartController::class, 'store'])->name('store');
        Route::post('/update/{cart}', [CartController::class, 'update'])->name('update');
        Route::delete('/destroy/{cart}', [CartController::class, 'destroy'])->name('destroy');
        Route::delete('/single-destroy/{cart}', [CartController::class, 'singleDestroy'])->name('single-destroy');
    });

    Route::resource('siparislerim', OrderController::class)
        ->parameter('siparislerim', 'order')
        ->names('order')
        ->except('show');

});


Route::prefix('admin')->as('admin.')->middleware(['auth', 'verified', 'isRole'])->group(function (){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('firma', CompanyController::class)
        ->parameter('firma', 'company')
        ->names('company')
        ->except('show');

    Route::resource('kullanici', UserController::class)
        ->parameter('kullanici', 'user')
        ->names('user')
        ->except('show');

    Route::delete('single-delete-image/{media}', [ProductController::class, 'singleImageDelete'])->name('product.single_image_destroy');
    Route::resource('urunler', ProductController::class)
        ->parameter('urunler', 'product')
        ->names('product')
        ->except('show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
