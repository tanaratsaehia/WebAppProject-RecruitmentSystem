<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UploadedResume;
use App\Models\JobOpening;
use App\Models\ApplyInfomation;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\SearchTag;
class ResumeUploadController extends Controller
{
    // แสดงฟอร์ม
    public function showUploadForm($id)
    {
        $userId = Auth::id();
        $uploaded = UploadedResume::where('user_id', $userId)
            ->where('job_opening_id', $id)
            ->first();
        $destroy_date = null;
        if ($uploaded) {
            if ($uploaded->resume_status != "accepted"){
                $createdAt = $uploaded->created_at;
                $days_since_upload = $createdAt->diffInDays(Carbon::now());
                $destroy_date = $createdAt->copy()->addDays(180);  // 6 month
                if ($days_since_upload > 180) {
                    $this->destroy($id);
                    return $this->showUploadForm($id);
                }
            }else{
                $destroy_date = "Your application has been accepted.";
            }
        }
        
        $item = JobOpening::where('id',$id)->first();
        $all_skills = SearchTag::all();

        $user_data = User::find($userId);
        $user_selected_skills = $user_data ? $user_data->searchTags: collect();

        $lastInfo = ApplyInfomation::where('user_id',$userId)->orderBy('id','desc')->first();
        return view('upload-resume', [
            'id' => $id,
            'uploaded' => $uploaded,
            'item' => $item,
            'lateInfo' => $lastInfo,
            'all_skills' => $all_skills,
            'user_selected_skills' => $user_selected_skills,
            'destroy_date' => $destroy_date,
        ]);
    }

    // อัปโหลดไฟล์ PDF (Private Disk)
    public function upload(Request $request, $jobOpeningId)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf|max:3072',
            'Email' => [
                'required',
                'email',
                'max:225',
                Rule::unique('users', 'email')->ignore(Auth::id()),
            ],
            'Tel' => [
            'required',
            'string',
            'max:20',
            Rule::unique('users', 'phone_number')->ignore(Auth::id()),
            ],
            'soft_skill' => 'required|string',
            'applying_purpose' => 'required|string',
        ],[
            'Email.unique' => 'This email address is already in use',
            'Tel.unique' => 'This phone number is already in use',
        ]);

        if (!$request->hasFile('resume')) {
            return back()->with('error', 'Please select a file before proceeding with the upload');
        }

        $email = $request->input('Email');
        $tel = $request->input('Tel');
        $file = $request->file('resume');
        $userId = Auth::id();

        $softSkill = $request->input('soft_skill');
        $applyingPurpose = $request->input('applying_purpose');

        $selectedSkillsIds = $request->input('skills',[]);
        $user_data = User::find($userId);

        if ($user_data) {
            $user_data->searchTags()->sync($selectedSkillsIds);
        }

        $user = User::findOrFail($userId);
        $user->email = $email;
        $user->phone_number = $tel;
        $user->save();
        $searchAttributes = [
            'user_id' => $userId,
            'soft_skill' => $softSkill,
            'applying_purpose' => $applyingPurpose,
        ];

        $apply_info = ApplyInfomation::firstOrCreate($searchAttributes);

        /*$uploaded = UploadedResume::where('user_id', $userId)
            ->where('job_opening_id', operator: $jobOpeningId)
            ->first();*/

        // ตั้งชื่อไฟล์ใหม่
        $fileName = $userId . '_' . now()->format('Ymd_His') . '_Resume.' . $file->getClientOriginalExtension();

        // อัปโหลดไฟล์ใหม่ก่อน
        $newPath = $file->storeAs('resumes', $fileName, 'private');

        // บันทึก DB
        $new_resume = UploadedResume::updateOrCreate(
            [
                'user_id' => $userId,
                'job_opening_id' => $jobOpeningId,
                
            ],
            [
                'resume_file_name' => $file->getClientOriginalName(),
                'resume_path' => $newPath,
                'resume_size' => $file->getSize(),
                'apply_infomation_id' => $apply_info->id,
            ]
        );
        if (isset($selectedSkillsIds) && !empty($selectedSkillsIds)) {
            $new_resume->searchTags()->sync($selectedSkillsIds);
        } 
        return back()->with('updated_resume', $file->getClientOriginalName());
    }



    // ลบไฟล์
    public function destroy($jobOpeningId)
    {
        $userId = Auth::id();
        $resume = UploadedResume::where('user_id', $userId)
            ->where('job_opening_id', $jobOpeningId)
            ->first();

        if ($resume) {
            $resumeName = $resume->resume_file_name;

            if ($resume->resume_path && Storage::disk('private')->exists($resume->resume_path)) {
                Storage::disk('private')->delete($resume->resume_path);
            }

            $resume->delete();

            // return back()->with('deleted_resume', $resumeName);
            // return $this->showUploadForm($jobOpeningId); 
        }

        // return back()->with('error', 'ไม่พบไฟล์ที่จะลบ');
        // return $this->showUploadForm($jobOpeningId); 
    }


    // ดาวน์โหลดไฟล์ (private)
    public function download($jobOpeningId)
    {
        $userId = Auth::id();
        $resume = UploadedResume::where('user_id', $userId)
            ->where('job_opening_id', $jobOpeningId)
            ->firstOrFail();

        if (!Storage::disk('private')->exists($resume->resume_path)) {
            return redirect()->back()->with('error', 'ไม่พบไฟล์ในระบบ');
        }

        return Storage::disk('private')->download($resume->resume_path, $resume->resume_file_name);
    }

    public function view($jobOpeningId)
    {
        $userId = Auth::id();
        $resume = UploadedResume::where('user_id', $userId)
            ->where('job_opening_id', $jobOpeningId)
            ->firstOrFail();

    $filePath = $resume->resume_path;

    // เช็กว่ามีไฟล์จริงไหม
    if (!Storage::disk('private')->exists($filePath)) {
        return redirect()->back()->with('error', 'ไม่พบไฟล์ในระบบ');
    }

        // ดึง path จริงใน storage (private)
        $absolutePath = Storage::disk('private')->path($filePath);

        // ส่งไฟล์ออกให้เบราว์เซอร์เปิดดูได้ เช่น PDF
        return response()->file($absolutePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$resume->resume_file_name.'"'
        ]);
    }
    public function viewUser($job_id, $user_id)
    {
        $resume = UploadedResume::where('user_id', $user_id)
            ->where('job_opening_id', $job_id)
            ->firstOrFail();

        $filePath = $resume->resume_path;
        // dd(["file_path" => $filePath,
        //     "disk_path" => Storage::disk('private')->path($filePath),
        //     "is_path_exist" => Storage::disk('private')->exists($filePath)
        // ]);

        // เช็กว่ามีไฟล์จริงไหม
        if (!Storage::disk('private')->exists($filePath)) {
            return back()->with('error', 'ไม่พบไฟล์ในระบบ');
        }

        // ดึง path จริงใน storage (private)
        $absolutePath = Storage::disk('private')->path($filePath);

        // ส่งไฟล์ออกให้เบราว์เซอร์เปิดดูได้ เช่น PDF
        return response()->file($absolutePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$resume->resume_file_name.'"'
        ]);
    }

}
