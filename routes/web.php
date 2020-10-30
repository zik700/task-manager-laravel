<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/taskboard');
});

Route::post('/done/{id}','TaskBoardController@done');
Route::get('/taskboard/dailydone','TaskBoardController@dailydone');
Route::get('/taskboard/dailycreated','TaskBoardController@dailycreated');
Route::get('/taskboard/monthlydone','TaskBoardController@monthlydone');
Route::get('/taskboard/monthlycreated','TaskBoardController@monthlycreated');
Route::resource('/taskboard', 'TaskBoardController', ['only'=> ['index','edit','store','destroy']]);
