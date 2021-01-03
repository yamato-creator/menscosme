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

Auth::routes();

Route::get('/', function () { return redirect('/login'); });
Route::get('/login/guest', 'Auth\LoginController@guestLogin')->name('guest.login');

Route::group(['prefix' => 'admin'], function() {
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
    Route::get('products/index', 'Admin\ProductController@index')->name('admin.index');
    Route::get('products/create', 'Admin\ProductController@create')->name('admin.create');
    Route::post('products/store', 'Admin\ProductController@store')->name('admin.store');
    Route::get('products/show/{id}', 'Admin\ProductController@show')->name('admin.show');
    Route::get('products/edit/{id}', 'Admin\ProductController@edit')->name('admin.edit');
    Route::post('products/update/{id}', 'Admin\ProductController@update')->name('admin.update');
    Route::post('products/destroy/{id}', 'Admin\ProductController@destroy')->name('admin.destroy');
});

Route::group(['middleware' => 'auth:user'], function(){
   Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);
   Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
   Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
   Route::resource('tweets', 'TweetsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
   Route::resource('comments', 'CommentsController', ['only' => ['store']]);
   Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);
   Route::get('products/index', 'ProductController@index')->name('products.index');
   Route::get('products/show/{id}', 'ProductController@show')->name('products.show');
   Route::resource('reviews', 'ReviewsController', ['only' => ['store', 'destroy']]);
   Route::resource('wishlists', 'WishlistsController', ['only' => ['store','destroy']]);
   Route::get('wishlists/show', 'WishlistsController@show', ['only' => ['show']])->name('wishlists.show');
});

// Route::resource('products', 'ProductController', ['only' => ['index']]);
// Route::get('products/show/{id}', 'ProductController@show')->name('products.show');