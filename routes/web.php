<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth;

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
    //ROOT
    Route::get('/', 'Auth\AuthenticatedSessionController@create');
// });

Auth::routes();
// Route::get('/login', 'OmahadminController@page_login')->name('login');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    //Regu dan Personil
    Route::get('/regupersonil', 'RegupersonilController@index');
    Route::post('/createpersonil', 'RegupersonilController@store')->name('createpersonil');
    Route::post('/regupersonil/{id}/update','RegupersonilController@update');
    Route::post('/regupersonil/{id}/destroy','RegupersonilController@destroy');
    Route::GET('/regupersonil/{datepicker}','RegupersonilController@index');

    //Rekap
    Route::get('/rekap','RekapController@index');
    Route::get('/rekap/{datepicker}','RekapController@index');
    
    //tugas jaga
    Route::get('/tugas-jaga', 'TugasJagaController@index');
    Route::post('/tugas-jaga/{id}/update','TugasJagaController@PlottingPos');

    //Pergantian Shift
    Route::get('/pergantian-shift','PergantianShiftController@index');
    Route::post('/createlapshift', 'PergantianShiftController@store')->name('createlapshift');
    Route::post('/pergantian-shift/{id}/update', 'PergantianShiftController@update');
    Route::post('/pergantian-shift/{id}/destroy', 'PergantianShiftController@destroy');

    //Pamswakarsa
    Route::get('/pamswakarsa','PamswakarsaController@index');
    Route::post('/createpamswakarsa', 'PamswakarsaController@store')->name('createpamswakarsa');
    Route::post('/pamswakarsa/{id}/update', 'PamswakarsaController@update');
    Route::post('/pamswakarsa/{id}/destroy', 'PamswakarsaController@destroy');

    //Produksi
    Route::get('/produksi','ProduksiController@index');
    Route::post('/createproduksi', 'ProduksiController@store')->name('createproduksi');
    Route::post('/produksi/{id}/update', 'ProduksiController@update');
    Route::post('/produksi/{id}/destroy', 'ProduksiController@destroy');

    //Pemindahan
    Route::get('/pemindahan','PemindahanController@index');
    Route::post('/createpemindahan', 'PemindahanController@store')->name('createpemindahan');
    Route::post('/pemindahan/{id}/update', 'PemindahanController@update');
    Route::post('/pemindahan/{id}/destroy', 'PemindahanController@destroy');

    //Giat Armada
    Route::get('/giat-armada','GiatArmadaController@index');
    Route::post('/creategiatarmada', 'GiatArmadaController@store')->name('creategiatarmada');
    Route::post('/giat-armada/{id}/update', 'GiatArmadaController@update');
    Route::post('/giat-armada/{id}/destroy', 'GiatArmadaController@destroy');

    //Barang
    Route::get('/barang','BarangController@index');
    Route::post('/createbarang', 'BarangController@store')->name('createbarang');
    Route::post('/barang/{id}/update', 'BarangController@update');
    Route::post('/barang/{id}/destroy', 'BarangController@destroy');

    //Inventaris
    Route::get('/inventaris','InventarisController@index');
    Route::post('/createinventaris', 'InventarisController@store')->name('createinventaris');
    Route::post('/inventaris/{id}/update', 'InventarisController@update');
    Route::post('/inventaris/{id}/destroy', 'InventarisController@destroy');

    //Rekap Tugas
    Route::get('/rekap-tugas','RekapTugasController@index');
    Route::post('/createrekaptugas', 'RekapTugasController@store')->name('createrekaptugas');
    Route::post('/rekap-tugas/{id}/update', 'RekapTugasController@update');
    Route::post('/rekap-tugas/{id}/destroy', 'RekapTugasController@destroy');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
