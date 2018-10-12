<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('qr/{id}/location/{location}', 'QrController@updateLocation');
Route::post('qr/{id}/location', 'QrController@setLocation');
Route::get('qr/all', 'QrController@getall');
Route::get('qr/{id}', 'QrController@get');