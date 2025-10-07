<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UploadedResume;

class UploadedResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UploadedResume::create([
            'user_id' => 3,
            'apply_infomation_id' => 1,
            'job_opening_id' => 1,
            'resume_file_name' => 'example_filename.pdf',
            'resume_path' => 'resumes/example_filename.pdf',
        ]);
        UploadedResume::create([
            'user_id' => 4,
            'apply_infomation_id' => 2,
            'job_opening_id' => 1,
            'resume_file_name' => 'example_2_filename.pdf',
            'resume_path' => 'resumes/example_2_filename.pdf',
        ]);
        UploadedResume::create([
            'user_id' => 5,
            'apply_infomation_id' => 3,
            'job_opening_id' => 1,
            'resume_file_name' => 'example_3_filename.pdf',
            'resume_path' => 'resumes/example_3_filename.pdf',
        ]);
        UploadedResume::create([
            'user_id' => 6,
            'apply_infomation_id' => 4,
            'job_opening_id' => 1,
            'resume_file_name' => 'example_4_filename.pdf',
            'resume_path' => 'resumes/example_4_filename.pdf',
            // 'resume_status' => 'processing'
        ]);
        UploadedResume::create([
            'user_id' => 7,
            'apply_infomation_id' => 5,
            'job_opening_id' => 2,
            'resume_file_name' => 'example_5_filename.pdf',
            'resume_path' => 'resumes/example_5_filename.pdf',
            // 'resume_status' => 'processing'
        ]);
    }
}
