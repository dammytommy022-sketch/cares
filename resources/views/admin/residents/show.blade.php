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
                    <div class="row align-items-center gx-3 show-view">
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
                    <div>
                        <button type="button" class="btn btn-sm fancy-btn-success rounded-pill no-print" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Summary
                        </button>
                        <a href="{{ route('admin.residents.index') }}" class="btn btn-secondary rounded-pill">
                            <i class="fas fa-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
                
            </div><!--//app-card-header-->
            <div class="app-card-body  px-4  pb-2"> 
                <div class="show-view">
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
                                                    <i class="fas fa-users-cog"></i> Family
                                                </button>
                                                <button class="wizard-tab-btn" data-step="8">
                                                    <i class="fas fa-gavel"></i> Legal
                                                </button>
                                                <button class="wizard-tab-btn" data-step="9">
                                                    <i class="fas fa-bed"></i> Living
                                                </button>
                                                <button class="wizard-tab-btn" data-step="10">
                                                    <i class="fas fa-file-upload"></i> Docs
                                                </button>
                                            </div>
                                        </div>

                                        <div id="wizardPanels" class="p-3">

                                            {{-- STEP 1: BASIC INFO --}}
                                            <div class="wizard-card step-panel" id="step-1">
                                                <h5 class="fw-bold mb-3">Basic Personal Information</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'full_name' => 'Full Name',
                                                        'preferred_name' => 'Preferred Name',
                                                        'dob' => 'Date of Birth',
                                                        'gender' => 'Gender',
                                                        'nationality' => 'Nationality',
                                                        'ethnicity' => 'Ethnicity',
                                                        'language' => 'Primary Language',
                                                        'religion' => 'Religion'
                                                    ] as $key => $label)
                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $resident->basic_info[$key] ?? '—' }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="wizard-nav text-center mt-3">
                                                    <button class="fancy-btn fancy-btn-primary nextBtn" data-next="2">
                                                        Next <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>


                                            {{-- STEP 2: GUARDIANS --}}
                                            <div class="wizard-card step-panel d-none" id="step-2">
                                                <h5 class="fw-bold mb-3">Parent / Guardian / Social Worker</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'parents' => 'Name of Parents',
                                                        'contacts.phone' => 'Phone',
                                                        'contacts.email' => 'Email',
                                                        'contacts.address' => 'Address',
                                                        'legal_guardian' => 'Legal Guardian',
                                                        'social_worker_phone' => 'Social Worker Phone',
                                                        'social_worker_email' => 'Social Worker Email',
                                                        'local_authority' => 'Local Authority',
                                                        'emergency_contact' => 'Emergency Contact'
                                                    ] as $key => $label)

                                                        @php
                                                            $value = data_get($resident->guardian_info, $key, '—');
                                                        @endphp

                                                        <div class="col-md-4 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">{{ $value }}</div>
                                                        </div>

                                                    @endforeach
                                                </div>

                                                <div class="wizard-nav text-center mt-3">
                                                    <button class="fancy-btn fancy-btn-secondary prevBtn" data-prev="1">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </button>
                                                    <button class="fancy-btn fancy-btn-primary nextBtn" data-next="3">
                                                        Next <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- STEP 3: PLACEMENT --}}
                                            <div class="wizard-card step-panel d-none" id="step-3">
                                                <h5 class="fw-bold mb-3">Placement Information</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'type' => 'Placement Type',
                                                        'start_date' => 'Start Date',
                                                        'social_worker' => 'Social Worker Name',
                                                        'reason' => 'Reason for Placement',
                                                        'placement_history' => 'Placement History',
                                                        'risk_level' => 'Risk Level',
                                                        'allowed_visitors' => 'Allowed Visitors',
                                                        'restricted_visitors' => 'Restricted Visitors',
                                                    ] as $key => $label)
                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $resident->placement_info[$key] ?? '—' }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="wizard-nav text-center mt-3">
                                                    <button class="fancy-btn fancy-btn-secondary prevBtn" data-prev="2">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </button>
                                                    <button class="fancy-btn fancy-btn-primary nextBtn" data-next="4">
                                                        Next <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- STEP 4: MEDICAL --}}
                                            <div class="wizard-card step-panel d-none" id="step-4">
                                                <h5 class="fw-bold mb-3">Medical & Health Information</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'nhs_number' => 'NHS Number',
                                                        'gp_name' => 'GP Name',
                                                        'gp_phone' => 'GP Phone',
                                                        'allergies' => 'Allergies',
                                                        'medications' => 'Medications',
                                                        'mental_health' => 'Mental Health Notes',
                                                        'disabilities' => 'Disabilities',
                                                        'dietary_needs' => 'Dietary Needs',
                                                        'medical_history' => 'Medical History',
                                                    ] as $key => $label)
                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $resident->medical_info[$key] ?? '—' }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="wizard-nav text-center mt-3">
                                                    <button class="fancy-btn fancy-btn-secondary prevBtn" data-prev="3">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </button>
                                                    <button class="fancy-btn fancy-btn-primary nextBtn" data-next="5">
                                                        Next <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- STEP 5: EDUCATION --}}
                                            <div class="wizard-card step-panel d-none" id="step-5">
                                                <h5 class="fw-bold mb-3">Education & Schooling</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'current_school' => 'Current School',
                                                        'year_group' => 'Year Group',
                                                        'school_phone' => 'School Phone',
                                                        'school_email' => 'School Email',
                                                        'attendance' => 'Attendance (%)',
                                                        'sen_status' => 'SEN Status',
                                                        'education_history' => 'Education History',
                                                        'strengths' => 'Strengths',
                                                        'support_needs' => 'Support Needs',
                                                    ] as $key => $label)
                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $resident->education_info[$key] ?? '—' }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="wizard-nav text-center mt-3">
                                                    <button class="fancy-btn fancy-btn-secondary prevBtn" data-prev="4">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </button>
                                                    <button class="fancy-btn fancy-btn-primary nextBtn" data-next="6">
                                                        Next <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- STEP 6: RISK & BEHAVIOUR --}}
                                            <div class="wizard-card step-panel d-none" id="step-6">
                                                <h5 class="fw-bold mb-3">Behavioural & Risk Assessment</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'behaviour_issues' => 'Behaviour Issues',
                                                        'risk_assessment' => 'Risk Assessment Summary',
                                                        'absconding_risk' => 'Absconding Risk',
                                                        'substance_use' => 'Substance Use',
                                                        'peer_risks' => 'Peer-related Risks',
                                                        'triggers' => 'Known Triggers',
                                                        'supervision_level' => 'Supervision Level',
                                                    ] as $key => $label)
                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $resident->risk_info[$key] ?? '—' }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="wizard-nav text-center mt-3">
                                                    <button class="fancy-btn fancy-btn-secondary prevBtn" data-prev="5">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </button>
                                                    <button class="fancy-btn fancy-btn-primary nextBtn" data-next="7">
                                                        Next <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- STEP 7: FAMILY & SOCIAL --}}
                                            <div class="wizard-card step-panel d-none" id="step-7">
                                                <h5 class="fw-bold mb-3">Family & Social Background</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'family_background' => 'Family Background',
                                                        'siblings' => 'Siblings',
                                                        'family_relationships' => 'Family Relationships',
                                                        'cultural_needs' => 'Cultural Needs',
                                                        'religious_needs' => 'Religious Needs',
                                                        'community_links' => 'Community Links',
                                                        'previous_trauma' => 'Previous Trauma',
                                                    ] as $key => $label)
                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $resident->family_info[$key] ?? '—' }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="wizard-nav text-center mt-3">
                                                    <button class="fancy-btn fancy-btn-secondary prevBtn" data-prev="6">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </button>
                                                    <button class="fancy-btn fancy-btn-primary nextBtn" data-next="8">
                                                        Next <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- STEP 8: LEGAL --}}
                                            <div class="wizard-card step-panel d-none" id="step-8">
                                                <h5 class="fw-bold mb-3">Legal Information</h5>
                                                <div class="row">
                                                    @foreach([
                                                        'legal_status' => 'Legal Status',
                                                        'court_orders' => 'Court Orders',
                                                        'upcoming_hearings' => 'Upcoming Hearings',
                                                        'legal_representative' => 'Legal Representative',
                                                        'previous_convictions' => 'Previous Convictions',
                                                    ] as $key => $label)
                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $resident->legal_info[$key] ?? '—' }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>  
                                                <div class="wizard-nav text-center mt-3">
                                                    <button class="fancy-btn fancy-btn-secondary prevBtn" data-prev="7">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </button>
                                                    <button class="fancy-btn fancy-btn-primary nextBtn" data-next="9">
                                                        Next <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- STEP 9: DAILY LIVING --}}
                                            <div class="wizard-card step-panel d-none" id="step-9">
                                                <h5 class="fw-bold mb-3">Daily Living & Independence</h5>   
                                                <div class="row">
                                                    @foreach([
                                                        'sleep' => 'Sleep Routine',
                                                        'care' => 'Care Needs',
                                                        'mobility' => 'Mobility',
                                                        'communication' => 'Communication',
                                                        'routine' => 'Routine Skills',
                                                        'sensory' => 'Sensory',
                                                        'clothing' => 'Clothing'
                                                    ] as $key => $label)
                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $resident->daily_living_info[$key] ?? '—' }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="wizard-nav text-center mt-3">
                                                    <button class="fancy-btn fancy-btn-secondary prevBtn" data-prev="8">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </button>
                                                    <button class="fancy-btn fancy-btn-primary nextBtn" data-next="10">
                                                        Next <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                    <button class="fancy-btn fancy-btn-success" onclick="window.print()">
                                                        <i class="fas fa-print"></i> Print Summary
                                                    </button>
                                                </div>
                                            </div>

                                            
                                            {{-- STEP 10: DOCUMENTS --}}
                                            <div class="wizard-card step-panel d-none" id="step-10">
                                                <h5 class="fw-bold mb-3">Documents & Uploads</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'birth_certificate' => 'Birth Certificate',
                                                        'id_passport' => 'ID / Passport',
                                                        'care_plan' => 'Care Plan',
                                                        'risk_assessment' => 'Risk Assessment',
                                                        'behaviour_plan' => 'Behaviour Plan',
                                                        'ehcp' => 'EHCP',
                                                        'medical_reports' => 'Medical Reports',
                                                        'consent_forms' => 'Consent Forms',
                                                        'social_worker' => 'Social Worker Reports',
                                                    ] as $key => $label)
                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>

                                                            @php
                                                                $file = $resident->documents[$key] ?? null;
                                                            @endphp

                                                            <div class="show-field">
                                                                @if($file)
                                                                    <a href="{{ asset('storage/'.$file) }}" target="_blank" class="text-primary">
                                                                        View File <i class="fas fa-external-link-alt"></i>
                                                                    </a>
                                                                @else
                                                                    —
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="wizard-nav text-center mt-4">
                                                    <button class="fancy-btn fancy-btn-secondary prevBtn" data-prev="9">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </button>
                                                    <a href="{{ route('admin.residents.index') }}" class="fancy-btn fancy-btn-success">
                                                        <i class="fas fa-check-circle"></i> Done
                                                    </a>
                                                    

                                                </div>
                                            </div>

                                        </div>
                                    </div><!--//container-xl-->
                                </div><!--//app-content-->
                            </div><!--//app-card-body-->		
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->   
                </div><!--//tab-content-->
            </div><!--//app-card-body-->
            <div>
                <div class="print-only">
                    <div class="print-wrapper">
                        <!-- ========================= -->
                        <!-- 1. BASIC INFORMATION -->
                        <!-- ========================= -->
                        <div class="print-section">
                            <div class="print-section-title">1. Basic Personal Information</div>
                            <table class="print-table">
                                <tr><td class="print-label">Full Name</td><td>{{ $resident->basic_info['full_name'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Preferred Name</td><td>{{ $resident->basic_info['preferred_name'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Date of Birth</td><td>{{ $resident->basic_info['dob'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Gender</td><td>{{ $resident->basic_info['gender'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Nationality</td><td>{{ $resident->basic_info['nationality'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Ethnicity</td><td>{{ $resident->basic_info['ethnicity'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Language</td><td>{{ $resident->basic_info['language'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Religion</td><td>{{ $resident->basic_info['religion'] ?? '' }}</td></tr>
                            </table>
                        </div>

                        <!-- ========================= -->
                        <!-- 2. GUARDIAN INFORMATION -->
                        <!-- ========================= -->
                        <div class="print-section">
                            <div class="print-section-title">2. Parents / Guardian Information</div>
                            <table class="print-table">
                                <tr><td class="print-label">Parents</td><td>{{ $resident->guardian_info['parents'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Parent Phone</td><td>{{ $resident->guardian_info['contacts']['phone'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Parent Email</td><td>{{ $resident->guardian_info['contacts']['email'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Parent Address</td><td>{{ $resident->guardian_info['contacts']['address'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Legal Guardian</td><td>{{ $resident->guardian_info['legal_guardian'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Social Worker Phone</td><td>{{ $resident->guardian_info['social_worker_phone'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Social Worker Email</td><td>{{ $resident->guardian_info['social_worker_email'] ?? '' }}</td></tr>
                            </table>
                        </div>

                        <!-- ========================= -->
                        <!-- 3. PLACEMENT INFORMATION -->
                        <!-- ========================= -->
                        <div class="print-section">
                            <div class="print-section-title">3. Placement Information</div>
                            <table class="print-table">
                                <tr><td class="print-label">Start Date</td><td>{{ $resident->placement_info['start_date'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Reason for Placement</td><td>{{ $resident->placement_info['reason'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Placement Type</td><td>{{ $resident->placement_info['type'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Preferences</td><td>{{ $resident->placement_info['preferences'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Goals</td><td>{{ $resident->placement_info['goals'] ?? '' }}</td></tr>
                            </table>
                        </div>

                        <!-- ========================= -->
                        <!-- 4. MEDICAL INFORMATION -->
                        <!-- ========================= -->
                        <div class="print-section">
                            <div class="print-section-title">4. Medical Information</div>
                            <table class="print-table">
                                <tr><td class="print-label">NHS Number</td><td>{{ $resident->medical_info['nhs'] ?? '' }}</td></tr>
                                <tr><td class="print-label">GP Details</td><td>{{ $resident->medical_info['gp_details'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Diagnoses</td><td>{{ $resident->medical_info['diagnoses'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Allergies</td><td>{{ $resident->medical_info['allergies'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Medications</td><td>{{ $resident->medical_info['medications'] ?? '' }}</td></tr>
                            </table>
                        </div>

                        <!-- ========================= -->
                        <!-- 5. EDUCATION INFORMATION -->
                        <!-- ========================= -->
                        <div class="print-section">
                            <div class="print-section-title">5. Education Information</div>
                            <table class="print-table">
                                <tr><td class="print-label">School</td><td>{{ $resident->education_info['school'] ?? '' }}</td></tr>
                                <tr><td class="print-label">School Contact</td><td>{{ $resident->education_info['contact'] ?? '' }}</td></tr>
                                <tr><td class="print-label">SEN Status</td><td>{{ $resident->education_info['sen_status'] ?? '' }}</td></tr>
                                <tr><td class="print-label">EHCP Details</td><td>{{ $resident->education_info['ehcp'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Attendance</td><td>{{ $resident->education_info['attendance'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Learning Level</td><td>{{ $resident->education_info['learning_level'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Behaviour</td><td>{{ $resident->education_info['behaviour'] ?? '' }}</td></tr>
                            </table>
                        </div>

                        <!-- ========================= -->
                        <!-- 6. BEHAVIOURAL INFORMATION -->
                        <!-- ========================= -->
                        <div class="print-section">
                            <div class="print-section-title">6. Behavioural Information</div>
                            <table class="print-table">
                                <tr><td class="print-label">Triggers</td><td>{{ $resident->behaviour_info['triggers'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Concerns</td><td>{{ $resident->behaviour_info['concerns'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Risks</td><td>{{ $resident->behaviour_info['risks'] ?? '' }}</td></tr>
                                <tr><td class="print-label">De-escalation</td><td>{{ $resident->behaviour_info['deescalation'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Trauma History</td><td>{{ $resident->behaviour_info['trauma_history'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Communication</td><td>{{ $resident->behaviour_info['communication'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Strengths</td><td>{{ $resident->behaviour_info['strengths'] ?? '' }}</td></tr>
                            </table>
                        </div>

                        <!-- ========================= -->
                        <!-- 7. SOCIAL & FAMILY INFORMATION -->
                        <!-- ========================= -->
                        <div class="print-section">
                            <div class="print-section-title">7. Social & Family Information</div>
                            <table class="print-table">
                                <tr><td class="print-label">Siblings</td><td>{{ $resident->social_family_info['siblings'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Contact Schedule</td><td>{{ $resident->social_family_info['contact_schedule'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Cultural</td><td>{{ $resident->social_family_info['cultural'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Relationships</td><td>{{ $resident->social_family_info['relationships'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Hobbies</td><td>{{ $resident->social_family_info['hobbies'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Community Involvement</td><td>{{ $resident->social_family_info['community'] ?? '' }}</td></tr>
                            </table>
                        </div>

                        <!-- ========================= -->
                        <!-- 8. LEGAL & SAFEGUARDING -->
                        <!-- ========================= -->
                        <div class="print-section">
                            <div class="print-section-title">8. Legal & Safeguarding Information</div>
                            <table class="print-table">
                                <tr><td class="print-label">Court Orders</td><td>{{ $resident->legal_safeguarding_info['court_orders'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Police Involvement</td><td>{{ $resident->legal_safeguarding_info['police'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Safeguarding Concerns</td><td>{{ $resident->legal_safeguarding_info['safeguarding'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Offending History</td><td>{{ $resident->legal_safeguarding_info['offending'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Consent</td><td>{{ $resident->legal_safeguarding_info['consent'] ?? '' }}</td></tr>
                            </table>
                        </div>

                        <!-- ========================= -->
                        <!-- 9. DAILY LIVING SKILLS -->
                        <!-- ========================= -->
                        <div class="print-section">
                            <div class="print-section-title">9. Daily Living Skills</div>
                            <table class="print-table">
                                <tr><td class="print-label">Sleep</td><td>{{ $resident->daily_living_info['sleep'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Personal Care</td><td>{{ $resident->daily_living_info['care'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Mobility</td><td>{{ $resident->daily_living_info['mobility'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Communication</td><td>{{ $resident->daily_living_info['communication'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Routine</td><td>{{ $resident->daily_living_info['routine'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Sensory</td><td>{{ $resident->daily_living_info['sensory'] ?? '' }}</td></tr>
                                <tr><td class="print-label">Clothing Size</td><td>{{ $resident->daily_living_info['clothing'] ?? '' }}</td></tr>
                            </table>
                        </div>

                        <!-- ========================= -->
                        <!-- 10. DOCUMENT UPLOADS -->
                        <!-- ========================= -->
                        <div class="print-section">
                            <div class="print-section-title">10. Uploaded Documents</div>
                            <table class="print-table">
                                @foreach($resident->documents ?? [] as $key => $file)
                                    <tr>
                                        <td class="print-label">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                        <td>
                                            @if($file)
                                                {{ $file }}
                                            @else
                                                <em>No file uploaded</em>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hide summary in normal view */
    .print-only {
        display: none;
    }

    @media print {

        /* Show summary only in print */
        .print-only {
            display: block !important;
        }

        /* Hide buttons, navigation, UI */
        .no-print, nav, header, footer, .btn, .fancy-btn, .show-view{
            display: none !important;
        }

        body {
            background: #ffffff !important;
            color: #000;
        }

        .print-wrapper {
            padding: 20px;
        }

        .print-section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            border-bottom: 2px solid #444;
            padding-bottom: 5px;
        }

        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .print-table td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        /* Prevent breaking sections in half */
        .print-section {
            page-break-inside: avoid;
        }
    }
</style>





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
