<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\IndexController;
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
Route::middleware('guest')->as('auth.')->group(function () {
    Route::as('login')->controller(\App\Http\Controllers\AuthController::class)->group(function () {
        Route::get('', 'create')->name('create');
        Route::post('do-login', 'submit')->name('submit');
    });
});

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::as('')
        ->controller(IndexController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
        });

    // Department
    Route::prefix('department')
        ->as('cart.')
        ->controller(DepartmentController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('checkout', 'checkout')->name('checkout');
            Route::delete('', 'destroy')->name('destroy');
        });

});
