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
    Route::post('/createpersonil', 'RegupersonilController@store')->name('createpersonil');
    Route::post('/regupersonil/{id}/update','RegupersonilController@update');
    Route::post('/regupersonil/{id}/destroy','RegupersonilController@destroy');
    Route::GET('/regupersonil/{datepicker}','RegupersonilController@index');

    //rekap
    Route::get('/rekap', 'RekapController@index');
    
    //tugas jaga
    Route::get('/tugas-jaga', 'TugasJagaController@index');
    Route::post('/tugas-jaga/{id}/update','TugasJagaController@PlottingPos');

    //Pergantian Shift
    Route::get('/pergantian-shift','PergantianShiftController@index');
    Route::post('/createlapshift', 'PergantianShiftController@store')->name('createlapshift');
    Route::post('/pergantian-shift/{id}/update', 'PergantianShiftController@update');
    Route::post('/pergantian-shift/{id}/destroy', 'PergantianShiftController@destroy');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
