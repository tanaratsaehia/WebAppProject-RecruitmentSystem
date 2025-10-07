<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UploadedResume;
use App\Models\JobOpening;
class ResumeUploadController extends Controller
{
    // แสดงฟอร์ม
    public function showUploadForm($id)
    {
        $userId = Auth::id();
        $uploaded = UploadedResume::where('user_id', $userId)
            ->where('job_opening_id', $id)
            ->first();
        $item = JobOpening::where('id',$id)->first();

        return view('upload-resume', [
            'id' => $id,
            'uploaded' => $uploaded,
            'item' => $item
        ]);
    }

    // อัปโหลดไฟล์ PDF (Private Disk)
   public function upload(Request $request, $jobOpeningId)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf|max:3072',
        ]);

        if (!$request->hasFile('resume')) {
            return redirect()->back()->with('error', 'กรุณาเลือกไฟล์ก่อนกดอัปโหลด');
        }

        $file = $request->file('resume');
        $userId = Auth::id();

        /*$uploaded = UploadedResume::where('user_id', $userId)
            ->where('job_opening_id', operator: $jobOpeningId)
            ->first();*/

        // ตั้งชื่อไฟล์ใหม่
        $fileName = $userId . '_' . now()->format('Ymd_His') . '_Resume.' . $file->getClientOriginalExtension();

        // อัปโหลดไฟล์ใหม่ก่อน
        $newPath = $file->storeAs('resumes', $fileName, 'private');

        // บันทึก DB
        UploadedResume::updateOrCreate(
            [
                'user_id' => $userId,
                'job_opening_id' => $jobOpeningId
            ],
            [
                'resume_file_name' => $file->getClientOriginalName(),
                'resume_path' => $newPath,
                'resume_size' => $file->getSize(),
            ]
        );
        return redirect()->back()->with('success', 'Resume uploaded successfully!');
    }



    // ลบไฟล์
    public function destroy($jobOpeningId)
    {
        $userId = Auth::id();
        $resume = UploadedResume::where('user_id', $userId)
            ->where('job_opening_id', $jobOpeningId)
            ->first();

        if ($resume) {
            if ($resume->resume_path && Storage::disk('private')->exists($resume->resume_path)) {
                Storage::disk('private')->delete($resume->resume_path);
            }
            $resume->delete();

            return redirect()->back()->with('success', 'Resume deleted successfully!');
        }

        return redirect()->back()->with('error', 'ไม่พบไฟล์ที่จะลบ');
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
}
