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
                            <h4 class="app-card-title">Personel Profile</h4>
                            <small class="text-muted">Manage personel, Update records</small>

                        </div><!--//col-->
                            
                    </div><!--//row-->  
                    <div>
                        <button type="button" class="btn btn-sm fancy-btn-success rounded-pill no-print" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Summary
                        </button>
                        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary rounded-pill">
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
                                                    <i class="fas fa-id-card"></i> Basic Info
                                                </button>

                                                <button class="wizard-tab-btn" data-step="2">
                                                    <i class="fas fa-briefcase"></i> Employment
                                                </button>

                                                <button class="wizard-tab-btn" data-step="3">
                                                    <i class="fas fa-graduation-cap"></i> Training
                                                </button>

                                                <button class="wizard-tab-btn" data-step="4">
                                                    <i class="fas fa-user-shield"></i> Compliance
                                                </button>

                                                <button class="wizard-tab-btn" data-step="5">
                                                    <i class="fas fa-chart-line"></i> Performance
                                                </button>

                                                <button class="wizard-tab-btn" data-step="6">
                                                    <i class="fas fa-phone-alt"></i> Emergency
                                                </button>

                                            </div>
                                        </div>

                                        <div id="wizardPanels" class="p-3">

                                            {{-- =========================
                                                STEP 1: BASIC INFO
                                            ========================== --}}
                                            <div class="wizard-card step-panel" id="step-1">
                                                <h5 class="fw-bold mb-3">Basic Information</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'full_name' => 'Full Name',
                                                        'employee_id' => 'Employee / Staff ID',
                                                        'role' => 'Job Title',
                                                        'phone' => 'Phone Number',
                                                        'email' => 'Email Address',
                                                    ] as $key => $label)

                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $staff->basic_info[$key] ?? '—' }}
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                    @php
                                                        $teamHouseId = $staff->basic_info['team'] ?? null;
                                                        $teamHouse = $teamHouseId ? \App\Models\House::find($teamHouseId) : null;
                                                    @endphp
                                                    <div class="col-md-6 mb-3">
                                                        <label class="fw-semibold">Department / Team</label>
                                                        <div class="show-field">
                                                            {{ $teamHouse->name ?? '—' }}
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="wizard-nav text-center mt-3">
                                                    <button class="fancy-btn fancy-btn-primary nextBtn" data-next="2">
                                                        Next <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>


                                            {{-- =========================
                                                STEP 2: EMPLOYMENT DETAILS
                                            ========================== --}}
                                            <div class="wizard-card step-panel d-none" id="step-2">
                                                <h5 class="fw-bold mb-3">Employment Details</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'start_company' => 'Start Date (Company)',
                                                        'start_assignment' => 'Start Date (Current Home)',
                                                        'contract_type' => 'Contract Type',
                                                        'schedule' => 'Shift Pattern',
                                                        'supervisor' => 'Supervisor / Line Manager',
                                                        'status' => 'Work Status',
                                                    ] as $key => $label)

                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $staff->employment_details[$key] ?? '—' }}
                                                            </div>
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


                                            {{-- =========================
                                                STEP 3: QUALIFICATIONS & TRAINING
                                            ========================== --}}
                                            <div class="wizard-card step-panel d-none" id="step-3">
                                                <h5 class="fw-bold mb-3">Qualifications & Training</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'nvq' => 'NVQ / Certifications',
                                                        'first_aid' => 'First Aid / CPR',
                                                        'mandatory_training' => 'Mandatory Training Completed',
                                                        'expiry_dates' => 'Expiry Dates',
                                                    ] as $key => $label)

                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $staff->qualifications[$key] ?? '—' }}
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


                                            {{-- =========================
                                                STEP 4: COMPLIANCE & LEGAL
                                            ========================== --}}
                                            <div class="wizard-card step-panel d-none" id="step-4">
                                                <h5 class="fw-bold mb-3">Compliance & Legal Status</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'dbs_status' => 'DBS / Background Check',
                                                        'right_to_work' => 'Right to Work',
                                                        'restrictions' => 'Work Restrictions',
                                                        'additional_checks' => 'Additional Checks',
                                                    ] as $key => $label)

                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $staff->compliance[$key] ?? '—' }}
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


                                            {{-- =========================
                                                STEP 5: PERFORMANCE & NOTES
                                            ========================== --}}
                                            <div class="wizard-card step-panel d-none" id="step-5">
                                                <h5 class="fw-bold mb-3">Performance & Notes</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'assigned_residents' => 'Assigned Residents',
                                                        'appraisals' => 'Appraisals / Reviews',
                                                        'incident_reports' => 'Incident Reports',
                                                        'notes' => 'Additional Notes',
                                                    ] as $key => $label)

                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $staff->performance[$key] ?? '—' }}
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


                                            {{-- =========================
                                                STEP 6: EMERGENCY CONTACT
                                            ========================== --}}
                                            <div class="wizard-card step-panel d-none" id="step-6">
                                                <h5 class="fw-bold mb-3">Emergency & Health Information</h5>

                                                <div class="row">
                                                    @foreach([
                                                        'contact_name' => 'Emergency Contact Name',
                                                        'contact_phone' => 'Emergency Contact Phone',
                                                        'health_notes' => 'Health Notes / Work Limitations',
                                                    ] as $key => $label)

                                                        <div class="col-md-6 mb-3">
                                                            <label class="fw-semibold">{{ $label }}</label>
                                                            <div class="show-field">
                                                                {{ $staff->emergency_contacts[$key] ?? '—' }}
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                </div>

                                                <div class="wizard-nav text-center mt-4">
                                                    <button class="fancy-btn fancy-btn-secondary prevBtn" data-prev="5">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </button>

                                                    <a href="{{ route('admin.staff.index') }}" class="fancy-btn fancy-btn-success">
                                                        <i class="fas fa-check-circle"></i> Done
                                                    </a>

                                                    <button class="fancy-btn fancy-btn-primary" onclick="window.print()">
                                                        <i class="fas fa-print"></i> Print Summary
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//container-fluid-->
</div><!--//app-content-->  





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
