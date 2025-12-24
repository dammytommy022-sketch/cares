<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WoundRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'date',
        'wound_type',
        'location',
        'dressing',
        'notes',
        'staff_initials',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
