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

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/register','RegistrationController@create');
Route::post('/done/{id}','TaskBoardController@done');
Route::get('/taskboard/dailydone','TaskBoardController@dailydone');
Route::get('/taskboard/dailycreated','TaskBoardController@dailycreated');
Route::get('/taskboard/monthlydone','TaskBoardController@monthlydone');
Route::get('/taskboard/monthlycreated','TaskBoardController@monthlycreated');
Route::resource('/taskboard', 'TaskBoardController');
// Route::get('/login','SessionsController@create');
// Route::get('/home', 'HomeController@index')->name('home');
// Route::resource('/profile/{user}', 'ProfilesController@index')->name('profile');