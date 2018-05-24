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

Route::get('redirect', 'RedirectController@redirect')->name('redirect');
Route::get('/podelenie_autocomplete', 'AotocompleteController@podelenie_autocomplete')->name('podelenie_autocomplete');

Route::group(['middleware' => ['active_session']], function() {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/logout', 'LogoutController@logout')->name('logout');
    Route::resource('signals', 'SignalsController');
    
});