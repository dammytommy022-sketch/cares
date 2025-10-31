<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formbc extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_no',
        'hca_name',
        'date_log',
        'time_log',
        'type',
        'info'
    ];
}
