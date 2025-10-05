<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobOpening;

class SearchTag extends Model
{
    use HasFactory;

    public function jobOpening(){
        return $this->belongsToMany(JobOpening::class);
    }
}
