@extends('admin.layout.header')

@section('content')
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
                            <h4 class="app-card-title">Daily Records</h4>
                            <small class="text-muted">Manage and Update records</small>

                        </div><!--//col-->
                            
                    </div><!--//row-->  
                    <div>
                        <a href="{{ route('admin.records') }}" class="btn btn-secondary rounded-pill">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                
            </div><!--//app-card-header-->
            <div class="app-card-body  px-4  pb-2"> 
                <div class="show-view">
                    <div class="tab-pane fade show active" id="all-shift" role="tabpanel" aria-labelledby="all-shift-tab">
                        <div class="app-card app-card-orders-table shadow rounded-4 mb-5">
                            <div class="app-card-body">
                                <div class="app-content pt-4 p-md-3 p-lg-4">
                                    <div class="container-xl">

                                        {{-- Header --}}
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{asset('assets/images/user.png')}}"
                                                    class="rounded-circle"
                                                    width="50" height="50">

                                                <div>
                                                    <h5 class="mb-0">{{ $resident->fullname ?? 'Resident Name' }}</h5>
                                                    <small class="text-muted">
                                                        Resident ID {{ $resident->resident_id ?? '—' }}
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2">
                                                <button class="btn btn-outline-primary">Add Note</button>
                                                <button class="btn btn-outline-success">Call GP</button>
                                                <button class="btn btn-primary">Log Care</button>
                                            </div>
                                        </div>

                                        {{-- Card --}}
                                        <div class="card shadow-sm">
                                            <div class="card-body">

                                                {{-- Tabs --}}
                                                <ul class="nav nav-tabs mb-4" role="tablist">
                                                    <li class="nav-item">
                                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#dailyCare">
                                                            Daily Care 
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#diet">
                                                           Meal
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#carePlan">
                                                            Care Plan
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#risk">
                                                            Risk Assessments
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#wound">
                                                            Wound Records
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#behaviour">
                                                            Behaviour Monitoring
                                                        </button>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">

                                                    {{-- DAILY CARE --}}
                                                    <div class="tab-pane fade show active" id="dailyCare">
                                                        <div class="mb-3 d-flex gap-2 flex-wrap">
                                                            @foreach (['Personal Care','Mobility','Toileting'] as $task)
                                                                <button class="btn btn-sm btn-outline-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#dailyCareModal">
                                                                    {{ $task }}
                                                                </button>
                                                            @endforeach
                                                        </div>

                                                        <div class="table-responsive">
                                                            <table class="table table-bordered align-middle">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Task</th>
                                                                        <th>Completed</th>
                                                                        <th>Staff</th>
                                                                        <th>Notes</th>
                                                                        <th>Done</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="dailyCareTable">
                                                                    @forelse($records as $record)
                                                                    <tr>
                                                                        <td>{{ $record->date }}</td>
                                                                        <td>{{ $record->task_type }}</td>
                                                                        <td>
                                                                            <span class="badge {{ $record->completed ? 'bg-success' : 'bg-secondary' }}">
                                                                                {{ $record->completed ? 'Yes' : 'No' }}
                                                                            </span>
                                                                        </td>
                                                                        <td>{{ $record->staff_initials }}</td>
                                                                        <td>{{ $record->notes }}</td>
                                                                        <td>
                                                                            <input type="checkbox"
                                                                                class="mark-done"
                                                                                data-id="{{ $record->id }}"
                                                                                {{ $record->completed ? 'checked' : '' }}>
                                                                        </td>

                                                                    </tr>
                                                                    @empty
                                                                    <tr>
                                                                        <td colspan="6" class="text-center text-muted">No records yet</td>
                                                                    </tr>
                                                                    @endforelse
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- Diet & Nutrition --}}
                                                    <div class="tab-pane fade" id="diet">
                                                        <div class="card mb-4">
                                                            <div class="card-body">

                                                                <div class="mb-3">
                                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quickAddMealModal">
                                                                        <i class="fas fa-utensils"></i> Quick Add Meal
                                                                    </button>

                                                                </div>

                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-hover">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Date</th>
                                                                                <th>Meal</th>
                                                                                <th>Portion</th>
                                                                                <th>Fluids</th>
                                                                                <th>Staff</th>
                                                                                <th>Notes</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            {{-- Activities --}}
                                                                            @foreach ($meals as $meal)
                                                                            <tr>
                                                                                <td>{{ $meal->date }}</td>
                                                                                <td>{{ $meal->meal }}</td>
                                                                                <td>{{ $meal->portion }}</td>
                                                                                <td>{{ $meal->fluids }}</td>
                                                                                <td>{{ $meal->employee_id }}</td>
                                                                                <td>{{ $meal->notes }}</td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- CARE PLAN --}}
                                                    <div class="tab-pane fade" id="carePlan">
                                                        <div class="border rounded p-3 bg-light">
                                                            <h6 class="fw-bold mb-2">Resident Goals & Interventions</h6>
                                                            <p class="text-muted mb-3">
                                                                Editable care plan details will appear here.
                                                            </p>

                                                            <div class="d-flex gap-2">
                                                                <button class="btn btn-outline-primary btn-sm">Edit Plan</button>
                                                                <button class="btn btn-outline-success btn-sm">Add Goal</button>
                                                                <button class="btn btn-outline-secondary btn-sm">Print Summary</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- RISK ASSESSMENT --}}
                                                    <div class="tab-pane fade" id="risk">
                                                        <div class="d-flex gap-3 mb-3">
                                                            <span class="badge bg-info">Low Risk</span>
                                                            <span class="badge bg-warning text-dark">Medium Risk</span>
                                                            <span class="badge bg-danger">High Risk</span>
                                                        </div>

                                                        <button class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal"
                                                                    data-bs-target="#addRiskModal">
                                                            Add New Risk
                                                        </button>

                                                        
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered align-middle">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Risk Type</th>
                                                                        <th>Risk Level</th> 
                                                                        <th>Description</th>
                                                                        <th>Controls</th>
                                                                        <th>Staff</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="dailyCareTable">
                                                                    @forelse($risks as $risk)
                                                                    <tr>
                                                                        <td>{{ $risk->created_at }}</td>
                                                                        <td>{{ $risk->risk_type }}</td>
                                                                        <td>

                                                                            <span class="badge {{ $risk->risk_level ? 'bg-info' : ($risk->risk_level == 'Medium' ? 'bg-warning' : ($risk->risk_level == 'High' ? 'bg-danger' : 'bg-secondary')) }}">

                                                                                {{ $risk->risk_level ? 'Low' : ($risk->risk_level == 'Medium' ? 'Medium' : ($risk->risk_level == 'High' ? 'High' : 'Unknown')) }}
                                                                            </span>

                                                                        </td>
                                                                        <td>{{ $risk->description }}</td>
                                                                        <td>{{ $risk->controls }}</td>
                                                                        <td>{{ $risk->staff_initials }}</td>
                                                                        

                                                                    </tr>
                                                                    @empty
                                                                    <tr>
                                                                        <td colspan="6" class="text-center text-muted">No records yet</td>
                                                                    </tr>
                                                                    @endforelse
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>

                                                    {{-- WOUND RECORDS --}}
                                                    <div class="tab-pane fade" id="wound">
                                                        <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal"
                                                                    data-bs-target="#addWoundModal">
                                                            Add New Entry
                                                        </button>

                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Type</th>
                                                                        <th>Location</th>
                                                                        <th>Dressing</th>
                                                                        <th>Notes</th>
                                                                        <th>Staff</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="dailyCareTable">
                                                                    @forelse($wounds as $wound)
                                                                    <tr>
                                                                        <td>{{ $wound->created_at }}</td>
                                                                        <td>{{ $wound->wound_type }}</td>
                                                                        <td>
                                                                            <span class="badge {{ $wound->location ? 'bg-info' : 'bg-secondary' }}">
                                                                                {{ $wound->location ?? 'Unknown' }}
                                                                            </span>
                                                                        </td>
                                                                        <td>{{ $wound->dressing }}</td>
                                                                        <td>{{ $wound->notes }}</td>
                                                                        <td>{{ $wound->staff_initials }}</td>
                                                                        

                                                                    </tr>
                                                                    @empty
                                                                    <tr>
                                                                        <td colspan="6" class="text-center text-muted">No records yet</td>
                                                                    </tr>
                                                                    @endforelse
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    {{-- BEHAVIOUR --}}
                                                    <div class="tab-pane fade" id="behaviour">
                                                            
                                                            
                                                           
                                                        <button class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal"
                                                            data-bs-target="#addBehaviourModal">
                                                            Add Incident
                                                        </button>
                                                            

                                                        
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Type</th>
                                                                        <th>Description</th>
                                                                        <th>Action Taken</th>
                                                                        <th>Staff</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="dailyCareTable">
                                                                    @forelse($behaviours as $behaviour)
                                                                    <tr>
                                                                        <td>{{ $behaviour->created_at }}</td>
                                                                        <td>{{ $behaviour->incident_type }}</td>
                                                                        <td>{{ $behaviour->description }}</td>
                                                                        <td>{{ $behaviour->action_taken }}</td>
                                                                        <td>{{ $behaviour->staff_initials }}</td>
                                                                        

                                                                    </tr>
                                                                    @empty
                                                                    <tr>
                                                                        <td colspan="6" class="text-center text-muted">No records yet</td>
                                                                    </tr>
                                                                    @endforelse
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

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


