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
                        <h6 class="section-title">Edit Account</h6>
                        <small class="mb-5">Edit Resident Profile</small>
                        <div class="card-body bg-white">
                        <form role="form" action="{{ route('admin.updateresidents', ['residents' => $residents]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="title" class="form-control" value="{{ $residents->title}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="fullname" class="form-control" value="{{ $residents->fullname}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="date" name="dob" class="form-control" value="{{ $residents->dob}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="address" class="form-control" value="{{ $residents->address}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="email" name="email" class="form-control" value="{{ $residents->email}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <!-- <input type="text" name="gender" class="form-control"> -->
                                        <select name="gender" id="gender" class="form-control">
                                            <option>-- Select Gender --</option>
                                            <option value="male" @if ($residents->gender == 'male') selected @endif >Male</option>
                                            <option value="female" @if ($residents->gender == 'female') selected @endif >Female</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="maritalstatus" class="form-control" value="{{ $residents->maritalstatus}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                    <input type="text" name="nationalty" class="form-control" value="{{ $residents->nationalty}}">

                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="language" class="form-control" value="{{$residents->language}}">
                                    </div>
                                </div>
                                <small>Next Of Kin Details</small>
                                <hr>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <input type="text" name="fullname2" class="form-control" value="{{$residents->next_of_kin}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="relationship" class="form-control" value="{{$residents->relationship}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="phone" class="form-control" value="{{$residents->phone_no}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <input type="text" name="address2" class="form-control" value="{{$residents->nextofkin_address}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <!-- <input type="text" name="gender" class="form-control"> -->
                                        <select name="gender2" id="gender2" class="form-control">
                                            <option>-- Select Gender --</option>
                                            <option value="male" @if ($residents->nextofkin_gender == 'male') selected @endif >Male</option>
                                            <option value="female" @if ($residents->nextofkin_gender == 'female') selected @endif >Female</option>
                                        </select>
                                        
                                    </div>
                                    
                                </div>
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <select name="room_no" id="room_no" class="form-control">
                                            <option>-- Select Room Floor  --</option>
                                            <option value="floor1" @if ($residents->room_no == 'floor 1') selected @endif >Floor 1</option>
                                            <option value="floor2" @if ($residents->room_no == 'floor 2') selected @endif >Floor 2</option>
                                            <option value="floor3" @if ($residents->room_no == 'floor 3') selected @endif >Floor 3</option>
                                            <option value="floor4" @if ($residents->room_no == 'floor 4') selected @endif >Floor 4</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <hr> 
                                <div class="col-sm-4">
                                    <div class=" mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option>-- Status --</option>
                                            <option value="active" @if ($residents->status == 'active') selected @endif >Active</option>
                                            <option value="disabled" @if ($residents->status == 'disabled') selected @endif >Disabled</option>
                                            <option value="delete" @if ($residents->status == 'delete') selected @endif >Delete</option>
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