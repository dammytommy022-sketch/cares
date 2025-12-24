<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $fillable = [
        'resident_id',
        'recorded_at',
        'weight',
        'unit',
        'employee_id',
        'notes',
    ];
}



