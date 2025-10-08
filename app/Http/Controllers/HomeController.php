<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOpening;
use App\Models\UploadedResume;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $all_job_opening = JobOpening::all();
        return view("home", compact("all_job_opening"));
    }

    public function indexWithOutLogin() {
        $all_job_opening = JobOpening::all();
        if (Auth::check()) {
            return redirect()->route("home", compact("all_job_opening"));
        }
        return view('home-with-out-login', compact("all_job_opening"));
    }

    public function Applied_Status(){
        $userId = Auth::id();
        $all_resume = UploadedResume::where('user_id', $userId)->get();
        return view('applied-status',compact('all_resume'));
    }
}
