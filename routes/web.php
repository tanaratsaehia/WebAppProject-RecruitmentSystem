<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobOpeningController;
use App\Http\Controllers\ResumeViewerController;
use App\Http\Controllers\ResumeUploadController;
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

/*Route::get('/', function () {
    return view('welcome');
    //return redirect()->route(route: 'home'); 
    //return view('home-with-out-login');
})->name('welcome');*/

Route::get('/',[HomeController::class,'indexWithOutLogin'])->name('welcome');

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

    Route::middleware(['role:user'])->group(function (){
        // upload
        Route::get('/home/upload-resume/{id}', [ResumeUploadController::class, 'showUploadForm'])->name('home.upload-resume.form');
        Route::post('/home/upload-resume/{id}', [ResumeUploadController::class, 'upload'])->name('home.upload-resume.upload');
        Route::delete('/home/upload-resume/{id}', [ResumeUploadController::class, 'destroy'])->name('home.upload-resume.delete');
        Route::get('/home/upload-resume/{id}/download',[ResumeUploadController::class, 'download'])->name('home.upload-resume.download');
    });
});

Route::get('/testing', function () {
    return view('testing');
})->name('testing');