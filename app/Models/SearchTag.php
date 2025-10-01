<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SearchTagName;
use App\Models\JobOpening;

class SearchTag extends Model
{
    use HasFactory;

    public function searchTagName(){
        return $this->belongsTo(SearchTagName::class);
    }

    public function jobOpening(){
        return $this->belongsTo(JobOpening::class);
    }
}
