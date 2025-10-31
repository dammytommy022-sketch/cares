@extends('user.layout.header')
@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Overview</h1>
        <div class="row g-4">
        @foreach ($residents as $resident)
            <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                            
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.resident', ['id' => $resident->id])}}"></a>
                    </div>
                    <div class="app-card-body p-3 has-card-actions">
                        
                        <h4 class="app-doc-title truncate mb-0"><a href="{{route('hca.resident', ['id' => $resident->id])}}">{{ $resident->fullname  }}</a></h4>
                        <div class="app-doc-meta">
                            <ul class="list-unstyled mb-0">
                                <li><span class="text-muted"><i class="fa fa-user-plus"></i></span> {{ $resident->hca_no  }}</li>
                                <li><span class="text-muted"><i class="fa-solid fa-bed-pulse"></i></span> {{ $resident->room_no  }}</li>
                                <li><span class="text-muted"><i class="fa-solid fa-notes-medical"></i></span> {{ $resident->medical_status  }}</li>
                            </ul>
                        </div><!--//app-doc-meta-->
                        
                        <div class="app-card-actions">
                            <div class="dropdown">
                                <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    </svg>
                                </div><!--//dropdown-toggle--> 
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('hca.note', ['id' => $resident->id])}}"><i class="fa fa-file me-1 ms-2"></i> Daily Note</a></li>
                                    <li><a class="dropdown-item" href="{{route('hca.forms', ['id' => $resident->id])}}"><i class="fa fa-wpforms me-1 ms-2"></i> Forms </a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-line-chart me-1 ms-2"></i> Chart </a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-male me-1 ms-2"></i>Body Map</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-eye me-1 ms-2"></i>View</a></li>
                                    

                                    
                                    <!-- <li><a class="dropdown-item" href="#"><i class="fa fa-delete me-1 ms-2"></i>Delete</a></li> -->
                                </ul>
                            </div><!--//dropdown-->
                        </div><!--//app-card-actions-->
                            
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div><!--//col-->
        @endforeach  
            
        </div><!--//row-->
    </div><!--//container-fluid-->
</div><!--//app-content-->
    
@endsection