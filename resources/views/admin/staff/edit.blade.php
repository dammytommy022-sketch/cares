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
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <i class="fas fa-user-plus" style="font-size: 2em;"></i>
                            </div><!--//icon-holder-->
                            
                        </div><!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">Edit Staff Member: {{ $staff->basic_info['full_name'] ?? '' }}</h4>
                        </div><!--//col-->
                            
                    </div><!--//row-->                   
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary rounded-pill">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div><!--//app-card-header-->
            <div class="app-card-body  px-4 mb-5">
                <div class="pb-5">
                    <div class="tab-pane fade show active " id="all-shift" role="tabpanel" aria-labelledby="all-shift-tab">
                        <div class="app-card  app-card-basic p-4 bg-light shadow rounded-4">
                            {{-- Wizard Tabs --}}
                            <div class="wizard-tabs-wrapper mb-4">
                                <div class="wizard-tabs">
                                    <button class="wizard-tab-btn active" data-step="1"><i class="fas fa-user"></i> Info</button>
                                    <button class="wizard-tab-btn" data-step="2"><i class="fas fa-briefcase"></i> Employment</button>
                                    <button class="wizard-tab-btn" data-step="3"><i class="fas fa-graduation-cap"></i> Qualifications</button>
                                    <button class="wizard-tab-btn" data-step="4"><i class="fas fa-balance-scale"></i> Compliance</button>
                                    <button class="wizard-tab-btn" data-step="5"><i class="fas fa-tasks"></i> Performance</button>
                                    <button class="wizard-tab-btn" data-step="6"><i class="fas fa-phone"></i> Emergency</button>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.staff.update', $staff->id) }}" id="staffForm" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div id="wizardPanels" class="p-3">

                                    <!-- STEP 1: Basic Info -->
                                    <div class="wizard-card step-panel" id="step-1">
                                        <h5 class="fw-bold mb-3">Basic Info</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Full Name</label>
                                                <input type="text" name="basic_info[full_name]" value="{{ $staff->basic_info['full_name'] ?? '' }}" class="form-control required-step-1">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Employee ID / Staff Number</label>
                                                <input type="text" name="basic_info[employee_id]" value="{{ $staff->basic_info['employee_id'] ?? '' }}" class="form-control required-step-1">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Job Title / Role</label>
                                                <input type="text" name="basic_info[role]" value="{{ $staff->basic_info['role'] ?? '' }}" class="form-control required-step-1">
                                            </div>
                                            @php
                                                $teamHouseId = $staff->basic_info['team'] ?? null;
                                            @endphp

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">Department / Team</label>
                                                <select name="basic_info[team]" class="form-control" required>
                                                    <option value="">-- Select Team --</option>
                                                    @foreach($houses as $house)
                                                        <option value="{{ $house->id }}" {{ $teamHouseId == $house->id ? 'selected' : '' }}>
                                                            {{ $house->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3"> 
                                                <label>Contact Phone</label>
                                                <input type="text" name="basic_info[phone]" value="{{ $staff->basic_info['phone'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Contact Email</label>
                                                <input type="email" name="basic_info[email]" value="{{ $staff->basic_info['email'] ?? '' }}" class="form-control">
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
                                            <div class="col-md-6 mb-3">
                                                <label>Start Date in Company</label>
                                                <input type="date" name="employment_details[start_company]" value="{{ $staff->employment_details['start_company'] ?? '' }}" class="form-control required-step-2">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Start Date in Current Assignment</label>
                                                <input type="date" name="employment_details[start_assignment]" value="{{ $staff->employment_details['start_assignment'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Contract Type</label>
                                                <select name="employment_details[contract_type]" class="form-control">
                                                    @foreach(['Full-time','Part-time','Casual'] as $type)
                                                        <option value="{{ $type }}" {{ ($staff->employment_details['contract_type'] ?? '') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Work Schedule / Shift</label>
                                                <select name="employment_details[schedule]" class="form-control">
                                                    @foreach(['Day','Night'] as $type)
                                                        <option value="{{ $type }}" {{ ($staff->employment_details['schedule'] ?? '') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            @php
                                                $currentSupervisorId = $staff->employment_details['supervisor'] ?? null;
                                            @endphp

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">Manager / Team Leader</label>
                                                <select name="employment_details[supervisor]" class="form-control">
                                                    <option value="">-- Select Supervisor --</option>

                                                    @foreach($supervisors as $sup)
                                                        <option value="{{ $sup->id }}" {{ $currentSupervisorId == $sup->id ? 'selected' : '' }}>
                                                            {{ $sup->full_name }} — ({{ $sup->role }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Work Status</label>
                                                <select name="employment_details[status]" class="form-control">
                                                    @foreach(['Active','On Leave','Suspended'] as $status)
                                                        <option value="{{ $status }}" {{ ($staff->employment_details['status'] ?? '') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                    @endforeach
                                                </select>
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

                                    <!-- STEP 3: Qualifications & Training -->
                                    <div class="wizard-card step-panel d-none" id="step-3">
                                        <h5 class="fw-bold mb-3">Qualifications & Training</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>NVQ / Certifications</label>
                                                <input type="text" name="qualifications_training[nvq]" value="{{ $staff->qualifications_training['nvq'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>First Aid / CPR Certification</label>
                                                <input type="text" name="qualifications_training[first_aid]" value="{{ $staff->qualifications_training['first_aid'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Mandatory Training Completed</label>
                                                <textarea name="qualifications_training[mandatory]" class="form-control">{{ $staff->qualifications_training['mandatory'] ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Expiry Dates for Certifications</label>
                                                <input type="text" name="qualifications_training[expiry]" value="{{ $staff->qualifications_training['expiry'] ?? '' }}" class="form-control">
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

                                    <!-- STEP 4: Compliance & Legal -->
                                    <div class="wizard-card step-panel d-none" id="step-4">
                                        <h5 class="fw-bold mb-3">Compliance & Legal</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>DBS / Background Check Status</label>
                                                <input type="text" name="compliance_legal[dbs]" value="{{ $staff->compliance_legal['dbs'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Right to Work Status</label>
                                                <input type="text" name="compliance_legal[right_to_work]" value="{{ $staff->compliance_legal['right_to_work'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Any Restrictions on Work</label>
                                                <input type="text" name="compliance_legal[restrictions]" value="{{ $staff->compliance_legal['restrictions'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Additional Checks</label>
                                                <input type="text" name="compliance_legal[additional]" value="{{ $staff->compliance_legal['additional'] ?? '' }}" class="form-control">
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

                                    <!-- STEP 5: Performance & Notes -->
                                    <div class="wizard-card step-panel d-none" id="step-5">
                                        <h5 class="fw-bold mb-3">Performance & Notes</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Assigned Residents / Clients</label>
                                                <textarea name="performance_notes[assigned]" class="form-control">{{ $staff->performance_notes['assigned'] ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Recent Appraisals / Reviews</label>
                                                <textarea name="performance_notes[appraisals]" class="form-control">{{ $staff->performance_notes['appraisals'] ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Incident Reports Involved</label>
                                                <textarea name="performance_notes[incidents]" class="form-control">{{ $staff->performance_notes['incidents'] ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Additional Notes / Observations</label>
                                                <textarea name="performance_notes[notes]" class="form-control">{{ $staff->performance_notes['notes'] ?? '' }}</textarea>
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

                                    <!-- STEP 6: Emergency & Contact -->
                                    <div class="wizard-card step-panel d-none" id="step-6">
                                        <h5 class="fw-bold mb-3">Emergency & Contact</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Emergency Contact Name</label>
                                                <input type="text" name="emergency_contact[name]" value="{{ $staff->emergency_contact['name'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Emergency Contact Phone</label>
                                                <input type="text" name="emergency_contact[phone]" value="{{ $staff->emergency_contact['phone'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Health Notes Relevant to Work</label>
                                                <textarea name="emergency_contact[health_notes]" class="form-control">{{ $staff->emergency_contact['health_notes'] ?? '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="wizard-nav text-center mt-3">
                                            <button type="button" class="fancy-btn fancy-btn-secondary prevBtn" data-prev="5">
                                                <i class="fas fa-arrow-left"></i> Back
                                            </button>
                                            <button type="submit" class="fancy-btn fancy-btn-success">
                                                <i class="fas fa-check-circle"></i> Update Staff
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
document.addEventListener('DOMContentLoaded', function() {
    const nextBtns = document.querySelectorAll('.nextBtn');
    const prevBtns = document.querySelectorAll('.prevBtn');
    const tabs = document.querySelectorAll('.wizard-tab-btn');
    const panels = document.querySelectorAll('.step-panel');

    nextBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const nextId = btn.dataset.next;
            showStep(nextId);
        });
    });

    prevBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const prevId = btn.dataset.prev;
            showStep(prevId);
        });
    });

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            showStep(tab.dataset.step);
        });
    });

    function showStep(step) {
        panels.forEach(p => p.classList.add('d-none'));
        document.getElementById(`step-${step}`).classList.remove('d-none');

        tabs.forEach(t => t.classList.remove('active'));
        const activeTab = document.querySelector(`.wizard-tab-btn[data-step="${step}"]`);
        if(activeTab) activeTab.classList.add('active');
    }
});
</script>
@endsection
