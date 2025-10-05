<?php

namespace App\Http\Controllers;
use App\Models\JobOpening;
use App\Models\UploadedResume;

use Illuminate\Http\Request;

class ResumeViewerController extends Controller
{
    public function index(){
        // return view('resume-viewer');
        return redirect()->route('resume-viewer.unread'); 
    }

    public function unread($id = null){
        $all_job_opening = JobOpening::all();
        $query = UploadedResume::query();
        $selected_job_id = null;

        if ($id !== null) {
            $selected_job_id = (string) $id;
        } elseif ($first_job = $all_job_opening->first()) {
            $selected_job_id = (string) $first_job->id;
        }
        $query->where('job_opening_id', $selected_job_id);
        $filtered_resume = $query->get();
        
        return view("unread-resume", compact("all_job_opening", "selected_job_id", "filtered_resume"));
    }

    public function marked($id = null){
        // return view('marked-resume');
        $all_job_opening = JobOpening::all();
        $selected_job_id = null;

        if ($id !== null) {
            $selected_job_id = (string) $id;
        } elseif ($first_job = $all_job_opening->first()) {
            $selected_job_id = (string) $first_job->id;
        }
        
        // Note: You would query the resumes for the $selected_job_id here.
        
        return view("marked-resume", compact("all_job_opening", "selected_job_id"));
    }

    public function processing(){
        return view('processing-resume');
    }

    public function replied(){
        return view('replied-resume');
    }
}
