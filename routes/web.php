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
//
// Route::get('/', function () {
//     return view('welcome');
// });

// Genera tutte le rotte relative all'autenticazione (login, registrazion, logout, forgot password ecc)
// Elimina la rotta di registrazione
Auth::routes(["register"=>false]);

// Rotta pubblica
Route::get('/', 'HomeController@index')->name('index');
Route::get('/contatti', 'HomeController@contatti')->name('contatti');

//     prefisso URL    prefisso rotte   namespace del controller
Route::prefix("admin")->name("admin.")->namespace("Admin")->middleware("auth")->group(function(){
    // Rotta homepage da loggati
    Route::get('/', 'HomeController@index')->name('index');

});
