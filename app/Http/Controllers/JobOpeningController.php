<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOpening;

class JobOpeningController extends Controller
{
    public function index(){
        $all_job_opening = JobOpening::all();
        return view("edit-hiring-job", compact("all_job_opening"));
    }

    public function addJob(Request $request){
        $new_job = new JobOpening;
        $new_job->job_title = $request->jobTitle;
        $new_job->description = $request->jobDescription;
        $new_job->skill_required = $request->requiredSkills;
        $new_job->save();

        // $updated_job = $new_job;
        // $all_job_opening = JobOpening::all();
        // return view("edit-hiring-job", compact("all_job_opening", "updated_job"));
        return redirect()->route('edit-hiring-job')->with('updated_job_title', $request->jobTitle);
    }

    public function editJob($id){
        $job_for_edit = JobOpening::find($id);
        $all_job_opening = JobOpening::all();
        return view("edit-hiring-job", compact("all_job_opening", "job_for_edit"));
    }

    public function saveEditedJob(Request $request){
        $job = JobOpening::find($request->id);
        $job->job_title = $request->jobTitle;
        $job->description = $request->jobDescription;
        $job->skill_required = $request->requiredSkills;
        $job->save();

        // $updated_job = JobOpening::find($request->id);
        // $all_job_opening = JobOpening::all();
        // return view("edit-hiring-job", compact("all_job_opening", "updated_job"));

        return redirect()->route('edit-hiring-job')->with('updated_job_title', $request->jobTitle);
    }

    public function deleteJob($id){
        $job = JobOpening::findOrFail($id);
        $jobTitle = $job->job_title;
        $job->delete();
        // $all_job_opening = JobOpening::all();
        // return view("edit-hiring-job", compact("all_job_opening"));
        // return redirect()->route('edit-hiring-job');
        return redirect()->route('edit-hiring-job')->with('deleted_job_title', $jobTitle);
    }
}
