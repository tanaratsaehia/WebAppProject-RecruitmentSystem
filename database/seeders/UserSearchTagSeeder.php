<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SearchTag;

class UserSearchTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);
        $user4 = User::find(4);
        $user5 = User::find(5);
        $tag1 = SearchTag::where('name', 'Java')->first();
        $tag2 = SearchTag::where('name', 'Spring Boot')->first();
        $tag3 = SearchTag::where('name', 'Firebase')->first();
        $tag4 = SearchTag::where('name', 'CSS')->first();
        $tag5 = SearchTag::where('name', 'Laravel')->first();
        $tag6 = SearchTag::where('name', 'Git')->first();
        $tag7 = SearchTag::where('name', 'JavaScript')->first();

        if ($user1 && $tag1 && $tag2 && $tag5) {
            $user1->searchTags()->attach([
                $tag1->id,
                $tag2->id,
                $tag5->id,
            ]);
        }
        if ($user2 && $tag1 && $tag3 && $tag4 && $tag7 && $tag5) {
            $user2->searchTags()->attach([
                $tag3->id,
                $tag4->id,
                $tag7->id,
                $tag1->id,
                $tag5->id,
            ]);
        }
        if ($user3 && $tag1 && $tag2 && $tag5 && $tag6) {
            $user3->searchTags()->attach([
                $tag5->id,
                $tag2->id,
                $tag6->id,
                $tag1->id,
            ]);
        }
        if ($user4 && $tag4 && $tag6 && $tag5 && $tag7) {
            $user4->searchTags()->attach([
                $tag4->id,
                $tag5->id,
                $tag6->id,
                $tag7->id,
            ]);
        }
        if ($user5 && $tag4 && $tag6 && $tag5 && $tag7) {
            $user5->searchTags()->attach([
                $tag4->id,
                $tag5->id,
                $tag6->id,
                $tag7->id,
            ]);
        }
    }
}
