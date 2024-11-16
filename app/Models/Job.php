<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'location_id', 'title', 'description', 'requirements', 'benefits', 'working_hours', 'salary', 'deadline', 'status', 'is_featured'];

    protected $casts = [
        'deadline' => 'date',
        'is_featured' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function location()
    {
        return $this->belongsTo(CompanyLocation::class, 'location_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'job_categories');
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class, 'job_id');
    }

    public function isFavoritedByUser()
    {
        return $this->savedJobs()->where('user_id', auth()->id())->exists();
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    // Thêm relationship với reports
    public function reports()
    {
        return $this->morphMany(Report::class, 'reported');
    }
}
