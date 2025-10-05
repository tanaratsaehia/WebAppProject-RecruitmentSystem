<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobOpening;
use App\Models\User;

class UploadedResume extends Model
{
    use HasFactory;
    protected $casts = [
        'ai_results' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function jobOpening(){
        return $this->belongsTo(JobOpening::class);
    }
}
