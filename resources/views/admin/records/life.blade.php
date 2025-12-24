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
                            <h4 class="app-card-title">Lifestyle & Activities</h4>
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

                                        {{-- Page Header --}}
                                        <div class="mb-4">
                                            <div class="card border">
                                                <div class="card-body">
                                                    <small class="text-muted">
                                                        Calendar view showing scheduled activities
                                                        <em>(calendar integration later)</em>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Tabs --}}
                                        <ul class="nav nav-tabs mb-4" id="lifestyleTabs" role="tablist">
                                            <li class="nav-item">
                                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#activities">
                                                    Activity Participation
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#diet">
                                                    Diet & Nutrition
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" id="weight-tab" data-bs-toggle="tab" data-bs-target="#weight">
                                                    Weight Tracking
                                                </button>
                                            </li>
                                        </ul>
                                        


                                        <div class="tab-content">

                                            {{-- Activity Participation --}}
                                            <div class="tab-pane fade show active" id="activities">
                                                <div class="card mb-4">
                                                    <div class="card-body">

                                                        {{-- Filters --}}
                                                        <div class="row g-2 align-items-end mb-4">
                                                            <div class="col-md-auto">
                                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addActivityModal">
                                                                    <i class="fas fa-plus"></i> Add Activity
                                                                </button>

                                                            </div>
                                                        </div>

                                                        {{-- Table --}}
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-hover">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Activity</th>
                                                                        <th>Resident</th>
                                                                        <th>Participation Level</th>
                                                                        <th>Notes</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    

                                                                    {{-- Activities --}}
                                                                    @foreach ($activities as $activity)
                                                                    <tr>
                                                                        <td>{{ $activity->date }}</td>
                                                                        <td>{{ $activity->activity }}</td>
                                                                        <td>{{ $activity->resident_id }}</td>
                                                                        <td>{{ $activity->participation_level }}</td>
                                                                        <td>{{ $activity->notes }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
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

                                            {{-- Weight Tracking --}}
                                            <div class="tab-pane fade" id="weight">

                                                <div class="d-flex justify-content-between mb-3">
                                                    <h5>Weight Tracking</h5>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addWeightModal">
                                                        <i class="fas fa-plus"></i> Add Weight
                                                    </button>
                                                </div>

                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Weight (kg)</th>
                                                            <th>Recorded By</th>
                                                            <th>Notes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($weights as $w)
                                                            <tr>
                                                                <td>{{ $w->recorded_at }}</td>
                                                                <td>{{ $w->weight }}</td>
                                                                <td>{{ $w->employee_id }}</td>
                                                                <td>{{ $w->notes }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                                {{-- Chart --}}
                                                <div style="height: 300px;">
                                                    <canvas id="weightChart"></canvas>
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



<!-- Add Activity Modal -->
<div class="modal fade" id="addActivityModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Activity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- <form method="POST" action="{{ route('admin.lifestyle.activities.store') }}"> -->
            <form onsubmit="event.preventDefault(); submitForm(this, '{{ route('admin.lifestyle.activities.store') }}')">

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
                            <label class="form-label">Activity Type</label>
                            <select class="form-select" name="activity" required>
                                <option value="">Select activity</option>
                                <option>Exercise</option>
                                <option>Arts & Crafts</option>
                                <option>Music</option>
                                <option>Therapy</option>
                                <option>Outing</option>
                            </select>
                        </div>

                        <!-- <div class="col-md-6">
                            <label class="form-label">Resident</label>
                            <select class="form-select" name="resident_id" required>
                                <option value="">Select resident</option>
                                <option value="RHCA001">Resident 1</option>
                                <option value="RHCA002">Resident 2</option>
                                <option value="RHCA003">Resident 3</option>
                            </select>
                        </div> -->

                        <div class="col-md-6">
                            <label class="form-label">Participation Level</label>
                            <select class="form-select" name="participation">
                                <option>High</option>
                                <option>Medium</option>
                                <option>Low</option>
                                <option>Refused</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Paticipated With</label>
                            <textarea class="form-control" rows="3" name="notes"
                                placeholder="Additional notes..."></textarea>
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

                        <div class="col-12">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="3" name="notes"
                                placeholder="Additional notes..."></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        Save Activity
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
<div class="modal fade" id="addWeightModal">
    <div class="modal-dialog">
        <form class="modal-content" onsubmit="event.preventDefault(); submitForm(this, '{{ route('admin.lifestyle.weights.store') }}')">

            <div class="modal-header">
                <h5>Add Weight</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label>Date</label>
                    <input type="date" name="recorded_at" class="form-control" required>
                </div>
                <input type="hidden" name="resident_id" value="{{ $resident->resident_id }}">
                
                <div class="mb-3">
                    <label>Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let weightChart = null;

    document.getElementById('weight-tab').addEventListener('shown.bs.tab', function () {

        // Prevent re-rendering
        if (weightChart) return;

        const ctx = document.getElementById('weightChart').getContext('2d');

        weightChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($weights->pluck('recorded_at')),
                datasets: [{
                    label: 'Weight (kg)',
                    data: @json($weights->pluck('weight')),
                    borderWidth: 2,
                    tension: 0.3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
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
