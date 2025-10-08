<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UploadedResume;
use Illuminate\Support\Facades\Storage;

class UploadedResumeSeeder extends Seeder
{
    public function run(): void
    {
        $disk = 'private';
        $fileData = [
            [
                'user_id' => 3, 'apply_infomation_id' => 1, 'job_opening_id' => 1,
                'resume_file_name' => 'example_filename.pdf',
                'resume_path' => 'resumes/example_filename.pdf',
            ],
            [
                'user_id' => 4, 'apply_infomation_id' => 2, 'job_opening_id' => 1,
                'resume_file_name' => 'example_2_filename.pdf',
                'resume_path' => 'resumes/example_2_filename.pdf',
            ],
            [
                'user_id' => 5, 'apply_infomation_id' => 3, 'job_opening_id' => 1,
                'resume_file_name' => 'example_3_filename.pdf',
                'resume_path' => 'resumes/example_3_filename.pdf',
            ],
            [
                'user_id' => 6, 'apply_infomation_id' => 4, 'job_opening_id' => 1,
                'resume_file_name' => 'example_4_filename.pdf',
                'resume_path' => 'resumes/example_4_filename.pdf',
            ],
            [
                'user_id' => 7, 'apply_infomation_id' => 5, 'job_opening_id' => 2,
                'resume_file_name' => 'example_5_filename.pdf',
                'resume_path' => 'resumes/example_5_filename.pdf',
            ],
        ];

        foreach ($fileData as $data) {
            $filePath = $data['resume_path'];
            if (Storage::disk($disk)->exists($filePath)) {
                $fileSize = Storage::disk($disk)->size($filePath);
            } else {
                $fileSize = 0; 
                $this->command->warn("File not found for path: $filePath on disk '$disk'. Size set to 0.");
            }

            UploadedResume::create([
                'user_id' => $data['user_id'],
                'apply_infomation_id' => $data['apply_infomation_id'],
                'job_opening_id' => $data['job_opening_id'],
                'resume_file_name' => $data['resume_file_name'],
                'resume_path' => $filePath,
                'resume_size' => $fileSize,
            ]);
        }
    }
}