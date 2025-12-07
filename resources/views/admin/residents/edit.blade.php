@extends('admin.layout.header')

@section('content')
<style>

    /* ------------------ ANIMATION: SLIDE + FADE ------------------ */
    .step-panel {
        animation: fadeSlide .35s ease;
    }

    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ------------------ REQUIRED FIELD HIGHLIGHT ------------------ */
    .is-invalid {
        border-color: #dc3545 !important;
        background: #fff5f5 !important;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }


    /* ------------------ BUTTON UPGRADE (Fancy UI) ------------------ */

    .fancy-btn {
        padding: 10px 28px;
        border-radius: 40px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-size: 15px;
        transition: 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.10);
    }

    .fancy-btn-primary {
        background: #15a362;
        color: white;
    }

    .fancy-btn-primary:hover {
        background: #11804e;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(21,163,98,0.35);
    }

    .fancy-btn-secondary {
        background: #e2e8f0;
        color: #1a1a1a;
    }

    .fancy-btn-secondary:hover {
        background: #cbd5e1;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(100,100,100,0.20);
    }

    .fancy-btn-success {
        background: #188f59ff;
        color: white;
    }

    .fancy-btn-success:hover {
        background: #11804e;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(13,110,253,0.35);
    }

    /* Center Step Navigation */
    .wizard-nav {
        display: flex;
        justify-content: center;
        gap: 25px;
        margin-top: 25px;
    }

    

    
    
    /* --- Centered Pills Container --- */
    .wizard-tabs-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 25px;
    }

    .wizard-tabs {
        display: flex;
        gap: 8px;
        background: #ffffff;
        padding: 6px;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    /* --- Tab Button (pill style) --- */
    .wizard-tab-btn {
        padding: 8px 12px;
        border-radius: 40px;
        border: none;
        background: #f1f5f9;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: 0.25s ease;
        font-size: 12px;
    }

    .wizard-tab-btn i {
        font-size: 14px;
        opacity: 0.7;
    }

    /* Active Styling */
    .wizard-tab-btn.active {
        background: #15a362;
        color: #fff;
        box-shadow: 0 4px 12px rgba(13,110,253,0.35);
    }

    .wizard-tab-btn.active i {
        opacity: 1;
        color: #fff;
    }

    /* Hover */
    .wizard-tab-btn:hover {
        background: #e7f0ff;
        transform: translateY(-2px);
    }

    .wizard-tab-btn.active:hover {
        background: #11804eff;
        transform: translateY(-2px);
    }

    @media (max-width: 576px) {
        .wizard-tabs {
            display: flex;
            flex-wrap: wrap; /* allow wrapping */
            gap: 10px;
            background: #ffffff;
            padding: 8px;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            justify-content: center; /* center buttons on each line */
        }

        .wizard-tab-btn {
            flex: 1 1 45%; /* grow, shrink, and take ~45% width on small screens */
            min-width: 120px; /* optional: prevent too small buttons */
        }


        .wizard-tab-btn {
            flex: 0 0 auto; /* keep buttons from shrinking */
        }

    }

    

</style>
<div class="app-content pt-5 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="app-card app-card-basic bg-light">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <i class="fas fa-users" style="font-size: 2em;"></i>
                            </div><!--//icon-holder-->
                            
                        </div><!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">Edit Resident</h4>
                            <small class="text-muted">Manage residents, Update records</small>

                        </div><!--//col-->
                            
                    </div><!--//row-->                    
                    <a href="{{ route('admin.residents.index') }}" class="btn btn-secondary rounded-pill">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>
                
            </div><!--//app-card-header-->
            <div class="app-card-body  px-4  pb-2">
                <div >
                    <div class="tab-pane fade show active" id="all-shift" role="tabpanel" aria-labelledby="all-shift-tab">
                        <div class="app-card app-card-orders-table shadow rounded-4 mb-5">
                            <div class="app-card-body">
                                <div class="app-content pt-5 p-md-3 p-lg-4">
                                <div class="container-xl">
                                    
                                       
                                        {{-- Wizard Tabs --}}
                                        <div class="wizard-tabs-wrapper mb-4">
                                            <div class="wizard-tabs">
                                                <button class="wizard-tab-btn active" data-step="1">
                                                    <i class="fas fa-user"></i> Info
                                                </button>
                                                <button class="wizard-tab-btn" data-step="2">
                                                    <i class="fas fa-users"></i> Guardians
                                                </button>
                                                <button class="wizard-tab-btn" data-step="3">
                                                    <i class="fas fa-home"></i> Placement
                                                </button>
                                                <button class="wizard-tab-btn" data-step="4">
                                                    <i class="fas fa-heartbeat"></i> Medical 
                                                </button>
                                                <button class="wizard-tab-btn" data-step="5">
                                                    <i class="fas fa-school"></i> Education
                                                </button>
                                            
                                                <button class="wizard-tab-btn" data-step="6">
                                                    <i class="fas fa-exclamation-triangle"></i> Risks
                                                </button>
                                                <button class="wizard-tab-btn" data-step="7">
                                                    <i class="fas fa-users-cog"></i>  Family
                                                </button>
                                                <button class="wizard-tab-btn" data-step="8">
                                                    <i class="fas fa-gavel"></i> Legal
                                                </button>
                                                <button class="wizard-tab-btn" data-step="9">
                                                    <i class="fas fa-bed"></i>  Living
                                                </button>
                                    
                                    
                                                <button class="wizard-tab-btn" data-step="10">
                                                    <i class="fas fa-file-upload"></i> Docs
                                                </button>
                                            </div>
                                        </div>


                                        <form method="POST" action="{{ route('admin.residents.update', $resident->id) }}" id="residentForm"  enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div id="wizardPanels" class="p-3">

                                                <!-- STEP 1: Basic Info -->
                                                <div class="wizard-card step-panel" id="step-1">
                                                    <h5 class="fw-bold mb-3">Basic Personal Information</h5>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">Full Name *</label>
                                                            <input type="text" name="basic_info[full_name]" value="{{ $resident->basic_info['full_name'] ?? '' }}" class="form-control required-step-1">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Preferred Name</label>
                                                            <input type="text" name="basic_info[preferred_name]" value="{{ $resident->basic_info['preferred_name'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Date of Birth *</label>
                                                            <input type="date" name="basic_info[dob]" value="{{ $resident->basic_info['dob'] ?? '' }}" class="form-control required-step-1">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Gender *</label>
                                                            <select name="basic_info[gender]" class="form-control required-step-1">
                                                                <option value="">Select gender</option>
                                                                <option value="Male" {{ ($resident->basic_info['gender'] ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                                                <option value="Female" {{ ($resident->basic_info['gender'] ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Nationality</label>
                                                            <input type="text" name="basic_info[nationality]" value="{{ $resident->basic_info['nationality'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Ethnicity / Cultural background</label>
                                                            <input type="text" name="basic_info[ethnicity]" value="{{ $resident->basic_info['ethnicity'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Primary language & communication needs</label>
                                                            <input type="text" name="basic_info[language]" value="{{ $resident->basic_info['language'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Religion (optional)</label>
                                                            <input type="text" name="basic_info[religion]" value="{{ $resident->basic_info['religion'] ?? '' }}" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="wizard-nav text-center mt-3">
                                                        <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="2">
                                                            Next <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- STEP 2: Guardian -->
                                                <div class="wizard-card step-panel d-none" id="step-2">
                                                    <h5 class="fw-bold mb-3">Parent / Guardian / Legal Authority</h5>
                                                    <div class="row">
                                                        <div class="col-md-3 mb-3">
                                                            <label>Name of Parents</label>
                                                            <input type="text" name="guardian_info[parents]" value="{{ $resident->guardian_info['parents'] ?? '' }}" class="form-control required-step-2">
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label>Contact (phone)</label>
                                                            <input type="text" name="guardian_info[contacts][phone]" value="{{ $resident->guardian_info['contacts']['phone'] ?? '' }}" class="form-control required-step-2">
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label>Contact (email)</label>
                                                            <input type="text" name="guardian_info[contacts][email]" value="{{ $resident->guardian_info['contacts']['email'] ?? '' }}" class="form-control required-step-2">
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label>Contact (address)</label>
                                                            <input type="text" name="guardian_info[contacts][address]" value="{{ $resident->guardian_info['contacts']['address'] ?? '' }}" class="form-control required-step-2">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label>Legal Guardian / Social Worker</label>
                                                            <input type="text" name="guardian_info[legal_guardian]" value="{{ $resident->guardian_info['legal_guardian'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label>Social Worker Phone</label>
                                                            <input type="text" name="guardian_info[social_worker_phone]" value="{{ $resident->guardian_info['social_worker_phone'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label>Social Worker Email</label>
                                                            <input type="text" name="guardian_info[social_worker_email]" value="{{ $resident->guardian_info['social_worker_email'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Local Authority Responsible</label>
                                                            <input type="text" name="guardian_info[local_authority]" value="{{ $resident->guardian_info['local_authority'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Emergency Contact Details</label>
                                                            <input type="text" name="guardian_info[emergency_contact]" value="{{ $resident->guardian_info['emergency_contact'] ?? '' }}" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="wizard-nav text-center mt-3">
                                                        <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="1">
                                                            <i class="fas fa-arrow-left"></i> Back
                                                        </button>
                                                        <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="3">
                                                            Next <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- STEP 3: Placement -->
                                                <div class="wizard-card step-panel d-none" id="step-3">
                                                    <h5 class="fw-bold mb-3">Placement Information</h5>
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <label>Placement Start Date</label>
                                                            <input type="date" name="placement_info[start_date]" value="{{ $resident->placement_info['start_date'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-8 mb-3">
                                                            <label>Reason for Referral</label>
                                                            <textarea name="placement_info[reason]" class="form-control">{{ $resident->placement_info['reason'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Type of Placement</label>
                                                            <select name="placement_info[type]" class="form-control">
                                                                @foreach(['Short-term','Long-term','Emergency','Respite'] as $type)
                                                                    <option value="{{ $type }}" {{ ($resident->placement_info['type'] ?? '') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Cultural / Personal Preferences</label>
                                                            <input type="text" name="placement_info[preferences]" value="{{ $resident->placement_info['preferences'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label>Expectations & Goals</label>
                                                            <textarea name="placement_info[goals]" class="form-control">{{ $resident->placement_info['goals'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="wizard-nav text-center mt-3">
                                                        <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="2">
                                                            <i class="fas fa-arrow-left"></i> Back
                                                        </button>
                                                        <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="4">
                                                            Next <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- STEP 4: Medical -->
                                                <div class="wizard-card step-panel d-none" id="step-4">
                                                    <h5 class="fw-bold mb-3">Medical & Health Information</h5>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>NHS Number</label>
                                                            <input type="text" name="medical_info[nhs]" value="{{ $resident->medical_info['nhs'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>GP Details</label>
                                                            <input type="text" name="medical_info[gp_details]" value="{{ $resident->medical_info['gp_details'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label>Current Diagnoses</label>
                                                            <textarea name="medical_info[diagnoses]" class="form-control">{{ $resident->medical_info['diagnoses'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Allergies</label>
                                                            <input type="text" name="medical_info[allergies]" value="{{ $resident->medical_info['allergies'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Medications</label>
                                                            <textarea name="medical_info[medications]" class="form-control">{{ $resident->medical_info['medications'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="wizard-nav text-center mt-3">
                                                        <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="3">
                                                            <i class="fas fa-arrow-left"></i> Back
                                                        </button>
                                                        <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="5">
                                                            Next <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- STEP 5: Education Information -->
                                                <div class="wizard-card step-panel d-none" id="step-5">
                                                    <h5 class="fw-bold mb-3">Education Information</h5>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>Current School / Provider</label>
                                                            <input type="text" name="education_info[school]" value="{{ $resident->education_info['school'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>School Contact Info</label>
                                                            <input type="text" name="education_info[contact]" value="{{ $resident->education_info['contact'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>SEN Status</label>
                                                            <input type="text" name="education_info[sen_status]" value="{{ $resident->education_info['sen_status'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>EHCP Details</label>
                                                            <textarea name="education_info[ehcp]" class="form-control">{{ $resident->education_info['ehcp'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Attendance History</label>
                                                            <textarea name="education_info[attendance]" class="form-control">{{ $resident->education_info['attendance'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Learning Level / Academic Needs</label>
                                                            <textarea name="education_info[learning_level]" class="form-control">{{ $resident->education_info['learning_level'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Behaviour in School</label>
                                                            <textarea name="education_info[behaviour]" class="form-control">{{ $resident->education_info['behaviour'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="wizard-nav text-center mt-3">
                                                        <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="4">
                                                            <i class="fas fa-arrow-left"></i> Back
                                                        </button>
                                                        <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="6">
                                                            Next <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- STEP 6: Behavioural & Risk Information -->
                                                <div class="wizard-card step-panel d-none" id="step-6">
                                                    <h5 class="fw-bold mb-3">Behavioural & Risk Information</h5>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>Triggers</label>
                                                            <textarea name="behaviour_info[triggers]" class="form-control">{{ $resident->behaviour_info['triggers'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Behavioural Concerns</label>
                                                            <textarea name="behaviour_info[concerns]" class="form-control">{{ $resident->behaviour_info['concerns'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Known Risks</label>
                                                            <textarea name="behaviour_info[risks]" class="form-control">{{ $resident->behaviour_info['risks'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>De-escalation Strategies</label>
                                                            <textarea name="behaviour_info[deescalation]" class="form-control">{{ $resident->behaviour_info['deescalation'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>History of Trauma / Abuse / Neglect</label>
                                                            <textarea name="behaviour_info[trauma_history]" class="form-control">{{ $resident->behaviour_info['trauma_history'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Preferred Communication Style</label>
                                                            <textarea name="behaviour_info[communication]" class="form-control">{{ $resident->behaviour_info['communication'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Positive Behaviours / Strengths</label>
                                                            <textarea name="behaviour_info[strengths]" class="form-control">{{ $resident->behaviour_info['strengths'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="wizard-nav text-center mt-3">
                                                        <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="5">
                                                            <i class="fas fa-arrow-left"></i> Back
                                                        </button>
                                                        <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="7">
                                                            Next <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- STEP 7: Social & Family Information -->
                                                <div class="wizard-card step-panel d-none" id="step-7">
                                                    <h5 class="fw-bold mb-3">Social & Family Information</h5>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>Siblings & Relationships</label>
                                                            <input type="text" name="social_family_info[siblings]" value="{{ $resident->social_family_info['siblings'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Contact Schedule with Family</label>
                                                            <input type="text" name="social_family_info[contact_schedule]" value="{{ $resident->social_family_info['contact_schedule'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Cultural / Community Needs</label>
                                                            <textarea name="social_family_info[cultural]" class="form-control">{{ $resident->social_family_info['cultural'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Important Relationships</label>
                                                            <textarea name="social_family_info[relationships]" class="form-control">{{ $resident->social_family_info['relationships'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Hobbies & Interests</label>
                                                            <textarea name="social_family_info[hobbies]" class="form-control">{{ $resident->social_family_info['hobbies'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Religious / Community Commitments</label>
                                                            <textarea name="social_family_info[community]" class="form-control">{{ $resident->social_family_info['community'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="wizard-nav text-center mt-3">
                                                        <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="6">
                                                            <i class="fas fa-arrow-left"></i> Back
                                                        </button>
                                                        <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="8">
                                                            Next <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- STEP 8: Legal & Safeguarding Information -->
                                                <div class="wizard-card step-panel d-none" id="step-8">
                                                    <h5 class="fw-bold mb-3">Legal & Safeguarding Information</h5>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>Court Orders</label>
                                                            <textarea name="legal_safeguarding_info[court_orders]" class="form-control">{{ $resident->legal_safeguarding_info['court_orders'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Police Involvement</label>
                                                            <textarea name="legal_safeguarding_info[police]" class="form-control">{{ $resident->llegal_safeguarding_info['police'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Safeguarding Concerns</label>
                                                            <textarea name="legal_safeguarding_info[safeguarding]" class="form-control">{{ $resident->legal_safeguarding_info['safeguarding'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Offending Behaviour History</label>
                                                            <textarea name="legal_safeguarding_info[offending]" class="form-control">{{ $resident->legal_safeguarding_info['offending'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Consent Forms</label>
                                                            <textarea name="legal_safeguarding_info[consent]" class="form-control">{{ $resident->legal_safeguarding_info['consent'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="wizard-nav text-center mt-3">
                                                        <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="7">
                                                            <i class="fas fa-arrow-left"></i> Back
                                                        </button>
                                                        <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="9">
                                                            Next <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- STEP 9: Daily Living Needs -->
                                                <div class="wizard-card step-panel d-none" id="step-9">
                                                    <h5 class="fw-bold mb-3">Daily Living Needs</h5>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>Sleeping Pattern</label>
                                                            <input type="text" name="daily_living_info[sleep]" value="{{ $resident->daily_living_info['sleep'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Personal Care Needs</label>
                                                            <input type="text" name="daily_living_info[care]" value="{{ $resident->daily_living_info['care'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Mobility Needs</label>
                                                            <input type="text" name="daily_living_info[mobility]" value="{{ $resident->daily_living_info['mobility'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Communication Preferences</label>
                                                            <input type="text" name="daily_living_info[communication]" value="{{ $resident->daily_living_info['communication'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Routine Needs</label>
                                                            <textarea name="daily_living_info[routine]" class="form-control">{{ $resident->daily_living_info['routine'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Sensory Needs</label>
                                                            <textarea name="daily_living_info[sensory]" class="form-control">{{ $resident->daily_living_info['sensory'] ?? '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Clothing Sizes</label>
                                                            <input type="text" name="daily_living_info[clothing]" value="{{ $resident->daily_living_info['clothing'] ?? '' }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="wizard-nav text-center mt-3">
                                                        <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="8">
                                                            <i class="fas fa-arrow-left"></i> Back
                                                        </button>
                                                        <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="10">
                                                            Next <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- STEP 10: Documents to Upload -->
                                                <div class="wizard-card step-panel d-none" id="step-10">
                                                    <h5 class="fw-bold mb-3">Documents to Upload</h5>

                                                    <div class="row">

                                                        @php
                                                            $docs = $resident->documents ?? [];
                                                        @endphp

                                                        <!-- Function to avoid repeating markup -->
                                                        @php
                                                            function renderFileField($label, $key, $docs) {
                                                                $file = $docs[$key] ?? null;

                                                                echo '
                                                                    <div class="col-md-6 mb-3">
                                                                        <label class="fw-bold">'.$label.'</label>
                                                                ';

                                                                if ($file) {
                                                                    echo '
                                                                        <div class="border p-2 rounded bg-light mb-2">
                                                                            <p class="mb-1 small text-muted">
                                                                                <i class="fas fa-file"></i> Current File:
                                                                            </p>
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <span class="text-primary small">'.basename($file).'</span>

                                                                                <a href="'.asset("storage/".$file).'" 
                                                                                target="_blank" 
                                                                                class="btn btn-sm btn-outline-primary">
                                                                                    View File
                                                                                </a>
                                                                            </div>
                                                                        </div>

                                                                        <label class="text-secondary small">Replace file:</label>
                                                                    ';
                                                                } else {
                                                                    echo '
                                                                        <p class="text-muted small mb-1">No file uploaded</p>
                                                                        <label class="text-secondary small">Upload file:</label>
                                                                    ';
                                                                }

                                                                echo '
                                                                        <input type="file" name="documents['.$key.']" class="form-control">
                                                                    </div>
                                                                ';
                                                            }
                                                        @endphp

                                                        <!-- Render all document fields -->
                                                        {!! renderFileField('Birth Certificate', 'birth_certificate', $docs) !!}
                                                        {!! renderFileField('Passport / ID', 'id_passport', $docs) !!}
                                                        {!! renderFileField('Care Plan', 'care_plan', $docs) !!}
                                                        {!! renderFileField('Risk Assessment', 'risk_assessment', $docs) !!}
                                                        {!! renderFileField('Behaviour Plan', 'behaviour_plan', $docs) !!}
                                                        {!! renderFileField('EHCP', 'ehcp', $docs) !!}
                                                        {!! renderFileField('Medical Reports', 'medical_reports', $docs) !!}
                                                        {!! renderFileField('Consent Forms', 'consent_forms', $docs) !!}
                                                        {!! renderFileField('Social Worker Referral Form', 'social_worker', $docs) !!}

                                                    </div>

                                                    <div class="wizard-nav text-center mt-3">
                                                        <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="9">
                                                            <i class="fas fa-arrow-left"></i> Back
                                                        </button>
                                                        <button type="submit" class="fancy-btn fancy-btn-success">
                                                            <i class="fas fa-check-circle"></i> Update Resident
                                                        </button>
                                                    </div>
                                                </div>





                                            </div>
                                        </form> 
                                </div>
                            </div>

                            </div><!--//app-card-body-->		
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->   
                </div><!--//tab-content-->
            </div><!--//app-card-body-->
            
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll(".wizard-tab-btn");
    const panels = document.querySelectorAll(".step-panel, .step"); // include all step types

    function showStep(step) {
        panels.forEach(p => p.classList.add("d-none"));
        // check for step-panel (old) or step (new)
        const panel = document.querySelector(`#step-${step}`) || document.querySelector(`.step[data-step="${step}"]`);
        if(panel) panel.classList.remove("d-none");

        tabs.forEach(btn => btn.classList.remove("active"));
        const tab = document.querySelector(`.wizard-tab-btn[data-step="${step}"]`);
        if(tab) tab.classList.add("active");

        window.scrollTo({ top: 0, behavior: 'smooth' }); // optional: scroll to top
    }

    function validateStep(step) {
        let valid = true;
        const requiredFields = document.querySelectorAll(`.required-step-${step}`);
        requiredFields.forEach(f => {
            f.classList.remove("is-invalid");
            if(!f.value.trim()) {
                f.classList.add("is-invalid");
                valid = false;
            }
        });
        return valid;
    }

    // NEXT buttons
    document.querySelectorAll(".nextBtn").forEach(btn => {
        btn.addEventListener("click", function() {
            let current = parseInt(this.dataset.current || this.dataset.next - 1);
            let next = parseInt(this.dataset.next);

            if(!validateStep(current)) {
                toastr.error("Please fill all required fields before continuing.");
                return;
            }

            showStep(next);
        });
    });

    // BACK buttons
    document.querySelectorAll(".prevBtn").forEach(btn => {
        btn.addEventListener("click", function() {
            let prev = parseInt(this.dataset.prev);
            showStep(prev);
        });
    });

    // Click on tabs
    tabs.forEach(tab => {
        tab.addEventListener("click", function() {
            let step = parseInt(this.dataset.step);
            showStep(step);
        });
    });

    // initialize first step
    showStep(1);
});

</script>
@endsection
