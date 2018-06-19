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


Route::get('/', function () {
     if (auth()->check()) {
        if (Auth::user()->user_role == 'client') {
            return redirect('/fb');
        }
        if(Auth::user()->user_role == 'manager'){
           return redirect('/fbAll'); 
        }
    }
    return redirect()->to('login');
});
Route::get('/fb', 'HomeController@feedback')->middleware('can:client');
Route::get('/fbAll','HomeController@feedbackAll')->middleware('can:manager');
