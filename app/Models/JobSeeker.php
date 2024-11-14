<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'avatar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// app/Models/Company.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'website',
        'email',
        'phone',
        'description',
        'industry',
        'employee_count'
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
}
