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
    Route::resource('products', 'Admin\ProductController', ['only' => ['index', 'create', 'store',]]);
    Route::get('products/show/{id}', 'Admin\ProductController@show')->name('products.show');
    Route::get('products/edit/{id}', 'Admin\ProductController@edit')->name('products.edit');
    Route::post('products/update/{id}', 'Admin\ProductController@update')->name('products.update');
    Route::post('products/destroy/{id}', 'Admin\ProductController@destroy')->name('products.destroy');
});

Route::group(['middleware' => 'auth:user'], function(){
   Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);
   Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
   Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
   Route::resource('tweets', 'TweetsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
   Route::resource('comments', 'CommentsController', ['only' => ['store']]);
   Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);
   Route::resource('products', 'ProductController', ['only' => ['index', 'show']]);
   Route::resource('reviews', 'ReviewsController', ['only' => ['store', 'destroy']]);
   Route::resource('wishlists', 'WishlistsController', ['only' => ['store','destroy']]);
   Route::get('wishlists/show', 'WishlistsController@show', ['only' => ['show']])->name('wishlists.show');
});

// Route::resource('products', 'ProductController', ['only' => ['index']]);
// Route::get('products/show/{id}', 'ProductController@show')->name('products.show');