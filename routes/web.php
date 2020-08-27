<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     $name = request('name');
//     return view('home', ["name" => $name]);
// });

// Route::get('/', 'HomeController@index');

// Route::get('contact', function () {
//     // request()->fullUrl();
//     // request()->path();
//     // return request()->is('contact') ? true : false;
//     return request()->path()  == 'contact' ? true : false;
// });


Route::prefix('post')->middleware('auth')->group(function () {
    Route::get('create', 'PostController@create')->name('posts.create');
    // model binding dari router 
    Route::post('store', 'PostController@store');
    Route::get('{post:id}/edit', 'PostController@edit');
    Route::patch('{post:id}/edit', 'PostController@update');
    Route::delete('{post:id}', 'PostController@destroy');
    Route::get('', 'PostController@index')->name('posts.index')->withoutMiddleware('auth');
    Route::get('{post:slug}', 'PostController@show')->withoutMiddleware('auth')->name('post.show');
});

// category
Route::get('category/{category:slug}', 'CategoryController@show')->name('categories.show');

// tags`
Route::get('tags/{tag:slug}', 'TagController@show')->name('tags.show');


Route::view('contact', 'contact');
Route::view('about', 'about');
Route::view('login', 'login');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
