<?php

namespace App\Http\Controllers;
use App\Models\JobOpening;
use App\Models\UploadedResume;
use App\Models\SearchTag;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ResumeViewerController extends Controller
{
    public function index(){
        // return view('resume-viewer');
        return redirect()->route('resume-viewer.unread'); 
    }

    public function unread(Request $request, $id = null){
        $all_job_opening = JobOpening::all();
        $all_skills = SearchTag::all();
        $selected_job_id = null;
        $selectedSkillsForFiltering = [];

        if ($id !== null) {
            $selected_job_id = $id;
        } elseif ($first_job = $all_job_opening->first()) {
            $selected_job_id = (string) $first_job->id;
        }

        if ($request->isMethod('post')) {
            $selectedSkillsIds = $request->input('skills', []);
            
            $jobToUpdate = JobOpening::find($selected_job_id);

            if ($jobToUpdate) {
                $jobToUpdate->searchTags()->sync($selectedSkillsIds);
            }
            // return redirect()->route('resume-viewer.unread', ['id' => $selected_job_id]);
        }

        $selected_job = JobOpening::find($selected_job_id);
        $job_skills = $selected_job ? $selected_job->searchTags : collect();
        $selectedSkillNames = $job_skills->pluck('name')->toArray();

        $query = UploadedResume::query()
            ->where('job_opening_id', $selected_job_id)
            ->whereIn('resume_status', ['unread', 'marked']);
        
        if (!empty($selectedSkillNames)) {
            $query->whereJsonContains('ai_results->skills', $selectedSkillNames[0]);
        }
        $filtered_resume = $query->get();

        if (!empty($selectedSkillNames)) {
            $filtered_resume = $this->scoreAndSortResumes(
                $filtered_resume, 
                $selectedSkillNames
            );
        }
        return view("unread-resume", compact(
            "all_job_opening", 
            "selected_job_id", 
            "filtered_resume", 
            "all_skills",
            "job_skills"
        ));
    }

    protected function scoreAndSortResumes(Collection $resumes, array $requiredSkills): Collection {
        $requiredSkills = array_map('strtolower', $requiredSkills);
        $resumesWithScore = $resumes->map(function ($resume) use ($requiredSkills) {
            $resumeSkills = array_map('strtolower', $resume->ai_results['skills'] ?? []);
            $matches = array_intersect($resumeSkills, $requiredSkills);
            $score = count($matches);
            $resume->score = $score;
            $resume->matched_skills = $matches; 
            return $resume;
        })
        ->filter(function ($resume) {
            return $resume->score > 0;
        })
        ->sortByDesc('score')
        ->values();
        return $resumesWithScore;
    }

    public function updateStatus(Request $request, UploadedResume $resume){
        $action = $request->input('status_action');
        $newStatus = $resume->resume_status;
        $message = '';

        switch ($action) {
            case 'accept':
                $newStatus = 'accepted';
                $message = 'เรซูเม่ถูกยอมรับแล้ว!';
                break;
            case 'reject':
                $newStatus = 'rejected';
                $message = 'เรซูเม่ถูกปฏิเสธแล้ว!';
                break;
            case 'mark':
                $newStatus = ($resume->resume_status === 'marked') ? 'unread' : 'marked'; // <<<----- for db use
                $displayStatus = ($resume->resume_status === 'marked') ? 'unmark' : 'marked';
                $message = "สถานะมาร์คถูกสลับเป็น " . $displayStatus; // <<<------- for user understanding
                break;
            default:
                $message = 'wrong action';
                return back()->with('error', $message);
        }

        if ($resume->resume_status !== $newStatus) {
            $resume->update(['resume_status' => $newStatus]);
            return back()->with('success', $message);
        }

        return back()->with('info', "เรซูเม่ถูกตั้งค่าสถานะเป็น " . $newStatus . " อยู่แล้ว");
    }

    public function marked($id = null){
        $all_job_opening = JobOpening::all();
        $selected_job_id = null;

        if ($id !== null) {
            $selected_job_id = (string) $id;
        } elseif ($first_job = $all_job_opening->first()) {
            $selected_job_id = (string) $first_job->id;
        }
        $query = UploadedResume::query()
            ->where('job_opening_id', $selected_job_id)
            ->where('resume_status', 'marked');
        $filtered_resume = $query->get();
        
        return view("marked-resume", compact("all_job_opening", "selected_job_id", "filtered_resume"));
    }

    public function processing(){
        return view('processing-resume');
    }

    // public function replied(){
    //     return view('replied-resume');
    // }
    public function replied($id = null){
        $all_job_opening = JobOpening::all();
        $selected_job_id = null;

        if ($id !== null) {
            $selected_job_id = (string) $id;
        } elseif ($first_job = $all_job_opening->first()) {
            $selected_job_id = (string) $first_job->id;
        }
        $query = UploadedResume::query()
            ->where('job_opening_id', $selected_job_id)
            ->whereIn('resume_status', ['accepted', 'rejected']);
        $filtered_resume = $query->get();
        
        return view("replied-resume", compact("all_job_opening", "selected_job_id", "filtered_resume"));
    }
}
