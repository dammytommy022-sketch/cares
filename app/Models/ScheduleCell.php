<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleCell extends Model
{
    protected $fillable = [
        'schedule_id',
        'personnel_id',
        'date',
        'day_name',
        'shift_type',
        'hours',
        'is_overtime',
    ];

    public function schedule()
    {
        // ✅ FIX: use 'schedule_id' (singular)
        return $this->belongsTo(Schedules::class, 'schedule_id');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }
}
