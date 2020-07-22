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
//Route::get('/pizzas', 'PizzaController@index')->middleware('auth'); the original way
Route::get('/pizzas', 'PizzaController@index')->name('pizzas.index')->middleware('auth'); // individual auth for each route, better method in the pizza controller
Route::get('/pizzas/create', 'PizzaController@create')->name('pizzas.create'); // ranked in order of preference, if it was below ID this page would never show
Route::post('/pizzas', 'PizzaController@store')->name('pizzas.store');
Route::get('/pizzas/{id}', 'PizzaController@show')->name('pizzas.show');
Route::delete('/pizzas/{id}','PizzaController@destroy')->name('pizzas.destroy');



Auth::routes([
    'register' => false
]);

Route::get('/home', 'HomeController@index')->name('home');
