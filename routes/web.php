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
        Route::get('traders/{trader}/items', [\App\Http\Controllers\TraderController::class, 'items'])->name('trader.items');
        Route::resource('trader-items', \App\Http\Controllers\TraderItemController::class);
    });
});
