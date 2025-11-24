<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    protected $fillable = ['house_id', 'month', 'year', 'created_by', 'status'];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function cells()
    {
        // ✅ FIX: use 'schedule_id'
        return $this->hasMany(ScheduleCell::class, 'schedule_id');
    }

}
