<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehaviourIncident extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'date',
        'incident_type',
        'description',
        'action_taken',
        'staff_initials',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
