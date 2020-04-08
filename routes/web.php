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

// Posts Controller
Route::prefix('/posts')->group(function () {
    
    Route::get('/', 'PostsController@index')->name('front.posts.index');
    Route::get('/category-posts/{postCategory}', 'PostsController@categoryPosts')->name('front.posts.category_posts');
    Route::get('/tag-posts/{tag}', 'PostsController@tagPosts')->name('front.posts.tag_posts');
    Route::get('/author-posts/{user}', 'PostsController@authorPosts')->name('front.posts.author_posts');
    Route::get('/single-post/{post}', 'PostsController@singlePost')->name('front.posts.single_post');
    
    Route::get('/search-posts', 'PostsController@searchPosts')->name('front.posts.search_posts');
    
    Route::post('/single-post-comment/{post}', 'PostsController@singlePostComment')->name('front.posts.single_post_comment');
    Route::post('/show-post-comments/{post}', 'PostsController@showPostComments')->name('front.posts.show_post_comments');
    
    Route::post('/increse-views/{post}', 'PostsController@increseViews')->name('front.posts.increse_views');
}); 


Auth::routes();

// Admin Controller
Route::prefix('/admin')->namespace('Admin')->middleware('auth')->group(function () {
    Route::get('/', 'IndexController@index')->name('admin.index.index');
    
    // Sliders Controller
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
    
    // Users Controller
    Route::prefix('/users')->group(function () {
        Route::get('/', 'UsersController@index')->name('admin.users.index');
        Route::get('/add', 'UsersController@add')->name('admin.users.add');
        Route::post('/insert', 'UsersController@insert')->name('admin.users.insert');
        Route::get('/edit/{user}', 'UsersController@edit')->name('admin.users.edit');
        Route::post('/update{user}', 'UsersController@update')->name('admin.users.update');
        
        Route::post('/enable', 'UsersController@enable')->name('admin.users.enable');
        Route::post('/disable', 'UsersController@disable')->name('admin.users.disable');
        Route::post('/delete-photo/{user}', 'UsersController@deletePhoto')->name('admin.users.delete_photo');
        
        Route::post('/datatable', 'UsersController@datatable')->name('admin.users.datatable');
    });
});
