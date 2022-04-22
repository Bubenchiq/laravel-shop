<?php

use Illuminate\Support\Facades\Route;
Route::group(['middleware' => ['permission:admin_per']], function () {
    //
});
