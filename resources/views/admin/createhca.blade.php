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
                        <h4 class="app-card-title">Healt Care Assistance Board</h4>
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
                                        <small class="mb-5">Create New HCA Account</small>
                                        <div class="card-body bg-white">
                                        <form role="form" class="settings-form" action="{{ route('admin.postcreatehca')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class=" mb-3">
                                                        <label for="setting-input-0" class="form-label">Username</label>
                                                        <input type="text" name="username" class="form-control" id="setting-input-0" placeholder="username" required>
                                                    </div>
                                                </div>
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
                                                        <label for="setting-input-5" class="form-label">Email Address</label>
                                                        <input type="text" name="email" class="form-control" id="setting-input-5" placeholder="email address" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class=" mb-3">
                                                        <label for="setting-input-16" class="form-label">Phone Number </label>
                                                        <input type="text" name="phone" class="form-control" id="setting-input-16" placeholder="phone number" required>
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
                                                        <label for="setting-input-10" class="form-label">Next Of Kin Name </label>
                                                        <input type="text" name="next_of_kin" class="form-control" id="setting-input-10" placeholder="next of kin name" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class=" mb-3">
                                                        <label for="setting-input-16" class="form-label">Next Of Kin Phone Number </label>
                                                        <input type="text" name="phone2" class="form-control" id="setting-input-16" placeholder="next of kin phone Number" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class=" mb-3">
                                                        <label for="setting-input-15" class="form-label">Shift Type </label>
                                                        <select name="shift" id="setting-input-15" class="form-control">
                                                            <option>-- select shift --</option>
                                                            <option value="morning">Morning</option>
                                                            <option value="evening">Evening</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class=" mb-3">
                                                        <label for="setting-input-17" class="form-label">Password </label>
                                                        <input type="password" name="password" class="form-control" id="setting-input-17" placeholder="password" required>
                                                    
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
         
@endsection 