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
                            <h4 class="app-card-title">Safeguarding & Compliance</h4>
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
                                    
                                    <div class="container-fluid py-4">

                                        {{-- Header --}}
                                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                           

                                            <div class="d-flex gap-2 ">
                                                <button class="btn btn-danger btn-sm">Overdue Incidents</button>
                                                <button class="btn btn-danger btn-sm">DoLS Reviews Due</button>
                                                <button class="btn btn-danger btn-sm">Accident Alerts</button>
                                            </div>
                                        </div>

                                        {{-- Tabs --}}
                                        <ul class="nav nav-tabs mb-4" role="tablist">
                                            <li class="nav-item">
                                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#incidents">
                                                    Incident / Accident Reporting
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#restraints">
                                                    Challenging Behaviour / Restraint
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#dols">
                                                    DoLS Records
                                                </button>
                                            </li>
                                        </ul>

                                        <div class="tab-content">

                                            {{-- INCIDENTS TAB --}}
                                            <div class="tab-pane fade show active" id="incidents">
                                                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#incidentModal">
                                                    New Incident
                                                </button>

                                                <div class="table-responsive">
                                                    <table class="table table-bordered align-middle">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Type</th>
                                                                <th>Resident</th>
                                                                <th>Action Taken</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="dailyCareTable">
                                                            @forelse($incidents as $incident)
                                                            <tr>
                                                                <td>{{ $incident->created_at }}</td>
                                                                <td>{{ $incident->incident_type }}</td>
                                                                <td>{{ $incident->resident->fullname ?? 'N/A' }}</td>
                                                                <td>{{ $incident->action_taken }}</td>
                                                                <td>                                                                    
                                                                    <span class="badge {{ $incident->status ? 'bg-info' : ($incident->status == 'Under Review' ? 'bg-warning' : ($incident->status == 'Monitored' ? 'bg-danger' : ($risk->incident == 'Closed' ? 'bg-secondary' : 'bg-success'))) }}">
                                                                        {{ $incident->status ? 'Open' : ($incident->status == 'Under Review' ? 'Under Review' : ($incident->status == 'Monitored' ? 'Monitored' : ($incident->status == 'Closed' ? 'Closed' : 'Unknown'))) }}
                                                                    </span>
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

                                            {{-- RESTRAINTS TAB --}}
                                            <div class="tab-pane fade" id="restraints">
                                                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#restraintModal">
                                                    Add New Record
                                                </button>

                                                <div class="card bg-light border">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered align-middle">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Type</th>
                                                                        <th>Resident</th>
                                                                        <th>Trigger</th>
                                                                        <th>Restraint Method</th>
                                                                        <th>Severity</th>
                                                                        <th>Duration</th>
                                                                        <th>Intervention</th>
                                                                        <th>Outcome</th>
                                                                        <th>Injury Occurred</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="dailyCareTable">
                                                                    @forelse($restraints as $restraint)
                                                                    <tr>
                                                                        <td>{{ $restraint->incident_datetime }}</td>
                                                                        <td>{{ $restraint->record_type }}</td>
                                                                        <td>{{ $restraint->resident->fullname ?? 'N/A' }}</td>
                                                                        <td>{{ $restraint->trigger }}</td>
                                                                        <td>{{ $restraint->restraint_method }}</td>
                                                                        <td>
                                                                            @if($restraint->severity == 'Low')
                                                                                <span class="badge bg-success">Low</span>
                                                                            @elseif($restraint->severity == 'Medium')
                                                                                <span class="badge bg-warning">Medium</span>
                                                                            @elseif($restraint->severity == 'High')
                                                                                <span class="badge bg-danger">High</span>
                                                                            @else
                                                                                <span class="badge bg-secondary">Unknown</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $restraint->duration_minutes }} minutes</td>
                                                                        <td>{{ $restraint->intervention_details }}</td>
                                                                        <td>{{ $restraint->outcome }}</td>
                                                                        <td>{{ $restraint->injury_occurred ? 'Yes' : 'No' }}</td>
                                                                       
                                                                        

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

                                            {{-- DOLS TAB --}}
                                            <div class="tab-pane fade" id="dols">
                                                <div class="card border">
                                                    <div class="card-body">
                                                        <h5 class="fw-semibold mb-3">Resident DoLS Records</h5>

                                                        <div class="mb-3">
                                                            <label class="form-label">Select Resident</label>
                                                            <select class="form-select">
                                                                <option value="">Select Resident</option>
                                                                <option>Resident 1</option>
                                                                <option>Resident 2</option>
                                                            </select>
                                                        </div>

                                                        <div class="d-flex gap-2">
                                                            <button class="btn btn-outline-primary">View Details</button>
                                                            <button class="btn btn-outline-success">Update</button>
                                                            <button class="btn btn-outline-warning">Review Date</button>
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





<style>
    .modal-dialog-scrollable .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }

</style>

