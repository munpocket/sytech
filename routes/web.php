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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/productlist', 'productListController@showList')->name('list');
Route::post('/searchlist', 'productListController@search')->name('search');
// Route::get('/add', )->name('add');
// Route::get('/more', )->name('more');

