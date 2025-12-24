<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestraintRecord extends Model
{
    protected $fillable = [
        'resident_id',
        'employee_id',
        'incident_datetime',
        'record_type',
        'trigger',
        'restraint_method',
        'severity',
        'duration_minutes',
        'intervention_details',
        'outcome',
        'injury_occurred',
        'reported',
    ];

    protected $casts = [
        'incident_datetime' => 'datetime',
        'injury_occurred' => 'boolean',
        'reported' => 'boolean',
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
