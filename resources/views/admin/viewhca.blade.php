@extends('admin.layout.header')
@section('content')
<div class="app-content pt-5 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="app-card app-card-basic">
            <div class="app-card-header1 p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fas fa-users" style="font-size: 2em;"></i>
                        </div><!--//icon-holder-->
                        
                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title">Health Care Assistant's Board</h4>
                    </div><!--//col-->
                        
                </div><!--//row-->
            </div><!--//app-card-header-->
            
                    
            <div class="row gy-4">
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        
                        <div class="app-card-body px-4 w-100">
                            <div class="item  py-2 text-end">
                                <div class="row text-end">
                                    
                                    <div class="col text-end">
                                        <img class="profile-image" src="{{asset('assets/images/user.png')}}" alt="">
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Username</strong></div>
                                        <div class="item-data">{{ $hcas->username}}</div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        @if($hcas->status == "active")
                                            <button class="btn-sm app-btn-primary"> Active </button>
                                        @elseif($hcas->status == "disabled")
                                            <button class="btn-sm app-btn-secondary"> Disabled </button>
                                        @endif
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Title</strong></div>
                                        <div class="item-data">{{ $hcas->title}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Full Name</strong></div>
                                        <div class="item-data">{{ $hcas->fullname}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Phone Number</strong></div>
                                        <div class="item-data">{{$hcas->phone_no}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Email</strong></div>
                                        <div class="item-data">{{ $hcas->email}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Address</strong></div>
                                        <div class="item-data">
                                        {{ $hcas->address}}
                                        </div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Next Of Kin</strong></div>
                                        <div class="item-data">
                                        {{ $hcas->next_of_kin}}
                                        </div>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            {{--<div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Gender</strong></div>
                                        <div class="item-data">
                                        {{ $residents->gender}}
                                        </div>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->--}}
                            
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Next Of Kin Phone No.</strong></div>
                                        <div class="item-data">
                                        {{ $hcas->phone2}}
                                        </div>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="app-card-footer p-4 mt-auto">
                                <a class="btn app-btn-secondary" href="{{ route('admin.edithca', $hcas->id) }}">Edith Account</a>
                            </div><!--//app-card-footer-->
                    
                        </div><!--//app-card-body-->                                                
                    </div><!--//app-card-->
                </div><!--//col-->
                
        
            </div><!--//row-->
                        
                
        </div>
    </div>
</div>
         
@endsection 