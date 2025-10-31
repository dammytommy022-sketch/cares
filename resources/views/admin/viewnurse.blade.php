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
                                        <div class="item-data">{{ $nurse->username}}</div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        @if($nurse->state == "active")
                                            <button class="btn-sm app-btn-primary"> Active </button>
                                        @elseif($nurse->state == "disabled")
                                            <button class="btn-sm app-btn-secondary"> Disabled </button>
                                        @endif
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Title</strong></div>
                                        <div class="item-data">{{ $nurse->title}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Full Name</strong></div>
                                        <div class="item-data">{{ $nurse->fullname}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Phone Number</strong></div>
                                        <div class="item-data">{{$nurse->phone}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Email</strong></div>
                                        <div class="item-data">{{ $nurse->email}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Address</strong></div>
                                        <div class="item-data">
                                        {{ $nurse->address}}
                                        </div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            
                            {{--<div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Gender</strong></div>
                                        <div class="item-data">
                                        {{ $nurse->gender}}
                                        </div>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->--}}
                            
                            
                            
                        </div><!--//app-card-body-->                                                
                    </div><!--//app-card-->
                </div><!--//col-->
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                                        </svg>
                                    </div><!--//icon-holder-->
                                    
                                </div><!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title">Preferences</h4>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body px-4 w-100">
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Position</strong></div>
                                        <div class="item-data">{{ $nurse->position}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Supervision </strong></div>
                                        <div class="item-data">{{$nurse->supervision}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Status </strong></div>
                                        <div class="item-data">{{$nurse->status}}</div>
                                    </div><!--//col-->
                                    
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Next Of Kin</strong></div>
                                        <div class="item-data">
                                        {{ $nurse->next_of_kin}}
                                        </div>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Next Of Kin Phone No.</strong></div>
                                        <div class="item-data">
                                        {{ $nurse->phone2}}
                                        </div>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            
                        </div><!--//app-card-body-->
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="{{ route('admin.editnurse', $nurse->id) }}">Edith Account</a>
                        </div><!--//app-card-footer-->
                    
                    </div><!--//app-card-->
                </div><!--//col-->
        
            </div><!--//row-->
                        
                
        </div>
    </div>
</div>
         
@endsection 