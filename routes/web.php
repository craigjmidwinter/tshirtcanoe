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

Route::get('/', 'TshirtController@index');
Route::any('/register', 'TshirtController@register')->name('register');
Route::get('/tshirt/{user_code}', 'TshirtController@admin')->name('useradmin');
Route::get('/tshirt/{user_code}/add', 'TshirtController@addShirt');
Route::get('/tshirt/{user_code}/remove', 'TshirtController@removeShirt');
Route::get('/tshirt/{admin_code}/approve/{user_code}', 'TshirtController@approve');
Route::post('/tshirt/{user_code}/update_avatar', 'TshirtController@updateAvatar');
Route::post('/tshirt/{user_code}/update_misc_shit', 'TshirtController@updateMisc');
Route::get('/codes', 'TshirtController@codes')->name('codes');