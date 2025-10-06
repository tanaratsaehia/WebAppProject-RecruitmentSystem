<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SearchTag;
use App\Models\JobOpening;

class JobOpeningSearchTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $job1 = JobOpening::where('job_title', 'Senior Backend Java Developer')->first(); // Example Job 1
        // $job2 = JobOpening::where('job_title', 'UX/UI Designer')->first();             // Example Job 2

        $tag1 = SearchTag::where('name', 'Java')->first();
        $tag2 = SearchTag::where('name', 'Spring Boot')->first();
        $tag3 = SearchTag::where('name', 'Firebase')->first();
        $tag4 = SearchTag::where('name', 'CSS')->first();
        $tag5 = SearchTag::where('name', 'Laravel')->first();

        if ($job1 && $tag1 && $tag2 && $tag5) {
            $job1->searchTags()->attach([
                $tag1->id,
                $tag2->id,
                $tag5->id,
            ]);

            // $this->command->info('Tags attached to Job 1.');
        }

        // if ($job2 && $tag3 && $tag4) {
        //     // 3. Attach tags to Job 2
        //     $job2->SearchTag()->attach([
        //         $tag3->id,
        //         $tag4->id,
        //     ]);
            
        //     $this->command->info('Tags attached to Job 2.');
        // }
    }
}
