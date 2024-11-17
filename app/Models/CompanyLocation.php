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

    /**
     * Relationship: A location belongs to a company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relationship: A location may have many jobs.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class, 'location_id');
    }
    public function getFullAddressAttribute()
{
    return "{$this->house_number}, {$this->street}, {$this->ward}, {$this->district}, {$this->city}";
}

}
