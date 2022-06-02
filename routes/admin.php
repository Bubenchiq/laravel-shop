<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductsController;

Route::group(['middleware' => ['permission:admin_per']], function () {
    Route::resource('/products', ProductsController::class)
        ->names('admin.products');
});
