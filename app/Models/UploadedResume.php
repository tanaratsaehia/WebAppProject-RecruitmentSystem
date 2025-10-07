<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobOpening;
use App\Models\User;
use App\Models\SearchTag;
use App\Models\ApplyInfomation;

class UploadedResume extends Model
{
    use HasFactory;
    protected $casts = [
        'ai_results' => 'array',
    ];
    protected $fillable = [
        'user_id',
        'job_opening_id',
        'resume_file_name',
        'resume_path',
        'resume_size',
        'resume_status',
        'apply_infomation_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function jobOpening(){
        return $this->belongsTo(JobOpening::class);
    }

    public function searchTags(){
        return $this->belongsToMany(SearchTag::class);
    }

    public function applyInfomation(){
        return $this->belongsTo(ApplyInfomation::class);
    }
}
