<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ProductsController;
use App\Http\Controllers\Manager\OrderController;
use \App\Http\Controllers\Manager\StatisticController;

Route::group(['middleware' => ['permission:manager_per']], function () {
    Route::resource('/products', ProductsController::class)
        ->names('manager.products');
});

Route::group(['middleware' => ['permission:manager_per']], function () {
    Route::resource('/orders', OrderController::class)
        ->names('manager.orders');
    Route::post('/orders/approve/{order}',[OrderController::class, 'approve'])->name('manager.orders.approve');
    Route::post('/orders/reject/{order}',[OrderController::class, 'reject'])->name('manager.orders.reject');
});
Route::group(['middleware' => ['permission:manager_per']], function () {
    Route::get('/statistic', [StatisticController::class, 'index'])
        ->name('manager.statistic.index');
});
