<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyCareRecord extends Model
{
    protected $fillable = [
        'resident_id',
        'employee_id',
        'staff_initials',
        'date',
        'task_type',
        'completed',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'completed' => 'boolean',
    ];

    /* =========================
       Relationships (Optional)
    ========================== */

    public function resident()
    {
        return $this->belongsTo(Patient::class, 'resident_id', 'resident_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'employee_id', 'employee_id');
    }
}
