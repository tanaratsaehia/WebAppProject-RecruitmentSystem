<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SearchTag;
use App\Models\UploadedResume;

class JobOpening extends Model
{
    use HasFactory;

    public function searchTags(){
        return $this->belongsToMany(SearchTag::class);
    }

    public function uploadedResume(){
        return $this->hasMany(UploadedResume::class);
    }
}
