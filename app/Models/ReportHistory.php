<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportHistory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'report_id',
        'admin_id',
        'action',
        'note'
    ];

    // Relationship với report
    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    // Relationship với admin
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
