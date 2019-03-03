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
    return redirect('stats');
});

Auth::routes();

Route::post('/towns', 'SuperJobController@getTowns')->name('towns');

Route::post('/stats', 'SuperJobController@findJson')->name('findJson');

Route::get('/stats', 'SuperJobController@findForm')->name('stats');