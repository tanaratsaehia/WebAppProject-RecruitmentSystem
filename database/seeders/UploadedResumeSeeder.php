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
            'ai_results' => [
                'skills' => ['PHP', 'Laravel', 'MySQL', 'Docker', 'Java', 'Spring Boot'],
            ],
        ]);
        UploadedResume::create([
            'user_id' => 4,
            'job_opening_id' => 1,
            'resume_file_name' => 'example_2_filename.pdf',
            'ai_results' => [
                'skills' => ['PHP', 'Laravel', 'MySQL', 'Docker', 'Node.js'],
            ],
        ]);
        UploadedResume::create([
            'user_id' => 5,
            'job_opening_id' => 1,
            'resume_file_name' => 'example_3_filename.pdf',
            'ai_results' => [
                'skills' => ['PHP', 'Laravel', 'MySQL', 'Docker', 'Node.js'],
            ],
        ]);
    }
}
