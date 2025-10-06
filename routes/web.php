<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobOpeningController;
use App\Http\Controllers\ResumeViewerController;
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
    // return view('welcome');
    return redirect()->route('home'); 
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // return view('dashboard'); 
        return redirect()->route('home'); 
    })->name('dashboard');
    // home
    Route::get('/home', [HomeController::class,'index'])->name("home");

    Route::middleware(['role:hr-superHR'])->group(function () {
        // edit hiring job
        Route::get('/edit-hiring-job', [JobOpeningController::class,'index'])->name("edit-hiring-job");
        Route::get('/edit-hiring-job/{id}', [JobOpeningController::class,'editJob'])->name("edit-hiring-job.edit");
        Route::post('/edit-hiring-job', [JobOpeningController::class,'saveEditedJob'])->name("edit-hiring-job.save");
        Route::post('/edit-hiring-job/add', [JobOpeningController::class,'addJob'])->name("edit-hiring-job.add");
        Route::post('/edit-hiring-job/delete/{id}', [JobOpeningController::class,'deleteJob'])->name("edit-hiring-job.delete");
        
        // resume viewer
        Route::get('/resume-viewer', [ResumeViewerController::class,'index'])->name("resume-viewer");
        Route::get('/resume-viewer/unread/{id?}', [ResumeViewerController::class, 'unread'])->name("resume-viewer.unread");
        Route::post('/resume-viewer/unread/{id?}', [ResumeViewerController::class, 'unread'])->name("resume-viewer.unread");
        Route::post('/resume/{resume}/status', [ResumeViewerController::class, 'updateStatus'])->name("resume-viewer.update-status");
        Route::get('/resume-viewer/marked/{id?}', [ResumeViewerController::class,'marked'])->name("resume-viewer.marked");
        Route::get('/resume-viewer/processing', [ResumeViewerController::class,'processing'])->name("resume-viewer.processing");
        Route::get('/resume-viewer/replied', [ResumeViewerController::class,'replied'])->name("resume-viewer.replied");
    });

    // upload
    Route::get('/home/upload-resume/{id}', function($id){
        return view('upload-resume', compact('id'));
    })->name('home.upload-resume');
});

Route::get('/testing', function () {
    return view('testing');
})->name('testing');