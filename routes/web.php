<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth:web')->group(function() {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::resource('items', \App\Http\Controllers\Admin\ItemController::class);
        Route::resource('traders', \App\Http\Controllers\Admin\TraderController::class);
        Route::get('traders/{trader}/items', [\App\Http\Controllers\Admin\TraderController::class, 'items'])->name('traders.items.index');
        Route::get('traders/{trader}/items/missing', [\App\Http\Controllers\Admin\TraderController::class, 'missingItems'])->name('traders.items.missing.index');
        Route::get('traders/{trader}/items/remove/{item}', [\App\Http\Controllers\Admin\TraderController::class, 'removeItem'])->name('traders.items.remove');
        Route::get('traders/{trader}/items/missing/convert/{missing}', [\App\Http\Controllers\Admin\TraderController::class, 'showMissingItemCreate'])->name('traders.items.missing.convert');
        Route::post('items/{trader}', [\App\Http\Controllers\Admin\ItemController::class, 'storeWithTrader'])->name('items.store.trader');

        Route::resource('trader-items', \App\Http\Controllers\Admin\TraderItemController::class);
    });
});
