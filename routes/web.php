<?php

use App\Http\Controllers\BahanBarController;
use App\Http\Controllers\BahanCsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DryGoodController;
use App\Http\Controllers\FroozenFoodController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PerlengkapanAreaLuarController;
use App\Http\Controllers\PerlengkapanBarController;
use App\Http\Controllers\PerlengkapanDapurController;
use App\Http\Controllers\PerlengkapanDepanController;
use App\Http\Controllers\PerlengkapanIndoorController;
use App\Http\Controllers\PerlengkapanOutdoorController;
use App\Http\Controllers\PerlengkapanWcController;
use App\Http\Controllers\ShowcaseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('login');
});


Route::group(['middleware' => 'guest'], function () {
});
Auth::routes(['register' => false]);


Route::group(['middleware' => ['auth', 'superadmin']], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user', [UserController::class, 'create'])->name('user.create');
    Route::patch('/user-update-{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user-delete-{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('category.post');
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
});

Route::group(['middleware' => 'auth'], function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/showcase', [ShowcaseController::class, 'index'])->name('showcase');
    Route::post('/showcase', [ShowcaseController::class, 'create'])->name('create.showcase');
    Route::patch('/showcase-add-{id}', [ShowcaseController::class, 'itemIn'])->name('itemIn.showcase');
    Route::patch('/showcase-out-{id}', [ShowcaseController::class, 'itemOut'])->name('itemOut.showcase');
    Route::patch('/showcase-update-{id}', [ShowcaseController::class, 'update'])->name('update.showcase');
    Route::delete('/showcase-destroy-{id}', [ShowcaseController::class, 'destroy'])->name('destroy.showcase');

    Route::get('/perlengkapan-depan', [PerlengkapanDepanController::class, 'index'])->name('perlengkapan-depan');
    Route::post('/perlengkapan-depan', [PerlengkapanDepanController::class, 'create'])->name('create.perlengkapan-depan');
    Route::patch('/perlengkapan-depan-add-{id}', [PerlengkapanDepanController::class, 'itemIn'])->name('itemIn.perlengkapan-depan');
    Route::patch('/perlengkapan-depan-out-{id}', [PerlengkapanDepanController::class, 'itemOut'])->name('itemOut.perlengkapan-depan');
    Route::patch('/perlengkapan-depan-update-{id}', [PerlengkapanDepanController::class, 'update'])->name('update.perlengkapan-depan');
    Route::delete('/perlengkapan-depan-destroy-{id}', [PerlengkapanDepanController::class, 'destroy'])->name('destroy.perlengkapan-depan');


    Route::get('/bahan-bar', [BahanBarController::class, 'index'])->name('bahan-bar');
    Route::post('/bahan-bar', [BahanBarController::class, 'create'])->name('create.bahan-bar');
    Route::patch('/bahan-bar-add-{id}', [BahanBarController::class, 'itemIn'])->name('itemIn.bahan-bar');
    Route::patch('/bahan-bar-out-{id}', [BahanBarController::class, 'itemOut'])->name('itemOut.bahan-bar');
    Route::patch('/bahan-bar-update-{id}', [BahanBarController::class, 'update'])->name('update.bahan-bar');
    Route::delete('/bahan-bar-destroy-{id}', [BahanBarController::class, 'destroy'])->name('destroy.bahan-bar');

    Route::get('/perlengkapan-bar', [PerlengkapanBarController::class, 'index'])->name('perlengkapan-bar');
    Route::post('/perlengkapan-bar', [PerlengkapanBarController::class, 'create'])->name('create.perlengkapan-bar');
    Route::patch('/perlengkapan-bar-add-{id}', [PerlengkapanBarController::class, 'itemIn'])->name('itemIn.perlengkapan-bar');
    Route::patch('/perlengkapan-bar-out-{id}', [PerlengkapanBarController::class, 'itemOut'])->name('itemOut.perlengkapan-bar');
    Route::patch('/perlengkapan-bar-update-{id}', [PerlengkapanBarController::class, 'update'])->name('update.perlengkapan-bar');
    Route::delete('/perlengkapan-bar-destroy-{id}', [PerlengkapanBarController::class, 'destroy'])->name('destroy.perlengkapan-bar');

    Route::get('/dry-good', [DryGoodController::class, 'index'])->name('dry-good');
    Route::post('/dry-good', [DryGoodController::class, 'create'])->name('create.dry-good');
    Route::patch('/dry-good-add-{id}', [DryGoodController::class, 'itemIn'])->name('itemIn.dry-good');
    Route::patch('/dry-good-out-{id}', [DryGoodController::class, 'itemOut'])->name('itemOut.dry-good');
    Route::patch('/dry-good-update-{id}', [DryGoodController::class, 'update'])->name('update.dry-good');
    Route::delete('/dry-good-destroy-{id}', [DryGoodController::class, 'destroy'])->name('destroy.dry-good');

    Route::get('/froozen-food', [FroozenFoodController::class, 'index'])->name('froozen-food');
    Route::post('/froozen-food', [FroozenFoodController::class, 'create'])->name('create.froozen-food');
    Route::patch('/froozen-food-add-{id}', [FroozenFoodController::class, 'itemIn'])->name('itemIn.froozen-food');
    Route::patch('/froozen-food-out-{id}', [FroozenFoodController::class, 'itemOut'])->name('itemOut.froozen-food');
    Route::patch('/froozen-food-update-{id}', [FroozenFoodController::class, 'update'])->name('update.froozen-food');
    Route::delete('/froozen-food-destroy-{id}', [FroozenFoodController::class, 'destroy'])->name('destroy.froozen-food');

    Route::get('/perlengkapan-dapur', [PerlengkapanDapurController::class, 'index'])->name('perlengkapan-dapur');
    Route::post('/perlengkapan-dapur', [PerlengkapanDapurController::class, 'create'])->name('create.perlengkapan-dapur');
    Route::patch('/perlengkapan-dapur-add-{id}', [PerlengkapanDapurController::class, 'itemIn'])->name('itemIn.perlengkapan-dapur');
    Route::patch('/perlengkapan-dapur-out-{id}', [PerlengkapanDapurController::class, 'itemOut'])->name('itemOut.perlengkapan-dapur');
    Route::patch('/perlengkapan-dapur-update-{id}', [PerlengkapanDapurController::class, 'update'])->name('update.perlengkapan-dapur');
    Route::delete('/perlengkapan-dapur-destroy-{id}', [PerlengkapanDapurController::class, 'destroy'])->name('destroy.perlengkapan-dapur');

    Route::get('/perlengkapan-indoor', [PerlengkapanIndoorController::class, 'index'])->name('perlengkapan-indoor');
    Route::post('/perlengkapan-indoor', [PerlengkapanIndoorController::class, 'create'])->name('create.perlengkapan-indoor');
    Route::patch('/perlengkapan-indoor-add-{id}', [PerlengkapanIndoorController::class, 'itemIn'])->name('itemIn.perlengkapan-indoor');
    Route::patch('/perlengkapan-indoor-out-{id}', [PerlengkapanIndoorController::class, 'itemOut'])->name('itemOut.perlengkapan-indoor');
    Route::patch('/perlengkapan-indoor-update-{id}', [PerlengkapanIndoorController::class, 'update'])->name('update.perlengkapan-indoor');
    Route::delete('/perlengkapan-indoor-destroy-{id}', [PerlengkapanIndoorController::class, 'destroy'])->name('destroy.perlengkapan-indoor');

    Route::get('/perlengkapan-outdoor', [PerlengkapanOutdoorController::class, 'index'])->name('perlengkapan-outdoor');
    Route::post('/perlengkapan-outdoor', [PerlengkapanOutdoorController::class, 'create'])->name('create.perlengkapan-outdoor');
    Route::patch('/perlengkapan-outdoor-add-{id}', [PerlengkapanOutdoorController::class, 'itemIn'])->name('itemIn.perlengkapan-outdoor');
    Route::patch('/perlengkapan-outdoor-out-{id}', [PerlengkapanOutdoorController::class, 'itemOut'])->name('itemOut.perlengkapan-outdoor');
    Route::patch('/perlengkapan-outdoor-update-{id}', [PerlengkapanOutdoorController::class, 'update'])->name('update.perlengkapan-outdoor');
    Route::delete('/perlengkapan-outdoor-destroy-{id}', [PerlengkapanOutdoorController::class, 'destroy'])->name('destroy.perlengkapan-outdoor');

    Route::get('/perlengkapan-area-luar', [PerlengkapanAreaLuarController::class, 'index'])->name('perlengkapan-area-luar');
    Route::post('/perlengkapan-area-luar', [PerlengkapanAreaLuarController::class, 'create'])->name('create.perlengkapan-area-luar');
    Route::patch('/perlengkapan-area-luar-add-{id}', [PerlengkapanAreaLuarController::class, 'itemIn'])->name('itemIn.perlengkapan-area-luar');
    Route::patch('/perlengkapan-area-luar-out-{id}', [PerlengkapanAreaLuarController::class, 'itemOut'])->name('itemOut.perlengkapan-area-luar');
    Route::patch('/perlengkapan-area-luar-update-{id}', [PerlengkapanAreaLuarController::class, 'update'])->name('update.perlengkapan-area-luar');
    Route::delete('/perlengkapan-area-luar-destroy-{id}', [PerlengkapanAreaLuarController::class, 'destroy'])->name('destroy.perlengkapan-area-luar');

    Route::get('/perlengkapan-wc', [PerlengkapanWcController::class, 'index'])->name('perlengkapan-wc');
    Route::post('/perlengkapan-wc', [PerlengkapanWcController::class, 'create'])->name('create.perlengkapan-wc');
    Route::patch('/perlengkapan-wc-add-{id}', [PerlengkapanWcController::class, 'itemIn'])->name('itemIn.perlengkapan-wc');
    Route::patch('/perlengkapan-wc-out-{id}', [PerlengkapanWcController::class, 'itemOut'])->name('itemOut.perlengkapan-wc');
    Route::patch('/perlengkapan-wc-update-{id}', [PerlengkapanWcController::class, 'update'])->name('update.perlengkapan-wc');
    Route::delete('/perlengkapan-wc-destroy-{id}', [PerlengkapanWcController::class, 'destroy'])->name('destroy.perlengkapan-wc');

    Route::get('/bahan-cs', [BahanCsController::class, 'index'])->name('bahan-cs');
    Route::post('/bahan-cs', [BahanCsController::class, 'create'])->name('create.bahan-cs');
    Route::patch('/bahan-cs-add-{id}', [BahanCsController::class, 'itemIn'])->name('itemIn.bahan-cs');
    Route::patch('/bahan-cs-out-{id}', [BahanCsController::class, 'itemOut'])->name('itemOut.bahan-cs');
    Route::patch('/bahan-cs-update-{id}', [BahanCsController::class, 'update'])->name('update.bahan-cs');
    Route::delete('/bahan-cs-destroy-{id}', [BahanCsController::class, 'destroy'])->name('destroy.bahan-cs');
});
