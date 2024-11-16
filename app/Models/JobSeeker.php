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


