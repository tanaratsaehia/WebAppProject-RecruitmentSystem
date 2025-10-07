<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobOpening;
use App\Models\UploadedResume;
use App\Models\User;

class SearchTag extends Model
{
    use HasFactory;

    public function jobOpening(){
        return $this->belongsToMany(JobOpening::class);
    }

    public function uploadedResume(){
        return $this->belongsToMany(UploadedResume::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
