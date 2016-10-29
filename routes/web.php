<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/demo', function () {
    return view('lte.demo');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Admin
Route::group(['middleware' => ['web','isAdmin']], function() {

});

//Teacher
Route::group(['middleware' => ['web','isTeacher']], function() {

});

//User
Route::group(['middleware' => ['web','auth']], function() {

});