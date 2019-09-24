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



Auth::routes(['register'=>false]);
Route::get('/pending', 'RequestsController@index')->middleware('auth');
Route::get('/request/create', 'RequestsController@create');
Route::post('/request', 'RequestsController@store');
Route::get('/request/{request}', 'RequestsController@show')->middleware('auth');
Route::get('/request/{request}/edit', 'RequestsController@edit');
Route::patch('/request/{request}', 'RequestsController@update');
Route::get('/request/{request}/take', 'RequestsController@take')->middleware('auth')->name('request.take');
Route::get('/appointments', 'RequestsController@appointments')->middleware('auth');
Route::get('/all', 'RequestsController@all');
Route::get('/request/{request}/delete', 'RequestsController@delete');
Route::get('/request/{request}/done', 'RequestsController@done');
Route::get('/request/{request}/undone', 'RequestsController@undone');
Route::get('/appointments/{user}', 'RequestsController@appointmentsOf');

Route::get('/verify/{request}/{token}', 'RequestsController@verify')->name('request.verify');

Route::get('/play', 'Controller@play');

Route::get('/status', 'Controller@status')->middleware('auth');

//Route::get('/application/reject', 'ApplicationController@rejection');
//Route::post('/rejection', 'ApplicationController@rejectionSend');

//Route::get('/application/interview', 'ApplicationController@interview');
//Route::post('/interview', 'ApplicationController@interviewSend');