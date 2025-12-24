<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'resident_id',
        'employee_id',
        'date',
        'activity',
        'participation_level',
        'notes'
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }
}

