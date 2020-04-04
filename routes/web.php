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

// Contact Controller
Route::prefix('/contact')->group(function () {
    
    Route::get('/', 'ContactController@index')->name('front.contact.index');
    Route::post('/send-email', 'ContactController@sendEmail')->name('front.contact.send_email');
});


Auth::routes();

// Admin Controller
Route::prefix('/admin')->namespace('Admin')->middleware('auth')->group(function () {
    Route::get('/', 'IndexController@index')->name('admin.index.index');
    
    Route::prefix('/sliders')->group(function () {
        Route::get('/', 'SlidersController@index')->name('admin.sliders.index');
        Route::get('/add', 'SlidersController@add')->name('admin.sliders.add');
        Route::post('/insert', 'SlidersController@insert')->name('admin.sliders.insert');
        Route::get('/edit/{slider}', 'SlidersController@edit')->name('admin.sliders.edit');
        Route::post('/update{slider}', 'SlidersController@update')->name('admin.sliders.update');
        Route::post('/delete', 'SlidersController@delete')->name('admin.sliders.delete');
        
        Route::post('/enable', 'SlidersController@enable')->name('admin.sliders.enable');
        Route::post('/disable', 'SlidersController@disable')->name('admin.sliders.disable');
        Route::post('/change-priority', 'SlidersController@changePriority')->name('admin.sliders.change_priority');
        
        Route::get('/slider-table', 'SlidersController@sliderTable')->name('admin.sliders.slider_table');
    });
});
