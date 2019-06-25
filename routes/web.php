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

Route::middleware(['auth'])->group(function () {
    Route::get('/tracks', 'TrackController@index');
    Route::post('/track/store', 'TrackController@store');
    Route::get('/track/remove/{track}', 'TrackController@remove');

    Route::get('/queue', 'QueueController@index');
    Route::post('/queue/store', 'QueueController@store');
    Route::get('/queue/remove/{queue}', 'QueueController@remove');

    // Catch-all route that sends everything to the front-end, and is routed through vue-router
    Route::get('/{any}', 'HomeController@index')->where('any', '.*');
});
