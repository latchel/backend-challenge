<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'Auth@login');

Route::get('/urls', 'Urls@index');
Route::post('/urls', 'Urls@store');
Route::put('/urls/{id}', 'Urls@update');
Route::get('/urls/favorite', 'Urls@favorite');
