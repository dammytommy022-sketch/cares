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
                        <h4 class="app-card-title">Create Personnel</h4>
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
                    <form method="POST" class="settings-form" action="{{ route('admin.personnel.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3 mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" required>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="Manager">Manager</option>
                                    <option value="Team Leader">Team Leader</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <label for="house_id" class="form-label">House</label>
                                <select name="house_id" id="house_id" class="form-control" required>
                                    @foreach($houses as $house)
                                        <option value="{{ $house->id }}">{{ $house->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <label for="hours_type" class="form-label">Hours Type</label>
                                <select name="hours_type" id="hours_type" class="form-control" required>
                                    <option value="8">8 Hours</option>
                                    <option value="12">12 Hours</option>
                                </select>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <label for="preferred_shift" class="form-label">Preferred Shift</label>
                                <select name="preferred_shift" id="preferred_shift" class="form-control" required>
                                    <option value="Morning">Morning</option>
                                    <option value="Evening">Evening</option>
                                </select>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <label for="can_do_ot" class="form-label">Can Do OT</label>

                                {{-- Hidden input ensures 0 is sent when unchecked --}}
                                <input type="hidden" name="can_do_ot" value="0">
                                <input type="checkbox" name="can_do_ot" id="can_do_ot" value="1" class="form-check-input">
                            </div>


                            <div class="col-sm-3 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-sm-3 mb-3">
                                <button type="submit" class="btn btn-lg app-btn-primary">Save Staff</button>
                            </div>
                        </div>
                    </form>
                </div><!--//tab-content-->
            </div><!--//app-card-body-->
        </div>
    </div>
</div>
@endsection 

