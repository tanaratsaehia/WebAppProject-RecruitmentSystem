<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SearchTag;
use App\Models\UploadedResume;

class UploadedResumeSearchTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resume1 = UploadedResume::find(1);
        $resume2 = UploadedResume::find(2);
        $resume3 = UploadedResume::find(3);
        $resume4 = UploadedResume::find(4);
        $resume5 = UploadedResume::find(5);
        $tag1 = SearchTag::where('name', 'Java')->first();
        $tag2 = SearchTag::where('name', 'Spring Boot')->first();
        $tag3 = SearchTag::where('name', 'Firebase')->first();
        $tag4 = SearchTag::where('name', 'CSS')->first();
        $tag5 = SearchTag::where('name', 'Laravel')->first();
        $tag6 = SearchTag::where('name', 'Git')->first();
        $tag7 = SearchTag::where('name', 'JavaScript')->first();

        if ($resume1 && $tag1 && $tag2 && $tag5) {
            $resume1->searchTags()->attach([
                $tag1->id,
                $tag2->id,
                $tag5->id,
            ]);
        }
        if ($resume2 && $tag1 && $tag3 && $tag4 && $tag7 && $tag5) {
            $resume2->searchTags()->attach([
                $tag3->id,
                $tag4->id,
                $tag7->id,
                $tag1->id,
                $tag5->id,
            ]);
        }
        if ($resume3 && $tag1 && $tag2 && $tag5 && $tag6) {
            $resume3->searchTags()->attach([
                $tag5->id,
                $tag2->id,
                $tag6->id,
                $tag1->id,
            ]);
        }
        if ($resume4 && $tag4 && $tag6 && $tag5 && $tag7) {
            $resume4->searchTags()->attach([
                $tag4->id,
                $tag5->id,
                $tag6->id,
                $tag7->id,
            ]);
        }
        if ($resume5 && $tag4 && $tag6 && $tag5 && $tag7) {
            $resume5->searchTags()->attach([
                $tag4->id,
                $tag5->id,
                $tag6->id,
                $tag7->id,
            ]);
        }
    }
}
