<?php

namespace App\Http\Controllers;
use App\Models\JobOpening;

use Illuminate\Http\Request;

class ResumeViewerController extends Controller
{
    public function index(){
        // return view('resume-viewer');
        return redirect()->route('resume-viewer.unread'); 
    }

    public function unread(){
        $all_job_opening = JobOpening::all();
        return view("unread-resume", compact("all_job_opening"));
    }

    public function marked(){
        return view('marked-resume');
    }

    public function processing(){
        return view('processing-resume');
    }

    public function replied(){
        return view('replied-resume');
    }
}
