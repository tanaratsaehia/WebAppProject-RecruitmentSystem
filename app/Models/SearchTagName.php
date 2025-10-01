<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SearchTag;

class SearchTagName extends Model
{
    use HasFactory;

    public function searchTag(){
        return $this->hasMany(SearchTag::class);
    }
}
