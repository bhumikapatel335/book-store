<?php

use Illuminate\Http\Request;
use App\Book;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//api for book
Route::post('v1/book/create','BookController@create');

Route::get('v1/book/search/author/{author}/category/{category}', 'BookController@searchByAuthorAndCategory');

Route::get('v1/book/search/author/{author}', 'BookController@searchByAuthor');

Route::get('v1/book/search/category/{category}', 'BookController@searchByCategory');

Route::get('v1/book/categories', 'BookController@showCategories');

Route::delete('v1/book/{id}', 'BookController@delete');

Route::put('v1/book/{id}', 'BookController@update');

//api for user

Route::post('v1/user/create','UserController@create');

Route::get('v1/user/{id}', 'UserController@show');

Route::delete('v1/user/{id}', 'UserController@delete');

Route::put('v1/user/{id}', 'UserController@update');

Route::get('v1/user/send/{user}','UserController@sendNotification');