{{-- Daily Care Modal --}}
<div class="modal fade" id="dailyCareModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Daily Care Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form onsubmit="event.preventDefault(); submitForm(this, '{{ route('admin.dailyRecord.dailyCare.store') }}')">
                @csrf

                <div class="modal-body">
                    <input type="hidden" name="resident_id" value="{{ $resident->resident_id }}">

                    {{-- Validation Errors --}}
                    <div id="dailyCareErrors" class="alert alert-danger d-none"></div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Care Type</label>
                            <select name="task_type" class="form-control" required>
                                <option value="">Select</option>
                                <option>Personal Care</option>
                                <option>Meals</option>
                                <option>Mobility</option>
                                <option>Toileting</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Completed?</label>
                            <select name="completed" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Staff Initials</label>
                            <input type="text" name="staff_initials" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" rows="3" class="form-control"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" id="dailyCareSubmit">
                        Save Record
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Quick Add Meal Modal -->
<div class="modal fade" id="quickAddMealModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Quick Add Meal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- <form method="POST" action="#"> -->
            <form onsubmit="event.preventDefault(); submitForm(this, '{{ route('admin.lifestyle.meals.store') }}')">

                @csrf
                <div class="modal-body">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Resident ID</label>
                            <input type="text" class="form-control" name="resident_id" value="{{ $resident->resident_id }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Meal</label>
                            <select class="form-select" name="meal" required>
                                <option>Breakfast</option>
                                <option>Lunch</option>
                                <option>Dinner</option>
                                <option>Snack</option>
                            </select>
                        </div>

                        

                        <div class="col-md-3">
                            <label class="form-label">Portion</label>
                            <select class="form-select" name="portion">
                                <option>Full</option>
                                <option>Half</option>
                                <option>Small</option>
                                <option>Refused</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fluids (ml)</label>
                            <input type="number" class="form-control" name="fluids" placeholder="e.g. 500">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="3" name="notes"></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        Save Meal
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Add Risk Modal --}}
<div class="modal fade" id="addRiskModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Risk Assessment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form onsubmit="event.preventDefault(); submitForm(this, '{{ route('admin.dailyRecord.storeRisk.store') }}')">
                @csrf
                <input type="hidden" name="resident_id" value="{{ $resident->resident_id }}">

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Risk Type</label>
                            <input type="text" name="risk_type" class="form-control"
                                   placeholder="e.g. Self-harm, Absconding" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Risk Level</label>
                            <select name="risk_level" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Triggers / Description</label>
                            <textarea name="description" rows="3"
                                      class="form-control"
                                      placeholder="Describe the risk..."></textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Control Measures</label>
                            <textarea name="controls" rows="3"
                                      class="form-control"
                                      placeholder="Actions to reduce the risk"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save Risk</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Add Wound Modal --}}
