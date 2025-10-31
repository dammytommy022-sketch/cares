<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formmbc extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_no',
        'hca_name',
        'date_log',
        'time_log',
        'mood',
    ];
}
