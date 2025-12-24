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

    // 👇 THIS IS THE KEY FIX
    public function getRouteKeyName()
    {
        return 'resident_id';
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'resident_id', 'resident_id');
    }

    public function meals()
    {
        return $this->hasMany(Meal::class, 'resident_id', 'resident_id');
    }
    public function weights()
    {
        return $this->hasMany(Weight::class, 'resident_id', 'resident_id');
    }

    public function riskAssessments()
    {
        return $this->hasMany(RiskAssessment::class, 'resident_id', 'resident_id');
    }

    public function woundRecords()
    {
        return $this->hasMany(WoundRecord::class, 'resident_id', 'resident_id');
    }

    public function behaviourIncidents()
    {
        return $this->hasMany(BehaviourIncident::class, 'resident_id', 'resident_id');
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class, 'resident_id', 'resident_id');
    }

    public function restraints()
    {
        return $this->hasMany(RestraintRecord::class, 'resident_id', 'resident_id');
    }

}
