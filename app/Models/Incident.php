<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = [
        'resident_id',
        'employee_id',
        'incident_date',
        'incident_type',
        'location',
        'description',
        'action_taken',
        'status',
        'reported_to_manager',
        'safeguarding_required',
    ];

    protected $casts = [
        'incident_date' => 'date',
        'reported_to_manager' => 'boolean',
        'safeguarding_required' => 'boolean',
    ];

    public function resident()
    {
        return $this->belongsTo(
            Patient::class,
            'resident_id',
            'resident_id'
        );
    }

}
