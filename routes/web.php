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

// Route::group(['middleware' => 'auth'], function () {
Route::middleware('auth')->group(function(){
Route::get('/productlist', 'productListController@showList') -> name('list');
Route::post('/productlist/search', 'productListController@searchList') -> name('search');
Route::post('/productlist/sort', 'productListController@sortList') -> name('sort');
Route::get('/productlist/delete/{id}', 'productListController@delete') -> name('delete');
Route::get('/productlist/add', 'productListController@add') -> name('add');
Route::post('/productlist/add', 'productListController@added') -> name('added');
Route::get('/productlist/more/{id}', 'productListController@more') -> name('more');
Route::get('/productlist/edit/{id}', 'productListController@edit') -> name('edit');
Route::post('/update', 'productListController@update') -> name('update');
});


