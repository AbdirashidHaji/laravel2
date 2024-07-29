<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'salary',
        'image',
        'user_id'
    ];

    // Define relationship with User (Admin who posted the job)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with applications if needed
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
