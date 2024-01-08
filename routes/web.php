<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;
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
/*Route::middleware('guest')->as('auth.')->group(function () {
    Route::as('login.')->controller(\App\Http\Controllers\AuthController::class)->group(function () {
        Route::get('', 'create')->name('create');
        Route::post('do-login', 'submit')->name('submit');
    });
});*/
Route::middleware('guest')->as('auth.')->group(function () {

    // Login
    Route::prefix('login')
        ->as('login.')
        ->controller(AuthController::class)
        ->group(function () {
            Route::get('', 'create')->name('create');
            Route::post('', 'submit')->name('submit');
        });

});

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::as('')
        ->controller(IndexController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('logout', 'logout')->name('logout');
        });

    // Department
    Route::prefix('department')
        ->as('department.')
        ->controller(DepartmentController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('add', 'add')->name('add');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{slug}', 'edit')->name('edit');
            Route::put('', 'update')->name('update');
            Route::delete('', 'destroy')->name('destroy');
        });

    // Position
    Route::prefix('position')
        ->as('position.')
        ->controller(PositionController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('add', 'add')->name('add');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{slug}', 'edit')->name('edit');
            Route::put('', 'update')->name('update');
            Route::delete('', 'destroy')->name('destroy');
        });

    // Salary
    Route::prefix('salary')
        ->as('salary.')
        ->controller(SalaryController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('add', 'add')->name('add');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('', 'update')->name('update');
            Route::delete('', 'destroy')->name('destroy');
        });

    // Employee
    Route::prefix('employee')
        ->as('employee.')
        ->controller(EmployeeController::class)
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('add', 'add')->name('add');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('', 'update')->name('update');
            Route::delete('', 'destroy')->name('destroy');
        });

});
