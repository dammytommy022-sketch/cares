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
        gap: 10px;
        background: #ffffff;
        padding: 8px;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    /* --- Tab Button (pill style) --- */
    .wizard-tab-btn {
        padding: 10px 22px;
        border-radius: 40px;
        border: none;
        background: #f1f5f9;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: 0.25s ease;
        font-size: 14px;
    }

    .wizard-tab-btn i {
        font-size: 16px;
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

    

</style>


<div class="app-content pt-5 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="app-card app-card-basic p-3 bg-light">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fas fa-user-plus" style="font-size: 2em;"></i>
                        </div><!--//icon-holder-->
                        
                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title">Create New Resident</h4>
                    </div><!--//col-->
                        
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body  px-4 mb-5">
                <div class="pb-5">
                    <div class="tab-pane fade show active " id="all-shift" role="tabpanel" aria-labelledby="all-shift-tab">
                        <div class="app-card  app-card-basic p-4 bg-light shadow rounded-4">
                            <!-- Top Tab Buttons -->
                            <div class="wizard-tabs-wrapper">
                                <div class="wizard-tabs">

                                    <button class="wizard-tab-btn active" data-step="1">
                                        <i class="fas fa-user"></i>
                                        Basic Info
                                    </button>

                                    <button class="wizard-tab-btn" data-step="2">
                                        <i class="fas fa-users"></i>
                                        Parent / Guardian
                                    </button>

                                    <button class="wizard-tab-btn" data-step="3">
                                        <i class="fas fa-home"></i>
                                        Placement Info
                                    </button>

                                    <button class="wizard-tab-btn" data-step="4">
                                        <i class="fas fa-heartbeat"></i>
                                        Medical & Health
                                    </button>

                                </div>
                            </div>


                            <form method="POST" action="{{ route('admin.residents.store') }}" id="residentForm">
                                @csrf

                                <div id="wizardPanels" class="p-3">

                                    <!-- ---------------- STEP 1 ---------------- -->
                                    <div class="wizard-card step-panel" id="step-1">
                                        <h5 class="fw-bold mb-3">Basic Personal Information</h5>

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">Full Name *</label>
                                                <input type="text" name="basic_info[full_name]" class="form-control required-step-1">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">Preferred Name</label>
                                                <input type="text" name="basic_info[preferred_name]" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Date of Birth *</label>
                                                <input type="date" name="basic_info[dob]" class="form-control required-step-1">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Gender *</label>
                                                <select name="basic_info[gender]" class="form-control required-step-1">
                                                    <option value="">Select gender</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label >Nationality</label>
                                                <select name="basic_info[nationality]" class="form-control" required>
                                                    <option value="">-- Select Nationality --</option>

                                                    @foreach($nationalities as $nation)
                                                        <option value="{{ $nation }}">
                                                            {{ $nation }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label >Ethnicity / Cultural background</label>
                                                <select name="basic_info[ethnicity]" class="form-control">
                                                    <option value="">-- Select Ethnicity --</option>
                                                    @foreach($ethnicities as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Primary language & communication needs</label>
                                                <select name="basic_info[language]" class="form-control">
                                                    <option value="">-- Select Language --</option>
                                                    @foreach($languages as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label>Religion (optional)</label>
                                                <select name="basic_info[religion]" class="form-control">
                                                    <option value="">-- Select Religion --</option>
                                                    @foreach($religions as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            

                                        </div>

                                        <div class="wizard-nav">
                                             <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="2">
                                                Next <i class="fas fa-arrow-right"></i>
                                            </button>

                                        </div>

                                    </div>

                                    <!-- ---------------- STEP 2 ---------------- -->
                                    <div class="wizard-card step-panel d-none" id="step-2">
                                        <h5 class="fw-bold mb-3">Parent / Guardian / Legal Authority</h5>

                                        <div class="row">

                                            <div class="col-md-3 mb-3">
                                                <label>Name of Parents</label>
                                                <input type="text" name="guardian_info[parents]" class="form-control required-step-2">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label>Contact (phone)</label>
                                                <input type="text" name="guardian_info[contacts][phone]" class="form-control required-step-2">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label>Contact (email)</label>
                                                <input type="text" name="guardian_info[contacts][email]" class="form-control required-step-2">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label>Contact (address)</label>
                                                <input type="text" name="guardian_info[contacts][address]" class="form-control required-step-2">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Name of Legal Guardian / Social Worker</label>
                                                <input type="text" name="guardian_info[legal_guardian]" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Social Worker Phone No.</label>
                                                <input type="text" name="guardian_info[social_worker][phone]" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Social Worker Email</label>
                                                <input type="text" name="guardian_info[social_worker][email]" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Local Authority Responsible</label>
                                                <input type="text" name="guardian_info[local_authority]" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Emergency Contact Details</label>
                                                <input type="text" name="guardian_info[emergency_contact]" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Persons Authorized to Visit</label>
                                                <textarea name="guardian_info[authorized_persons]" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Persons NOT Allowed Contact</label>
                                                <textarea name="guardian_info[restricted_persons]" class="form-control"></textarea>
                                            </div>

                                        </div>

                                        <div class="wizard-nav">
                                            <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="1">
                                                <i class="fas fa-arrow-left"></i> Back
                                            </button>

                                            <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="3">
                                                Next <i class="fas fa-arrow-right"></i>
                                            </button>

                                        </div>

                                    </div>

                                    <!-- ---------------- STEP 3 ---------------- -->
                                    <div class="wizard-card step-panel d-none" id="step-3">
                                        <h5 class="fw-bold mb-3">Placement Information</h5>

                                        <div class="row">

                                            <div class="col-md-4 mb-3">
                                                <label>Placement Start Date</label>
                                                <input type="date" name="placement_info[start_date]" class="form-control">
                                            </div>

                                            <div class="col-md-8 mb-3">
                                                <label>Reason for Referral</label>
                                                <textarea name="placement_info[reason]" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Type of Placement</label>
                                                <select name="placement_info[type]" class="form-control">
                                                    <option>Short-term</option>
                                                    <option>Long-term</option>
                                                    <option>Emergency</option>
                                                    <option>Respite</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Cultural or Personal Preferences</label>
                                                <input type="text" name="placement_info[preferences]" class="form-control">
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label>Expectations & Goals for Placement</label>
                                                <textarea name="placement_info[goals]" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label>Previous Placements & Outcomes</label>
                                                <textarea name="placement_info[previous]" class="form-control"></textarea>
                                            </div>

                                        </div>

                                        <div class="wizard-nav">
                                            <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="2">
                                                <i class="fas fa-arrow-left"></i> Back
                                            </button>

                                            <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="4">
                                                Next <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>

                                    </div>

                                    <!-- ---------------- STEP 4 ---------------- -->
                                    <div class="wizard-card step-panel d-none" id="step-4">
                                        <h5 class="fw-bold mb-3">Medical & Health Information</h5>

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label>NHS Number</label>
                                                <input type="text" name="medical_info[nhs]" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>GP Details</label>
                                                <input type="text" name="medical_info[gp_details]" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Current Diagnoses</label>
                                                <textarea name="medical_info[diagnoses]" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Allergies</label>
                                                <input type="text" name="medical_info[allergies]" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Medications (dosage, frequency)</label>
                                                <textarea name="medical_info[medications]" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Medical History</label>
                                                <textarea name="medical_info[history]" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Dietary Needs</label>
                                                <textarea name="medical_info[diet]" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mental Health Risks</label>
                                                <textarea name="medical_info[mental_health_risks]" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Equipment Needed (wheelchair, hoists, etc.)</label>
                                                <textarea name="medical_info[equipment]" class="form-control"></textarea>
                                            </div>

                                        </div>

                                        <div class="wizard-nav">
                                            <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="3">
                                                <i class="fas fa-arrow-left"></i> Back
                                            </button>

                                            <button type="submit" class="fancy-btn fancy-btn-success">
                                                <i class="fas fa-check-circle"></i> Create Resident
                                            </button>
                                        </div>


                                    </div>

                                </div>
                            </form>
                        <div>
                           
                    </div><!--//tab-pane-->   
                </div><!--//tab-content-->
            </div><!--//app-card-body-->
            
        </div>
    </div>
</div>



@endsection


@section('scripts')
<script>

document.addEventListener("DOMContentLoaded", function () {

    const tabs = document.querySelectorAll(".wizard-tab-btn");
    const panels = document.querySelectorAll(".step-panel");

    function showStep(step) {
        panels.forEach(p => p.classList.add("d-none"));
        document.querySelector(`#step-${step}`).classList.remove("d-none");

        tabs.forEach(btn => btn.classList.remove("active"));
        document.querySelector(`[data-step="${step}"]`).classList.add("active");
    }

    // ------------------ VALIDATION FUNCTION ------------------
    function validateStep(step) {
        let valid = true;

        // Only validate fields with class required-step-#
        const requiredFields = document.querySelectorAll(`.required-step-${step}`);

        requiredFields.forEach(field => {
            field.classList.remove("is-invalid");
            if (!field.value.trim()) {
                field.classList.add("is-invalid");
                valid = false;
            }
        });

        return valid;
    }

    // ------------------ NEXT BUTTON ------------------
    document.querySelectorAll(".nextBtn").forEach(btn => {
        btn.addEventListener("click", function () {
            let current = this.dataset.current || this.dataset.next - 1;
            let next = this.dataset.next;

            // If validation fails, stop
            if (!validateStep(current)) {
                toastr.error("Please fill all required fields before continuing.");
                return;
            }

            showStep(next);
        });
    });

    // ------------------ BACK BUTTON ------------------
    document.querySelectorAll(".prevBtn").forEach(btn => {
        btn.addEventListener("click", function () {
            let prev = this.dataset.prev;
            showStep(prev);
        });
    });

    // ------------------ TAB CLICK CONTROL ------------------
    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            let step = this.dataset.step;
            showStep(step);
        });
    });

});

</script>
@endsection
