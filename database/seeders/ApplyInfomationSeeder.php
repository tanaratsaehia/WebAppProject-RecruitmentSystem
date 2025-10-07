<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ApplyInfomation;

class ApplyInfomationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApplyInfomation::create([
            'user_id' => 3,
            'soft_skill' => 'Teamwork, Communication',
            'applying_purpose' => 'I want to contribute to innovative projects and grow my skills in a collaborative environment.'
        ]);

        ApplyInfomation::create([
            'user_id' => 4,
            'soft_skill' => 'Problem-Solving, Critical Thinking',
            'applying_purpose' => 'I aim to apply my analytical skills to solve real-world challenges and advance in my career.'
        ]);

        ApplyInfomation::create([
            'user_id' => 5,
            'soft_skill' => 'Leadership, Adaptability',
            'applying_purpose' => 'I am seeking opportunities to lead and learn while delivering impactful solutions to clients.'
        ]);

        ApplyInfomation::create([
            'user_id' => 6,
            'soft_skill' => 'Creativity, Collaboration',
            'applying_purpose' => 'I wish to join a dynamic team where I can innovate and grow as a creative professional.'
        ]);

        ApplyInfomation::create([
            'user_id' => 7,
            'soft_skill' => 'Time Management, Emotional Intelligence',
            'applying_purpose' => 'My goal is to build a career where I can continuously improve and deliver value through effective teamwork.'
        ]);

        ApplyInfomation::create([
            'user_id' => 8,
            'soft_skill' => 'Time Management, Public Speaking',
            'applying_purpose' => 'Looking for an internship opportunity to apply academic knowledge in a real-world environment and grow professionally.'
        ]);
    }
}
