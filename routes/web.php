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
    return view('home');
})->name('home');

Route::prefix('guests')->name('guests.')->group(function() {
    Route::get('frontend', 'GuestsController@frontendIndex')->name('frontend.index');
    Route::get('list', 'GuestsController@guestList')->name('list');
    Route::get('genders', 'GuestsController@genderList')->name('genders');
});
Route::resource('guests', 'GuestsController');
