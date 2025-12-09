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
                        <h4 class="app-card-title">Create New Staff Member</h4>
                    </div><!--//col-->
                        
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body  px-4 mb-5">
                <div class="pb-5">
                    <div class="tab-pane fade show active " id="all-shift" role="tabpanel" aria-labelledby="all-shift-tab">
                        <div class="app-card  app-card-basic p-4 bg-light shadow rounded-4">
                            <!-- Top Tab Buttons -->
                            {{-- Wizard Tabs --}}
                            <div class="wizard-tabs-wrapper mb-4">
                                <div class="wizard-tabs">
                                    <button class="wizard-tab-btn active" data-step="1"><i class="fas fa-user"></i> Basic Info</button>
                                    <button class="wizard-tab-btn" data-step="2"><i class="fas fa-briefcase"></i> Employment</button>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.staff.store') }}" id="staffForm">
                                @csrf

                                <div id="wizardPanels" class="p-3">

                                    <!-- STEP 1: Basic Info -->
                                    <div class="wizard-card step-panel" id="step-1">
                                        <h5 class="fw-bold mb-3">Basic Info</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Full Name</label>
                                                <input type="text" name="basic_info[full_name]" class="form-control required-step-1">
                                            </div>
                                            
                                            <div class="col-sm-6 mb-3">
                                                <label for="role" class="form-label">Job Title / Role</label>
                                                <select name="basic_info[role]" id="role" class="form-control required-step-1">
                                                    <option value="Manager">Manager</option>
                                                    <option value="Team_Leader">Team Leader</option>
                                                    <option value="Support_Worker">Support Worker</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Employee ID / Staff Number</label>
                                                <input type="text" name="basic_info[employee_id]" class="form-control required-step-1">
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <label for="house_id" class="form-label">House / Team</label>
                                                <select name="basic_info[team]" id="house_id" class="form-control required-step-1" >
                                                    @foreach($houses as $house)
                                                        <option value="{{ $house->id }}">{{ $house->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Contact Phone</label>
                                                <input type="text" name="basic_info[phone]" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Contact Email</label>
                                                <input type="email" name="basic_info[email]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="wizard-nav text-center mt-3">
                                            <button type="button" class="fancy-btn fancy-btn-primary nextBtn" data-next="2">
                                                Next <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- STEP 2: Employment Details -->
                                    <div class="wizard-card step-panel d-none" id="step-2">
                                        <h5 class="fw-bold mb-3">Employment Details</h5>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label>Start Date in Company</label>
                                                <input type="date" name="employment_details[start_company]" class="form-control required-step-2">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>Start Date in Current Assignment</label>
                                                <input type="date" name="employment_details[start_assignment]" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>Contract Type</label>
                                                <select name="employment_details[contract_type]" class="form-control">
                                                    <option value="Full-time">Full-time</option>
                                                    <option value="Part-time">Part-time</option>
                                                    <option value="Casual">Casual</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-sm-6 mb-3">
                                                <label for="preferred_shift" class="form-label">Preferred Shift</label>
                                                <select name="employment_details[schedule]" id="preferred_shift" class="form-control">
                                                    <option value="Day">Day</option>
                                                    <option value="Night">Night</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Supervisor / Line Manager</label>
                                                <input type="text" name="employment_details[supervisor]" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Work Status</label>
                                                <select name="employment_details[status]" class="form-control">
                                                    <option value="Active">Active</option>
                                                    <option value="On Leave">On Leave</option>
                                                    <option value="Suspended">Suspended</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="wizard-nav text-center mt-3">
                                            <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="1">
                                                <i class="fas fa-arrow-left"></i> Back
                                            </button>
                                            <button type="submit" class="fancy-btn fancy-btn-success">
                                                <i class="fas fa-check-circle"></i> Add Staff
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
