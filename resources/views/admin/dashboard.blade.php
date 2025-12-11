@extends('admin.layout.header')
@section('content')
    <style>
        .bg-light{
            background-color: #f0f0f0;
        }
        .app-btn-danger{
            background-color: #fb866a;
            color: #ffffff;
        }
    </style>
    <div class="app-content pt-5 p-md-3 p-lg-4">
        <div class="container-xl">
            
            
            <h1 class="app-page-title">Overview</h1>

            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-4">
                    <div class="app-card app-card-basic  d-flex flex-column align-items-start shadow-sm">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <i class="fas fa-users" style="font-size: 2em;"></i>
                                    </div><!--//icon-holder-->
                                    
                                </div><!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title">{{ $totalPatients }} Resident's</h4>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body px-4">
                            <div class="intro">
                                Total Number of Resident's
                            </div>
                        </div><!--//app-card-body-->
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="{{ route('admin.residents.index') }}">View All</a>
                            <a class="btn app-btn-secondary" href="{{route('admin.residents.create')}}">Create New</a>
                        </div><!--//app-card-footer-->
                    </div><!--//app-card--> 
                </div><!--//col-->
                <div class="col-12 col-lg-4">
                    <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <i class="fas fa-user-nurse" style="font-size: 2em;"></i>
                                    </div><!--//icon-holder-->
                                    
                                </div><!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title">{{ $totalSupportWKs }} Personel</h4>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body px-4">
                            <div class="intro">
                                Total Number of Support Workers
                            </div>
                        </div><!--//app-card-body-->
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="{{ route('admin.hcaworkers') }}">View All</a>
                            <a class="btn app-btn-secondary" href="{{ route('admin.createhca') }}">Create New</a>
                        </div><!--//app-card-footer-->
                    </div><!--//app-card-->
                </div><!--//col-->
                <div class="col-12 col-lg-4">
                    <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <i class="fas fa-user-md" style="font-size: 2em;"></i>
                                    </div><!--//icon-holder-->
                                    
                                </div><!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title">{{ $totalMgTms }} Personel</h4>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body px-4">
                            
                            <div class="intro">
                                Total Number of Mgr & Team Leaders
                            </div>
                        </div><!--//app-card-body-->
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="{{ route('admin.nurses')}}">View All</a>
                            <a class="btn app-btn-secondary" href="{{ route('admin.createnurse')}}">Create New</a>
                        </div><!--//app-card-footer-->
                    </div><!--//app-card-->
                </div><!--//col-->
            </div><!--//row-->
            
            <div class="app-card app-card-basic pb-1 bg-light">
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <i class="fas fa-briefcase" style="font-size: 2em;"></i>
                            </div><!--//icon-holder-->
                            
                        </div><!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">Shift Schedule</h4>
                        </div><!--//col-->
                        <div class="col-auto">
                                <a class="btn app-btn-secondary" href="{{route('admin.addShifts')}}"><i class="fas fa-briefcase"></i> Add New</a>
                            </div>
                    </div><!--//row-->
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
                </div><!--//app-card-header-->
                <div class="app-card-body  px-4">
                    <nav id="orders-table-tab" class="orders-table-tab  app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                        <a class="flex-sm-fill text-sm-center nav-link active" id="all-shift-tab" data-bs-toggle="tab" href="#all-shift" role="tab" aria-controls="all-shift" aria-selected="true">All</a>
                        <a class="flex-sm-fill text-sm-center nav-link"  id="morning-shift-tab" data-bs-toggle="tab" href="#morning-shift" role="tab" aria-controls="morning-shift" aria-selected="false">Morning</a>
                        <a class="flex-sm-fill text-sm-center nav-link" id="evening-shift-tab" data-bs-toggle="tab" href="#evening-shift" role="tab" aria-controls="evening-shift" aria-selected="false">Evening</a> 
                    </nav>
                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="all-shift" role="tabpanel" aria-labelledby="all-shift-tab">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table app-table-hover mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell">All Days</th>
                                                    <th></th>
                                                    <th class="cell" colspan="3" style="background-color: black; color:white; align-text:center">Healt Care Assistant</th>
                                                    <th class="cell" colspan="3" style="background-color: pink; color:white; align-text:center">Nurse</th>
                                                    <th class="cell">Update Schedule</th>
                                                </tr>
                                                <tr>
                                                    <th class="cell">Shift Type</th>
                                                    <th class="cell">Date</th>
                                                    <th class="cell">Floor 1</th>
                                                    <th class="cell">Floor 2</th>
                                                    <th class="cell">Floor 3</th>
                                                    <th class="cell">Floor 1</th>
                                                    <th class="cell">Floor 2</th>
                                                    <th class="cell">Floor 3</th>
                                                    <th class="cell">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($schedules as $schedule)
                                                    <tr> 
                                                        @if ( $schedule->shift_type == 'Morning')
                                                        <td class="cell"> Morning</td>
                                                        @else
                                                        <td class="cell"> Evening</td>
                                                        @endif
                                                        <td class="cell"><span class="truncate"> {{ \Carbon\Carbon::parse($schedule->date)->format('M jS, Y (l)') }} </span></td>
                                                        <td class="cell"> {{ $schedule->hca1}}, {{ $schedule->hca2}}</td>
                                                        <td class="cell"> {{ $schedule->hca3}}, {{ $schedule->hca4}} </td>
                                                        <td class="cell"> {{ $schedule->hca5}},  {{ $schedule->hca6}} </td>
                                                    
                                                        <td class="cell"> {{ $schedule->nurse1}} </td>
                                                        <td class="cell"> {{ $schedule->nurse2}} </td>
                                                        <td class="cell"> {{ $schedule->nurse2}} </td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{ route('admin.editshift', $schedule->id )}}">Edit</a>
                                                            <a class="btn-sm app-btn-danger" href="{{ route('admin.deleteshift', $schedule->id )}}">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                    </tr>
                                                @empty
                                                    <p class="text-danger pr-3" >No Data Found</p>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div><!--//table-responsive-->
                                    
                                </div><!--//app-card-body-->		
                            </div><!--//app-card-->
                        </div><!--//tab-pane-->
                        
                        <div class="tab-pane fade" id="morning-shift" role="tabpanel" aria-labelledby="morning-shift-tab">
                            <div class="app-card app-card-orders-table mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell">All Days</th>
                                                    <th></th>
                                                    <th class="cell" colspan="3" style="background-color: black; color:white; align-text:center">Healt Care Assistant</th>
                                                    <th class="cell" colspan="3" style="background-color: pink; color:white; align-text:center">Nurse</th>
                                                    <th class="cell">Update Schedule</th>
                                                </tr>
                                                <tr>
                                                    <th class="cell">Shift Type</th>
                                                    <th class="cell">Date</th>
                                                    <th class="cell">Floor 1</th>
                                                    <th class="cell">Floor 2</th>
                                                    <th class="cell">Floor 3</th>
                                                    <th class="cell">Floor 1</th>
                                                    <th class="cell">Floor 2</th>
                                                    <th class="cell">Floor 3</th>
                                                    <th class="cell">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($morningshifts as $morningshift)
                                                    <tr> 
                                                        <td class="cell"> Morning</td>
                                                        <td class="cell"><span class="truncate"> {{ \Carbon\Carbon::parse($morningshift->date)->format('M jS, Y (l)') }} </span></td>
                                                        <td class="cell"> {{ $morningshift->hca1}}, {{ $morningshift->hca2}}</td>
                                                        <td class="cell"> {{ $morningshift->hca3}}, {{ $morningshift->hca4}} </td>
                                                        <td class="cell"> {{ $morningshift->hca5}},  {{ $morningshift->hca6}} </td>
                                                    
                                                        <td class="cell"> {{ $morningshift->nurse1}} </td>
                                                        <td class="cell"> {{ $morningshift->nurse2}} </td>
                                                        <td class="cell"> {{ $morningshift->nurse2}} </td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{ route('admin.editshift', $morningshift->id )}}">Edit</a>
                                                            <a class="btn-sm app-btn-danger" href="{{ route('admin.deleteshift', $morningshift->id )}}">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                    </tr>
                                                @empty
                                                    <p class="text-danger pr-3" >No Data Found</p>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div><!--//table-responsive-->
                                </div><!--//app-card-body-->		
                            </div><!--//app-card-->
                        </div><!--//tab-pane-->
                        
                        <div class="tab-pane fade" id="evening-shift" role="tabpanel" aria-labelledby="evening-shift-tab">
                            <div class="app-card app-card-orders-table mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell">All Days</th>
                                                    <th></th>
                                                    <th class="cell" colspan="3" style="background-color: black; color:white; align-text:center">Healt Care Assistant</th>
                                                    <th class="cell" colspan="3" style="background-color: pink; color:white; align-text:center">Nurse</th>
                                                    <th class="cell">Update Schedule</th>
                                                </tr>
                                                <tr>
                                                    <th class="cell">Shift Type</th>
                                                    <th class="cell">Date</th>
                                                    <th class="cell">Floor 1</th>
                                                    <th class="cell">Floor 2</th>
                                                    <th class="cell">Floor 3</th>
                                                    <th class="cell">Floor 1</th>
                                                    <th class="cell">Floor 2</th>
                                                    <th class="cell">Floor 3</th>
                                                    <th class="cell">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($eveningshifts as $eveningshift)
                                                    <tr> 
                                                        <td class="cell"> Evening</td>
                                                        <td class="cell"><span class="truncate"> {{ \Carbon\Carbon::parse($eveningshift->date)->format('M jS, Y (l)') }} </span></td>
                                                        <td class="cell"> {{ $eveningshift->hca1}}, {{ $eveningshift->hca2}}</td>
                                                        <td class="cell"> {{ $eveningshift->hca3}}, {{ $eveningshift->hca4}} </td>
                                                        <td class="cell"> {{ $eveningshift->hca5}},  {{ $eveningshift->hca6}} </td>
                                                    
                                                        <td class="cell"> {{ $eveningshift->nurse1}} </td>
                                                        <td class="cell"> {{ $eveningshift->nurse2}} </td>
                                                        <td class="cell"> {{ $eveningshift->nurse2}} </td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{ route('admin.editshift', $eveningshift->id )}}">Edit</a>
                                                            <a class="btn-sm app-btn-danger" href="{{ route('admin.deleteshift', $eveningshift->id )}}">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                    </tr>
                                                @empty
                                                    <p class="text-danger pr-3" >No Data Found</p>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div><!--//table-responsive-->
                                </div><!--//app-card-body-->		
                            </div><!--//app-card-->
                        </div><!--//tab-pane-->
                        
                    </div><!--//tab-content-->
                </div><!--//app-card-body-->
                
            </div>
            
            
        </div><!--//container-fluid-->
        
    </div><!--//app-content-->
    
@endsection