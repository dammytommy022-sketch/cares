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
                        <h4 class="app-card-title">Health Care Assistance Board</h4>
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
                        <h6 class="section-title">Edit Account</h6>
                        <small class="mb-5">Edit HCA Profile</small>
                        <div class="card-body bg-white">
                        <form role="form" action="{{ route('admin.updatehca', ['hcas' => $hcas]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="username" class="form-control" value="{{ $hcas->username}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="title" class="form-control" value="{{ $hcas->title}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="fullname" class="form-control" value="{{ $hcas->fullname}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="email" name="email" class="form-control" value="{{ $hcas->email}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="phone" class="form-control" value="{{$hcas->phone}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="address" class="form-control" value="{{ $hcas->address}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <input type="text" name="next_of_kin" class="form-control" value="{{$hcas->next_of_kin}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="phone2" class="form-control" value="{{ $hcas->phone2}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <!-- <input type="text" name="gender" class="form-control"> -->
                                        <select name="shift" id="shift" class="form-control">
                                            <option>-- Select Shift --</option>
                                            <option value="morning" @if ($hcas->shift == 'morning') selected @endif >Morning</option>
                                            <option value="evening" @if ($hcas->shift == 'evening') selected @endif >Evening</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option>-- Status --</option>
                                            <option value="active" @if ($hcas->status == 'active') selected @endif >Active</option>
                                            <option value="disabled" @if ($hcas->status == 'disabled') selected @endif >Disabled</option>
                                            <option value="delete" @if ($hcas->status == 'delete') selected @endif >Delete</option>
                                        </select>
                                        
                                    </div>
                                </div>
                               
                                
                                
                               
                               
                                <div class="col-auto">
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-primary  ">Update Account</button>
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