<?php

// use App\Http\Controllers\CarDetailController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'CarDetailController@index')->name('index');
Route::post('/', 'CarDetailController@store')->name('store');
Route::get('/paint-jobs', 'CarDetailController@show')->name('show');

Route::post('/update', 'CarDetailController@update')->name('update');
