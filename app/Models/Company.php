<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'website',
        'email',
        'phone',
        'description',
        'industry',
        'employee_count',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean'
    ];

    public function locations()
    {
        return $this->hasMany(CompanyLocation::class);
    }

    public function recruiters()
    {
        return $this->hasMany(Recruiter::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reported');
    }
}