<div class="modal fade" id="addWoundModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Wound Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form onsubmit="event.preventDefault(); submitForm(this, '{{ route('admin.dailyRecord.storeWound.store') }}')">
                @csrf
                <input type="hidden" name="resident_id" value="{{ $resident->resident_id }}">

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Wound Type</label>
                            <input type="text" name="wound_type" class="form-control"
                                   placeholder="Bruise, Cut, Pressure sore" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control"
                                   placeholder="Arm, Leg, Back" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Dressing Applied</label>
                            <input type="text" name="dressing" class="form-control"
                                   placeholder="Bandage, Gauze">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" rows="3" class="form-control"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Staff Initials</label>
                            <input type="text" name="staff_initials"
                                   class="form-control" required>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save Record</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Add Behaviour Incident Modal --}}
<div class="modal fade" id="addBehaviourModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Behaviour Incident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form onsubmit="event.preventDefault(); submitForm(this, '{{ route('admin.dailyRecord.storeBehaviour.store') }}')">
                @csrf
                <input type="hidden" name="resident_id" value="{{ $resident->resident_id }}">

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Incident Type</label>
                            <select name="incident_type" class="form-control" required>
                                <option value="">Select</option>
                                <option>Aggression</option>
                                <option>Withdrawal</option>
                                <option>Property Damage</option>
                                <option>Self Harm</option>
                                <option>Absconding</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3"
                                      class="form-control"
                                      placeholder="What happened?"></textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Action Taken</label>
                            <textarea name="action_taken" rows="3"
                                      class="form-control"
                                      placeholder="How was it managed?"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Staff Initials</label>
                            <input type="text" name="staff_initials" class="form-control" required>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Save Incident</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    document.querySelectorAll('[data-bs-target="#dailyCareModal"]').forEach(btn => {
        btn.addEventListener('click', () => {
            const task = btn.innerText.trim();
            const select = document.querySelector('#dailyCareModal select[name="task_type"]');
            if (select) select.value = task;
        });
    });
</script>
<script>
    document.querySelectorAll('.mark-done').forEach(el => {
        el.addEventListener('change', function () {
            fetch(`/admin/dailyCare/${this.dataset.id}/toggle`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(() => location.reload());
        });
    });
</script>


<script>
    function submitForm(form, url) {
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: new FormData(form)
        })
        .then(res => {
            if (!res.ok) throw res;
            return res.json();
        })
        .then(data => {
            showToast(data.message || 'Saved successfully');

            // Hide modal
            const modalEl = form.closest('.modal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();

            // Reset form
            form.reset();

            // 🔄 Reload page (slight delay so toast is visible)
            setTimeout(() => {
                window.location.reload();
            }, 800);
        })
        .catch(async err => {
            let message = 'Error saving data';

            if (err.json) {
                const errorData = await err.json();
                message = errorData.message || message;
            }

            showToast(message, true);
        });
    }
</script>

@endsection

