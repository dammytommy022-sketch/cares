<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'basic_info',
        'guardian_info',
        'placement_info',
        'medical_info',
        'education_info',
        'behaviour_info',
        'social_family_info',
        'legal_safeguarding_info',
        'daily_living_info',
        'documents',
    ];

    protected $casts = [
        'basic_info'               => 'array',
        'guardian_info'            => 'array',
        'placement_info'           => 'array',
        'medical_info'             => 'array',
        'education_info'           => 'array',
        'behaviour_info'           => 'array',
        'social_family_info'       => 'array',
        'legal_safeguarding_info'  => 'array',
        'daily_living_info'        => 'array',
        'documents'                => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors for convenience (optional)
    |--------------------------------------------------------------------------
    |
    | These allow you to access fields neatly, for example:
    | $resident->full_name
    | $resident->guardian_phone
    |
    */

    public function getFullNameAttribute()
    {
        return $this->basic_info['full_name'] ?? null;
    }

    public function getPreferredNameAttribute()
    {
        return $this->basic_info['preferred_name'] ?? null;
    }

    public function getGuardianPhoneAttribute()
    {
        return $this->guardian_info['phone'] ?? null;
    }

    public function getPlacementStartDateAttribute()
    {
        return $this->placement_info['placement_start_date'] ?? null;
    }

    public function getPrimaryDiagnosisAttribute()
    {
        return $this->medical_info['current_diagnoses'][0] ?? null;
    }
}
