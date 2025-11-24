<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $fillable = [
        'fullname', 'role', 'house_id', 'email',
        'hours_type', 'preferred_shift', 'can_do_ot', 'status'
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function scheduleCells()
    {
        return $this->hasMany(ScheduleCell::class);
    }
}
