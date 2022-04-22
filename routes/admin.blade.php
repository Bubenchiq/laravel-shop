<?php

use Illuminate\Support\Facades\Route;
Route::group(['middleware' => ['role:admin','permission:admin_pre']], function () {
    //
});
Route::group(['middleware' => ['role:manager','permission:manager_pre']], function () {
    //
});