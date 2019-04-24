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
    return view('auth.login');
});

//Route::get('/{any}', function () {
//    return view('survey');
//})->where('any', '.*');

Route::get('/survey/{vue_capture?}', function () {
    return view('survey');
})->where('vue_capture', '[\/\w\.-]*')->name('survey');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
