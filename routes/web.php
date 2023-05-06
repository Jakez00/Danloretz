<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/         
            

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
Route::get('/login', 'LoginController@show')->middleware('guest')->name('login');
Route::post('/login', 'LoginController@login')->middleware('guest')->name('login');
Route::post('/logout', 'LoginController@logout');





Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', 'DashboardController@index');
});

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', 'ProfileController@index');
});

Route::prefix('user-management')->middleware('auth')->group(function () {
    Route::get('/', 'UsermanagementController@index');
    Route::post('/add', 'UsermanagementController@add');
    Route::post('/delete', 'UsermanagementController@delete');
    Route::post('/edit', 'UsermanagementController@edit');
    Route::get('/detail', 'UsermanagementController@detail');
});

Route::prefix('storebranch')->middleware('auth')->group(function () {
    Route::get('/', 'StorebranchController@index');
    Route::post('/add', 'StorebranchController@add');
    Route::post('/edit', 'StorebranchController@edit');
    Route::post('/delete', 'StorebranchController@delete');
    Route::get('/detail', 'StorebranchController@detail');
});

Route::prefix('itemcatergory')->middleware('auth')->group(function () {
    Route::get('/', 'ItemtypeController@index');
    Route::post('/add', 'ItemtypeController@add');
    Route::post('/delete', 'ItemtypeController@delete');
    Route::post('/edit', 'ItemtypeController@edit');
    Route::get('/detail', 'ItemtypeController@detail');
});

Route::prefix('items')->middleware('auth')->group(function () {
    Route::get('/', 'ItemController@index');
    Route::POST('/', 'ItemController@index');
    Route::post('/add', 'ItemController@add');
    Route::post('/delete', 'ItemController@delete');
    Route::post('/edit', 'ItemController@edit');
    Route::post('/addstock', 'ItemController@addstock');
    Route::get('/detail', 'ItemController@detail');
});
