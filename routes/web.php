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

// Route::get('/', function () {
//     return view('login');
// });

Auth::routes();
// Route::get('/login', 'OmahadminController@page_login')->name('login');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/regupersonil', 'RegupersonilController@index');
    // Route::post('/regupersonil/store', 'RegupersonilController@store');
    Route::post('/createpersonil', 'RegupersonilController@store')->name('createpersonil');
    // Route::get('/regupersonil/{id}/edit','OmahadminController@editpersonil')->name('editpersonil');
    Route::post('/regupersonil/{id}/update','RegupersonilController@update')->name('updatepersonil');
    Route::post('/regupersonil/{id}/destroy','RegupersonilController@destroy')->name('hapuspersonil');
    Route::GET('/regupersonil/{datepicker}','RegupersonilController@index');

    Route::get('/rekap', 'RekapController@index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
