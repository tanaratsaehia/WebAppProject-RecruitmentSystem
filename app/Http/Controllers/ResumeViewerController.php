<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResumeViewerController extends Controller
{
    public function index(){
        // return view('resume-viewer');
        return redirect()->route('resume-viewer.unread'); 
    }

    public function unread(){
        return view('unread-resume');
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
