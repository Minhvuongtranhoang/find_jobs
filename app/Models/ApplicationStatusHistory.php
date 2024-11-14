<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatusHistory extends Model
{
    protected $table = 'application_status_history';
    protected $fillable = [
        'application_id',
        'status',
        'note'
    ];

    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class, 'application_id');
    }
}
