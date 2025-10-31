@extends('admin.layout.header')
@section('content')
    <div class="row">
        
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
                                <h4 class="app-card-title">Resident's Board</h4>
                            </div><!--//col-->
                                
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body  px-4">
                        <div >
                            <div class="tab-pane fade show active" id="all-shift" role="tabpanel" aria-labelledby="all-shift-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                    <div class="col-md-12 ">
                                        <div class="card card-plain">
                                            <div class="card-header">
                                            <h6 class="section-title">Create Account</h6>
                                            <small class="mb-5">Create New Resident Profile</small>
                                            <div class="card-body bg-white">
                                            <form role="form" class="settings-form" action="{{ route('admin.postcreateresident') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-1" class="form-label">Title </label>
                                                            <input type="text" name="title" class="form-control" id="setting-input-1" placeholder="titile" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-2" class="form-label">Fullname</label>
                                                            <input type="text" name="fullname" class="form-control" id="setting-input-2" placeholder="fullname" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                        <label for="setting-input-3" class="form-label">D.O.B </label>
                                                            <input type="date" name="dob" class="form-control" id="setting-input-3"  required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-4" class="form-label">Address</label>
                                                            <input type="text" name="address" class="form-control" id="setting-input-4" placeholder="address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-5" class="form-label">Email Address</label>
                                                            <input type="text" name="email" class="form-control" id="setting-input-5" placeholder="email address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-6" class="form-label">Gender</label>
                                                            <select name="gender" id="setting-input-6" class="form-control">
                                                                <option>-- select gender --</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-7" class="form-label">Marital Status </label>
                                                            <input type="text" name="maritalstatus" class="form-control" id="setting-input-7" placeholder="marital status" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-8" class="form-label">Nationalty</label>
                                                            <select name="nationalty" id="nationalty" class="form-control">
                                                                <option>-- select nationalty --</option>
                                                                <option value="United Kingdom">United Kingdom</option>
                                                                <option value="Canada">Canada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label for="setting-input-9" class="form-label">Language </label>
                                                            <input type="text" name="language" class="form-control" id="setting-input-9" placeholder="language" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label for="setting-input-14" class="form-label">Medical Status</label>
                                                            <input type="text" name="medicalstatus" class="form-control" id="setting-input-14" placeholder="medical status" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                        <label for="setting-input-13" class="form-label">Floor Option</label>
                                                            <select name="room_no" id="room_no" class="form-control">
                                                                <option>-- Select Room Floor  --</option>
                                                                <option value="floor1">Floor 1</option>
                                                                <option value="floor2">Floor 2</option>
                                                                <option value="floor3">Floor 3</option>
                                                                <option value="floor4">Floor 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <small class="section-title mb-2">Next Of Kin Details</small>
                                                    <hr>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-10" class="form-label">Full Name </label>
                                                            <input type="text" name="fullname2" class="form-control" id="setting-input-10" placeholder="next of kin name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-15" class="form-label">Relationship </label>
                                                            <input type="text" name="relationship" class="form-control" id="setting-input-15" placeholder="relationship" required>
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-16" class="form-label">Phone Number </label>
                                                            <input type="text" name="phone" class="form-control" id="setting-input-16" placeholder="Phone Number" required>
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class=" mb-3">
                                                            <label for="setting-input-17" class="form-label">Address </label>
                                                            <input type="text" name="address2" class="form-control" id="setting-input-17" placeholder="Address" required>
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label for="setting-input-12" class="form-label">Gender</label>
                                                            <select name="gender2" id="gender2" class="form-control">
                                                                <option>-- Select Gender --</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="col-auto">
                                                        <label for="setting-input-12" class="form-label"> </label>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-lg app-btn-primary">Create Account</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
    </div>  
@endsection 