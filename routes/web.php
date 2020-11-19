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

Route::get('/test', function () {

    event(new \App\Events\SendMessage());
    
    dd('Event Run Successfully.');

});

Route::get('/fire', function () {
    event(new \App\Events\TestEvent());
    event(new \App\Events\SendMessage());
    return 'ok';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
