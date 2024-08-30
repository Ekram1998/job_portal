<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public function job_type(){
        return $this->belongsTo(JobType::class);
    }
    public function categories(){
        return $this->belongsTo(Category::class);
    }
    public function applications(){
        return $this->hasMany(JobApplication::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
