<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SearchTag;
use App\Models\UploadedResume;

class JobOpening extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function searchTags(){
        return $this->belongsToMany(SearchTag::class);
    }

    public function uploadedResume(){
        return $this->hasMany(UploadedResume::class);
    }
}
