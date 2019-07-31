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

Route::post('v1/book/create','BookController@create');

Route::get('v1/book/search/author/{author}/category/{category}', 'BookController@searchByAuthorAndCategory');

Route::get('v1/book/search/author/{author}', 'BookController@searchByAuthor');

Route::get('v1/book/search/category/{category}', 'BookController@searchByCategory');

Route::get('v1/book/categories', 'BookController@showCategories');

Route::delete('v1/book/{book}', 'BookController@delete');

Route::put('v1/book/{book}', 'BookController@update');

