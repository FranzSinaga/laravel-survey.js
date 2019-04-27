<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/survey/create', 'SurveyController@store');
Route::get('/survey/create/{id}', 'SurveyController@edit');
Route::post('/survey/update/{id}', 'SurveyController@update');
//Route::delete('/post/delete/{id}', 'PostController@delete');
//Route::get('/posts', 'PostController@index');

// ================SurveyCreateAPI================ //
Route::post('/survey/createSurvey', 'SurveyCreateController@store');
Route::get('/survey', 'SurveyCreateController@index');

// ================SurveyAnswerAPI================ //
Route::post('/survey/answer/{id}', 'AnswerController@save');
Route::get('/survey/detail-answer/{id}', 'SurveyController@getAnswer');
Route::get('/survey/show-answer/{id}', 'SurveyController@getAnswerById');

