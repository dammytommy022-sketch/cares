<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'resident_id',
        'employee_id',
        'date',
        'meal',
        'portion',
        'fluids',
        'notes'
    ];
}


