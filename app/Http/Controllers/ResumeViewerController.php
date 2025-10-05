<?php

namespace App\Http\Controllers;
use App\Models\JobOpening;
use App\Models\UploadedResume;
use App\Models\SearchTag;

use Illuminate\Http\Request;

class ResumeViewerController extends Controller
{
    public function index(){
        // return view('resume-viewer');
        return redirect()->route('resume-viewer.unread'); 
    }

    public function unread(Request $request, $id = null)
    {
        $all_job_opening = JobOpening::all();
        $all_skills = SearchTag::all();
        $selected_job_id = null;
        if ($id !== null) {
            $selected_job_id = $id;
        } elseif ($first_job = $all_job_opening->first()) {
            $selected_job_id = (string) $first_job->id;
        }
        if ($request->isMethod('post')) {
            $selectedSkills = $request->input('skills', []);
            $jobToUpdate = JobOpening::find($selected_job_id);
            if ($jobToUpdate) {
                $jobToUpdate->searchTags()->sync($selectedSkills);
            }
            return redirect()->route('resume-viewer.unread', ['id' => $selected_job_id]);
        }

        $selected_job = JobOpening::find($selected_job_id);
        $job_skills = $selected_job ? $selected_job->searchTags : collect();

        $query = UploadedResume::query();
        $query->where('job_opening_id', $selected_job_id);
        // filter resumes by skills add that logic here
        $filtered_resume = $query->get();
        
        return view("unread-resume", compact(
            "all_job_opening", 
            "selected_job_id", 
            "filtered_resume", 
            "all_skills",
            "job_skills"
        ));
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
