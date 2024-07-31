<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    // Ensure this matches the table name in the migration
    protected $table = 'application';  

    // Add the new fields to the fillable property
    protected $fillable = [
        'job_posting_id',
        'user_id',
        'cover_letter',
        'resume',
        'phone_number',
        'linkedin_profile',
        'additional_info',
    ];

    // Define the relationship with the JobPosting model
    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
