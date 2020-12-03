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
    Route::get('/region-presents', 'HomeController@regionPresents');


    Route::prefix('admin')->group(function () {
        Route::resource('/region', 'Admin\RegionController');
        Route::delete('/region/{region}/delete-city/{city}', 'Admin\RegionController@deleteCity')->name('region.delete-city');
        Route::resource('/city', 'Admin\CityController');
        Route::resource('/present-category', 'Admin\PresentCategoryController');
        Route::resource('/present', 'Admin\PresentController');
        Route::resource('/participant', 'Admin\ParticipantController');
        Route::post('/participant/import', 'Admin\ParticipantController@import')->name('participant.import');
    });

    Route::get('category/{id}', 'HomeController@presentByCategory');
    Route::post('category/{id}', 'HomeController@presentByCategory');

    Route::prefix('loto')->group(function () {
        //
    });
    Route::prefix('result')->group(function () {
        Route::get('/', 'Admin\ResultController@index')->name('result.index');
        Route::get('/show', 'Admin\ResultController@show')->name('result.show');
        Route::get('/reset', 'Admin\ResultController@reset')->name('result.reset');
        Route::delete('/delete/{id}', 'Admin\ResultController@destroy')->name('result.destroy');
    });
});