{{-- INCIDENT / ACCIDENT MODAL --}}
<div class="modal fade" id="incidentModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">New Incident / Accident</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form onsubmit="event.preventDefault(); submitForm(this, '{{ route('admin.dailyRecord.storeIncident.store') }}')">
                @csrf

                <div class="modal-body">
                    <div class="row g-3">

                        {{-- Date --}}
                        <div class="col-md-6">
                            <label class="form-label">Incident Date</label>
                            <input type="date" name="incident_date" class="form-control" required>
                        </div>

                        {{-- Type --}}
                        <div class="col-md-6">
                            <label class="form-label">Incident Type</label>
                            <select name="incident_type" class="form-select" required>
                                <option value="">Select</option>
                                <option>Fall</option>
                                <option>Medication Error</option>
                                <option>Injury</option>
                                <option>Behavioural Incident</option>
                                <option>Safeguarding Concern</option>
                                <option>Other</option>
                            </select>
                        </div>

                        {{-- Resident --}}
                        <div class="col-md-6">
                            <label class="form-label">Resident</label>
                            <select name="resident_id" class="form-select" required>
                                <option value="">Select Resident</option>
                                @foreach($residents ?? [] as $resident)
                                    <option value="{{ $resident->resident_id }}">
                                        {{ $resident->fullname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Open">Open</option>
                                <option value="Under Review">Under Review</option>
                                <option value="Monitored">Monitored</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>

                        {{-- Action Taken --}}
                        <div class="col-md-12">
                            <label class="form-label">Immediate Action Taken</label>
                            <textarea name="action_taken" rows="2"
                                class="form-control"
                                placeholder="e.g. First aid administered, GP informed..."
                                required></textarea>
                        </div>

                        {{-- Notes --}}
                        <div class="col-md-12">
                            <label class="form-label">Additional Notes</label>
                            <textarea name="notes" rows="3"
                                class="form-control"
                                placeholder="Further observations, witnesses, follow-ups..."></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save Incident
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- CHALLENGING BEHAVIOUR / RESTRAINT MODAL --}}
<div class="modal fade" id="restraintModal" tabindex="-1">
    <!-- <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"> -->
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Challenging Behaviour / Restraint Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- <form action="{{ route('admin.dailyRecord.storeRestraint.store') }}" method="POST"> -->
            <form onsubmit="event.preventDefault(); submitForm(this, '{{ route('admin.dailyRecord.storeRestraint.store') }}')">
            
                @csrf

                <div class="modal-body">
                    <div class="row g-3">

                        {{-- Date --}}
                        <div class="col-md-6">
                            <label class="form-label">Incident Date</label>
                            <input type="date" name="incident_date" class="form-control" required>
                        </div>

                        {{-- Time --}}
                        <div class="col-md-6">
                            <label class="form-label">Time</label>
                            <input type="time" name="incident_time" class="form-control" required>
                        </div>

                        {{-- Resident --}}
                        <div class="col-md-6">
                            <label class="form-label">Resident</label>
                            <select name="resident_id" class="form-select" required>
                                <option value="">Select Resident</option>
                                @foreach($residents ?? [] as $resident)
                                    <option value="{{ $resident->resident_id }}">
                                        {{ $resident->fUllname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Behaviour Type --}}
                        <div class="col-md-6">
                            <label class="form-label">Behaviour Type</label>
                            <select name="behaviour_type" class="form-select" required>
                                <option value="">Select</option>
                                <option>Aggression</option>
                                <option>Self-harm</option>
                                <option>Verbal Abuse</option>
                                <option>Property Damage</option>
                                <option>Absconding Risk</option>
                                <option>Other</option>
                            </select>
                        </div>

                        {{-- Was restraint used --}}
                        <div class="col-md-6">
                            <label class="form-label">Was Restraint Used?</label>
                            <select name="restraint_used" class="form-select" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        {{-- Type of restraint --}}
                        <div class="col-md-6">
                            <label class="form-label">Type of Restraint</label>
                            <select name="restraint_type" class="form-select">
                                <option value="">N/A</option>
                                <option>Physical</option>
                                <option>Mechanical</option>
                                <option>Environmental</option>
                                <option>Chemical</option>
                            </select>
                        </div>

                        {{-- Duration --}}
                        <div class="col-md-6">
                            <label class="form-label">Duration (minutes)</label>
                            <input type="number" name="duration_minutes" class="form-control" min="1">
                        </div>

                        {{-- De-escalation --}}
                        <div class="col-md-6">
                            <label class="form-label">De-escalation Attempted?</label>
                            <select name="deescalation_attempted" class="form-select" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        {{-- Trigger --}}
                        <div class="col-md-12">
                            <label class="form-label">Trigger / Cause</label>
                            <textarea name="trigger" rows="2" class="form-control"
                                placeholder="What triggered the behaviour?"></textarea>
                        </div>

                        {{-- Action Taken --}}
                        <div class="col-md-12">
                            <label class="form-label">Action Taken</label>
                            <textarea name="action_taken" rows="3" class="form-control"
                                placeholder="Describe how staff responded" required></textarea>
                        </div>

                        {{-- Outcome --}}
                        <div class="col-md-12">
                            <label class="form-label">Outcome</label>
                            <textarea name="outcome" rows="2" class="form-control"
                                placeholder="How did the situation resolve?"></textarea>
                        </div>

                        {{-- Injury --}}
                        <div class="col-md-6">
                            <label class="form-label">Any Injury?</label>
                            <select name="injury_occurred" class="form-select">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        {{-- Review Status --}}
                        <div class="col-md-6">
                            <label class="form-label">Review Status</label>
                            <select name="review_status" class="form-select" required>
                                <option value="Pending">Pending</option>
                                <option value="Reviewed">Reviewed</option>
                                <option value="Escalated">Escalated</option>
                            </select>
                        </div>

                        {{-- Staff --}}
                        <div class="col-md-6">
                            <label class="form-label">Staff Initials</label>
                            <input type="text" name="staff_initials" class="form-control"
                                   placeholder="e.g. AB" required>
                        </div>

                        {{-- Notes --}}
                        <div class="col-md-12">
                            <label class="form-label">Additional Notes</label>
                            <textarea name="notes" rows="3" class="form-control"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Save Record
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

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
