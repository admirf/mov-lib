<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Account')->group(function () {
    Route::post('/register', 'RegistrationController');
    Route::get('/me', 'MeController');
});

Route::namespace('Genres')->group(function () {
    Route::get('/genres', 'GenreController');
});

Route::namespace('Movies')->group(function () {
    Route::get('/movies', 'MovieController@index');
    Route::get('/movies/{movie}', 'MovieController@show');

    Route::get('/favorites', 'FavoriteController@index');
    Route::post('/favorites/{movie}', 'FavoriteController@add');
    Route::delete('/favorites/{movie}', 'FavoriteController@remove');

    Route::get('/orders', 'OrderController@index');
    Route::post('/movies/{movie}/order', 'OrderController@order');

    Route::get('/movies/{movie}/reviews', 'ReviewController@index');
    Route::post('/movies/{movie}/reviews', 'ReviewController@store');
    Route::delete('/reviews/{review}', 'ReviewController@destroy');
});
