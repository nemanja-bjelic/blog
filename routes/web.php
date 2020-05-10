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
    Route::get('/category-posts/{postCategory}/{seoSlug?}', 'PostsController@categoryPosts')->name('front.posts.category_posts');
    Route::get('/tag-posts/{tag}/{seoSlug?}', 'PostsController@tagPosts')->name('front.posts.tag_posts');
    Route::get('/author-posts/{user}/{seoSlug?}', 'PostsController@authorPosts')->name('front.posts.author_posts');
    Route::get('/single-post/{post}/{seoSlug?}', 'PostsController@singlePost')->name('front.posts.single_post');
    
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
        Route::post('/update/{slider}', 'SlidersController@update')->name('admin.sliders.update');
        Route::post('/delete', 'SlidersController@delete')->name('admin.sliders.delete');
        
        Route::post('/enable', 'SlidersController@enable')->name('admin.sliders.enable');
        Route::post('/disable', 'SlidersController@disable')->name('admin.sliders.disable');
        Route::post('/change-priority', 'SlidersController@changePriority')->name('admin.sliders.change_priority');
        
        Route::get('/slider-table', 'SlidersController@sliderTable')->name('admin.sliders.slider_table');
    });
    
    // PostCategories Controller
    Route::prefix('/post-categories')->group(function () {
        Route::get('/', 'PostCategoriesController@index')->name('admin.post_categories.index');
        Route::get('/add', 'PostCategoriesController@add')->name('admin.post_categories.add');
        Route::post('/insert', 'PostCategoriesController@insert')->name('admin.post_categories.insert');
        Route::get('/edit/{postCategory}', 'PostCategoriesController@edit')->name('admin.post_categories.edit');
        Route::post('/update/{postCategory}', 'PostCategoriesController@update')->name('admin.post_categories.update');
        Route::post('/delete', 'PostCategoriesController@delete')->name('admin.post_categories.delete');
        
        Route::post('/change-priority', 'PostCategoriesController@changePriority')->name('admin.post_categories.change_priority');
    });
    
    // Tags Controller
    Route::prefix('/tags')->group(function () {
        Route::get('/', 'TagsController@index')->name('admin.tags.index');
        Route::get('/add', 'TagsController@add')->name('admin.tags.add');
        Route::post('/insert', 'TagsController@insert')->name('admin.tags.insert');
        Route::get('/edit/{tag}', 'TagsController@edit')->name('admin.tags.edit');
        Route::post('/update/{tag}', 'TagsController@update')->name('admin.tags.update');
        Route::post('/delete', 'TagsController@delete')->name('admin.tags.delete');
    });
    
    // Posts Controller
    Route::prefix('/posts')->group(function () {
        Route::get('/', 'PostsController@index')->name('admin.posts.index');
        Route::get('/add', 'PostsController@add')->name('admin.posts.add');
        Route::post('/insert', 'PostsController@insert')->name('admin.posts.insert');
        Route::get('/edit/{post}', 'PostsController@edit')->name('admin.posts.edit');
        Route::post('/update/{post}', 'PostsController@update')->name('admin.posts.update');
        Route::post('/delete', 'PostsController@delete')->name('admin.posts.delete');
        
        Route::post('/enable', 'PostsController@enable')->name('admin.posts.enable');
        Route::post('/disable', 'PostsController@disable')->name('admin.posts.disable');
        
        Route::post('/important', 'PostsController@important')->name('admin.posts.important');
        Route::post('/unimportant', 'PostsController@unimportant')->name('admin.posts.unimportant');
        
        Route::post('/datatable', 'PostsController@datatable')->name('admin.posts.datatable');
        
        Route::post('/delete-photo/{post}', 'PostsController@deletePhoto')->name('admin.posts.delete_photo');
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
    
    // Comments Controller
    Route::prefix('/comments')->group(function (){
        Route::get('/', 'CommentsController@index')->name('admin.comments.index');
        
        Route::get('/comments-table', 'CommentsController@commentsTable')->name('admin.comments.comments_table');
        Route::post('/enable', 'CommentsController@enable')->name('admin.comments.enable');
        Route::post('/disable', 'CommentsController@disable')->name('admin.comments.disable');
    });
    
    //Routes for ProfileController
    Route::prefix('/profile')->group(function () {
        
        
        Route::get('/edit', 'ProfileController@edit')->name('admin.profile.edit');
        Route::post('/update', 'ProfileController@update')->name('admin.profile.update');
        
		Route::post('/delete-photo/{user}', 'ProfileController@deletePhoto')->name('admin.profile.delete_photo');
		
		Route::get('/change-password', 'ProfileController@changePassword')->name('admin.profile.change_password');
		Route::post('/change-password', 'ProfileController@changePasswordConfirm')->name('admin.profile.change_password_confirm');
    });
});
