<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// session_start();

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', function(){
        return view('home');
    })->name("home");

    Route::get('/home/upload-resume/{id}', function($id){
        return view('upload-resume', compact('id'));
    })->name('home.upload-resume');

    Route::get('/edit-hiring-job', function () {
        return view('edit-hiring-job');
    })->name('edit-hiring-job');
});

Route::get('/testing', function () {
    return view('testing');
})->name('testing');