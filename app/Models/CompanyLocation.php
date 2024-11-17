<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyLocation extends Model
{
    protected $fillable = [
        'company_id',
        'house_number',
        'street',
        'ward',
        'district',
        'city',
        'google_maps_link'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'location_id');
    }
}

