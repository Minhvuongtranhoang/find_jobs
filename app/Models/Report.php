<?php
// app/Models/Report.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    protected $fillable = [
        'reporter_id',
        'reported_type',
        'reported_id',
        'reason',
        'status',
        'admin_note'
    ];

    protected $casts = [
        'status' => 'string' // enum('pending', 'resolved', 'rejected')
    ];

    // Relationship với user (reporter)
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    // Relationship với reported entity (job hoặc company)
    public function reportable()
    {
        return $this->morphTo('reported');
    }

    // Relationship với report history
    public function history(): HasMany
    {
        return $this->hasMany(ReportHistory::class);
    }
}
