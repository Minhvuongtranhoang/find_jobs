<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean'
    ];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_categories');
    }

}
