@extends('admin.layout.header')
@section('content')
<div class="app-content pt-5 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="app-card app-card-basic bg-light">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fas fa-users" style="font-size: 2em;"></i>
                        </div><!--//icon-holder-->
                        
                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title">Schedule Board</h4>
                    </div><!--//col-->
                        
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body  px-4">
                @if (session('success'))
                <div class="alert alert-success text-white mt-3">
                    {{ session('success') }}
                </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger text-white mt-3">
                        {{ session('error') }}
                    </div>
                @endif
                <div>
                    <form method="POST" class="settings-form" action="{{ route('admin.schedules.generate') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3 mb-3">
                                <label for="house_id" class="form-label">House</label>
                                <select name="house_id" id="house_id" class="form-control" required>
                                   <option> -- Select House --</option>
                                    @foreach($houses as $house)
                                        <option value="{{ $house->id }}">{{ $house->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <label for="month" class="form-label">Month</label>
                                <input type="number" name="month" id="month" class="form-control" min="1" max="12" placeholder="Select Month with No." required>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input type="number" name="year" value="{{ now()->year }}" id="year" class="form-control" required>
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="year" class="form-label">Generate</label> <br>
                                <button type="submit" class="btn btn-lg app-btn-primary">Generate Schedule</button>

                            </div>
                        </div>
                    </form>
                </div><!--//tab-content-->
            </div><!--//app-card-body-->
        </div>
    </div>
</div>
@endsection 
