<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 
        'employee_id', 
        'role',
        'basic_info',
        'employment_details',
        'qualifications_training',
        'compliance_legal',
        'performance_notes',
        'emergency_contact'
    ];

    protected $casts = [
        'basic_info' => 'array',
        'employment_details' => 'array',
        'qualifications_training' => 'array',
        'compliance_legal' => 'array',
        'performance_notes' => 'array',
        'emergency_contact' => 'array',
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

}
