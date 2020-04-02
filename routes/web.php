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

Route::get('/', 'IndexController@index')->name('front.index.index');


Auth::routes();

// Admin Controller
Route::prefix('/admin')->namespace('Admin')->middleware('auth')->group(function () {
    Route::get('/', 'IndexController@index')->name('admin.index.index');
});
