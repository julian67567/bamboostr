<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', function () {
    $mensaje = "Laravel";
    //$version = "5";
    
    $collection = collect(['Bienvenido a Laravel 1', 'Bienvenido a Laravel 2', 'Bienvenido a Laravel 3']);
    $collection = $collection->every(2);
    
    return view('pages.welcome', ["mensaje" => $mensaje, "version" => '5', "collection" => $collection]);
});*/

//Route::get('/about', 'pruebaC@about'); //@about is a function under controllers

//Route::get('/contact', 'pruebaC@contact'); //@contact is a function under controllers

Route::get('user/{id}', function($id)
{
    return 'User '.$id;
});

Route::get('/', function () {
    return view('welcome');
});

Route::post('/payOption', 'pay@pay');

Route::get('/prueba', function () {
    return 'prueba de funcionamiento';
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
