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
            'job_opening_id' => 1,
            'resume_file_name' => 'example_filename.pdf',
            'resume_status' => 'unread'
        ]);
        UploadedResume::create([
            'user_id' => 4,
            'job_opening_id' => 1,
            'resume_file_name' => 'example_2_filename.pdf',
            'resume_status' => 'unread'
        ]);
    }
}
