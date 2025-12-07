@extends('admin.layout.header')

@section('content')
<div class="app-content pt-4 p-md-3 p-lg-4">
    <div class="container-xl">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Add New Resident</h3>
            <a href="{{ route('admin.residents.index') }}" class="btn btn-secondary">Back to Residents</a>
        </div>

        <form method="POST" action="{{ route('admin.residents.store') }}" enctype="multipart/form-data" id="residentForm">
            @csrf

            {{-- Progress Bar --}}
            <div class="progress mb-4" style="height: 25px;">
                <div id="wizardProgress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                    style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">Step 1 of 10</div>
            </div>

            {{-- Wizard Steps --}}
            <div id="wizard">

                {{-- ================= Step 1: Basic Personal Information ================= --}}
                <div class="step card p-4 mb-3" data-step="1">
                    <h4>Basic Personal Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Full Name</label><input type="text" name="basic_info[full_name]" class="form-control" required></div>
                        <div class="col-md-6 mb-3"><label>Preferred Name</label><input type="text" name="basic_info[preferred_name]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Date of Birth</label><input type="date" name="basic_info[dob]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Gender</label>
                            <select name="basic_info[gender]" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3"><label>Ethnicity / Cultural Background</label><input type="text" name="basic_info[ethnicity]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Primary Language & Communication Needs</label><input type="text" name="basic_info[language]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Religion</label><input type="text" name="basic_info[religion]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Nationality</label><input type="text" name="basic_info[nationality]" class="form-control"></div>
                    </div>
                </div>

                {{-- ================= Step 2: Parent / Guardian / Legal Authority ================= --}}
                <div class="step card p-4 mb-3 " data-step="2">
                    <h4>Parent / Guardian / Legal Authority</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Parents’ Names</label><input type="text" name="guardian_info[parents]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Contact Details</label><input type="text" name="guardian_info[contact]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Legal Guardian / Social Worker</label><input type="text" name="guardian_info[guardian]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Social Worker Phone & Email</label><input type="text" name="guardian_info[social_worker]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Local Authority Responsible</label><input type="text" name="guardian_info[local_authority]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Emergency Contact Details</label><input type="text" name="guardian_info[emergency_contact]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Authorized Visitors</label><input type="text" name="guardian_info[authorized_visitors]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Restricted Persons</label><input type="text" name="guardian_info[restricted_persons]" class="form-control"></div>
                    </div>
                </div>

                {{-- ================= Step 3: Placement Information ================= --}}
                <div class="step card p-4 mb-3 " data-step="3">
                    <h4>Placement Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Placement Start Date</label><input type="date" name="placement_info[start_date]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Reason for Referral</label><input type="text" name="placement_info[referral_reason]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Type of Placement</label>
                            <select name="placement_info[type]" class="form-control">
                                <option value="">Select Type</option>
                                <option value="Short-term">Short-term</option>
                                <option value="Long-term">Long-term</option>
                                <option value="Emergency">Emergency</option>
                                <option value="Respite">Respite</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3"><label>Placement Plan / Care Plan Documents</label><input type="file" name="placement_info[plan_documents][]" multiple class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Risk Assessment Reports</label><input type="file" name="placement_info[risk_reports][]" multiple class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Previous Placements & Outcomes</label><textarea name="placement_info[previous_placements]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Expectations & Goals</label><textarea name="placement_info[goals]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Cultural / Personal Preferences</label><textarea name="placement_info[preferences]" class="form-control"></textarea></div>
                    </div>
                </div>

                {{-- ================= Step 4: Medical & Health Information ================= --}}
                <div class="step card p-4 mb-3 " data-step="4">
                    <h4>Medical & Health Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>NHS Number</label><input type="text" name="health_info[nhs_number]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>GP Details</label><input type="text" name="health_info[gp]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Hospital Consultant</label><input type="text" name="health_info[hospital]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Current Diagnoses</label><textarea name="health_info[diagnoses]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Allergies</label><textarea name="health_info[allergies]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Medications</label><textarea name="health_info[medications]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Medical History</label><textarea name="health_info[history]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Immunisation Records</label><textarea name="health_info[immunisation]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Dietary Needs</label><textarea name="health_info[dietary]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Special Equipment</label><textarea name="health_info[equipment]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Mental Health Risks</label><textarea name="health_info[mental_health_risks]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Health Appointments Schedule</label><textarea name="health_info[appointments]" class="form-control"></textarea></div>
                    </div>
                </div>

                {{-- ================= Step 5: Education Information ================= --}}
                <div class="step card p-4 mb-3 " data-step="5">
                    <h4>Education Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Current School / Provider</label><input type="text" name="education_info[school]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>School Contact Info</label><input type="text" name="education_info[contact]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>SEN Status</label><input type="text" name="education_info[sen_status]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>EHCP Details</label><textarea name="education_info[ehcp]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Attendance History</label><textarea name="education_info[attendance]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Learning Level / Academic Needs</label><textarea name="education_info[learning_level]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Behaviour in School</label><textarea name="education_info[behaviour]" class="form-control"></textarea></div>
                    </div>
                </div>

                {{-- ================= Step 6: Behavioural & Risk Information ================= --}}
                <div class="step card p-4 mb-3 " data-step="6">
                    <h4>Behavioural & Risk Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Triggers</label><textarea name="behaviour_info[triggers]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Behavioural Concerns</label><textarea name="behaviour_info[concerns]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Known Risks</label><textarea name="behaviour_info[risks]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>De-escalation Strategies</label><textarea name="behaviour_info[deescalation]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>History of Trauma / Abuse / Neglect</label><textarea name="behaviour_info[trauma_history]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Preferred Communication Style</label><textarea name="behaviour_info[communication]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Positive Behaviours / Strengths</label><textarea name="behaviour_info[strengths]" class="form-control"></textarea></div>
                    </div>
                </div>

                {{-- ================= Step 7: Social & Family Information ================= --}}
                <div class="step card p-4 mb-3 " data-step="7">
                    <h4>Social & Family Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Siblings & Relationships</label><input type="text" name="social_info[siblings]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Contact Schedule with Family</label><input type="text" name="social_info[contact_schedule]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Cultural / Community Needs</label><textarea name="social_info[cultural]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Important Relationships</label><textarea name="social_info[relationships]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Hobbies & Interests</label><textarea name="social_info[hobbies]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Religious / Community Commitments</label><textarea name="social_info[community]" class="form-control"></textarea></div>
                    </div>
                </div>

                {{-- ================= Step 8: Legal & Safeguarding Information ================= --}}
                <div class="step card p-4 mb-3 " data-step="8">
                    <h4>Legal & Safeguarding Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Court Orders</label><textarea name="legal_info[court_orders]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Police Involvement</label><textarea name="legal_info[police]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Safeguarding Concerns</label><textarea name="legal_info[safeguarding]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Offending Behaviour History</label><textarea name="legal_info[offending]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Consent Forms</label><textarea name="legal_info[consent]" class="form-control"></textarea></div>
                    </div>
                </div>

                {{-- ================= Step 9: Daily Living Needs ================= --}}
                <div class="step card p-4 mb-3 " data-step="9">
                    <h4>Daily Living Needs</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Sleeping Pattern</label><input type="text" name="daily_info[sleep]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Personal Care Needs</label><input type="text" name="daily_info[care]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Mobility Needs</label><input type="text" name="daily_info[mobility]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Communication Preferences</label><input type="text" name="daily_info[communication]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Routine Needs</label><textarea name="daily_info[routine]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Sensory Needs</label><textarea name="daily_info[sensory]" class="form-control"></textarea></div>
                        <div class="col-md-6 mb-3"><label>Clothing Sizes</label><input type="text" name="daily_info[clothing]" class="form-control"></div>
                    </div>
                </div>

                {{-- ================= Step 10: Documents to Upload ================= --}}
                <div class="step card p-4 mb-3 " data-step="10">
                    <h4>Documents to Upload</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Birth Certificate</label><input type="file" name="documents[birth_certificate]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Passport or ID</label><input type="file" name="documents[id_passport]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Care Plan</label><input type="file" name="documents[care_plan]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Risk Assessment</label><input type="file" name="documents[risk_assessment]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Behaviour Plan</label><input type="file" name="documents[behaviour_plan]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>EHCP</label><input type="file" name="documents[ehcp]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Medical Reports</label><input type="file" name="documents[medical_reports]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Consent Forms</label><input type="file" name="documents[consent_forms]" class="form-control"></div>
                        <div class="col-md-6 mb-3"><label>Social Worker Referral Form</label><input type="file" name="documents[social_worker]" class="form-control"></div>
                    </div>
                </div>

            </div>

            {{-- Navigation Buttons --}}
            <div class="mt-3 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" id="prevBtn">Previous</button>
                <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                <button type="submit" class="btn btn-success " id="submitBtn">Submit</button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("[DEBUG] DOM fully loaded");

    const steps = Array.from(document.querySelectorAll('.step'));
    console.log("[DEBUG] Number of steps found:", steps.length);

    if (steps.length === 0) {
        console.error("[ERROR] No steps found! Check your .step divs.");
        return;
    }

    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    const progressBar = document.getElementById('wizardProgress');

    if (!nextBtn || !prevBtn || !submitBtn || !progressBar) {
        console.error("[ERROR] One or more navigation elements not found!");
        return;
    }

    let currentStep = 0;

    function showStep(index) {
        console.log("[DEBUG] Showing step:", index + 1);
        steps.forEach((step, i) => {
            if(i === index) {
                step.style.display = 'block';
                console.log("[DEBUG] Step", i+1, "set to block");
            } else {
                step.style.display = 'none';
                console.log("[DEBUG] Step", i+1, "hidden");
            }
        });
        prevBtn.disabled = index === 0;
        nextBtn.style.display = index === steps.length - 1 ? 'none' : 'inline-block';
        submitBtn.style.display = index === steps.length - 1 ? 'inline-block' : 'none';
        progressBar.style.width = ((index + 1) / steps.length * 100) + '%';
        progressBar.innerText = `Step ${index + 1} of ${steps.length}`;
    }


    nextBtn.addEventListener('click', function() {
        console.log("[DEBUG] Next button clicked");
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        } else {
            console.log("[DEBUG] Already at last step");
        }
    });

    prevBtn.addEventListener('click', function() {
        console.log("[DEBUG] Previous button clicked");
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        } else {
            console.log("[DEBUG] Already at first step");
        }
    });

    showStep(currentStep);
});
</script>
@endsection
