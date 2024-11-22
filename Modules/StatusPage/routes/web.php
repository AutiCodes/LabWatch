<?php

use Illuminate\Support\Facades\Route;
use Modules\StatusPage\Http\Controllers\StatusPageController;

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

Route::group([], function () {
    Route::resource('statuspage', StatusPageController::class)->names('statuspage');
});