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

Route::get("login", "Auth\LoginController@showLoginForm");
Route::post("login", "Auth\LoginController@login")->name("login");

Route::get("/", "umumC@index");
Route::get("/mading/{idkonten}/baca", "umumC@baca")->name("baca.konten");

Route::middleware(['auth'])->group(function () {
    //logout
    Route::post("logout", "Auth\LoginController@logout")->name("logout");
    //profil
    Route::get('profil', "profilC@index");
    Route::post('profil/ubahnama', "profilC@ubahnama")->name("ubah.nama");
    Route::post('profil/ubahpassword', "profilC@ubahpassword")->name("ubah.password");
    Route::post('profil/ubahgambar', "profilC@ubahgambar")->name("ubah.gambar");


    //pengguna
    Route::resource("pengguna", "penggunaC");
    Route::post("reset/pengguna", "penggunaC@reset")->name("pengguna.reset");

    //konten
    Route::resource("konten", "kontenC");
    Route::post("ckeditor/upload", "kontenC@upload")->name("ckeditor.upload");


    //pengaturan
    Route::resource('pengaturan', 'pengaturanC');



});

// Route::get('/', function(){
//     return view('pages.pengguna.pengguna');
// });

// Route::get('pdf', 'startController@pdf');

Route::get('siswa/export/', 'startController@export');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
