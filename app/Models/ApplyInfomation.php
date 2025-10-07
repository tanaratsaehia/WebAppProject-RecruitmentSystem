<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UploadedResume;

class ApplyInfomation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'soft_skill',
        'applying_purpose'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
