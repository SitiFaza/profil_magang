<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesertaMagangController;



Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/peserta-magang', [PesertaMagangController::class, 'lihatPesertaMagang'])->name('peserta-magang.index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
