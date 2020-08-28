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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/admin', 'Admin\HomeController@index')->name('admin.home');


    Route::prefix('admin')->group(function () {
        Route::resource('/region', 'Admin\RegionController');
        Route::delete('/region/{region}/delete-city/{city}', 'Admin\RegionController@deleteCity')->name('region.delete-city');
        Route::resource('/city', 'Admin\CityController');
        Route::resource('/present-category', 'Admin\PresentCategoryController');
    });
});
