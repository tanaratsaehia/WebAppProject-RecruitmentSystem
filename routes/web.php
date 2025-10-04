<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobOpeningController;
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

    Route::get('/home', [HomeController::class,'index'])->name("home");
    Route::get('/edit-hiring-job', [JobOpeningController::class,'index'])->name("edit-hiring-job");
    Route::get('/edit-hiring-job/{id}', [JobOpeningController::class,'editJob'])->name("edit-hiring-job.edit");
    Route::post('/edit-hiring-job', [JobOpeningController::class,'saveEditedJob'])->name("edit-hiring-job.save");
    Route::post('/edit-hiring-job/add', [JobOpeningController::class,'addJob'])->name("edit-hiring-job.add");
    Route::delete('/edit-hiring-job/delete/{id}', [JobOpeningController::class,'deleteJob'])->name("edit-hiring-job.delete");

    Route::get('/home/upload-resume/{id}', function($id){
        return view('upload-resume', compact('id'));
    })->name('home.upload-resume');
});

Route::get('/testing', function () {
    return view('testing');
})->name('testing');