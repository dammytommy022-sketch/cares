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
                        <h4 class="app-card-title">List Of Health Care Assistance</h4>
                    </div><!--//col-->
                    
                    <div class="col-auto">
                        <a class="btn app-btn-secondary" href="{{route('admin.createhca')}}"><i class="fas fa-user"></i> Add New</a>
                    </div>
                        @if (session('success'))
                            <div class="alert text-white mt-3 alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body  px-4">
                <div >
                    <div class="tab-pane fade show active" id="all-shift" role="tabpanel" aria-labelledby="all-shift-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">S/N</th>
                                                <th class="cell">USERNAME</th>
                                                <th class="cell">FULL NAME</th>
                                                <th class="cell">EMAIL ADDRESS</th>
                                                <th class="cell">SHIFT</th>
                                                <th class="cell">DATE CREATED</th>
                                                <th class="cell">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $serial = 1 @endphp
                                            @forelse ($hcas as $hca)
                                            <tr>
                                                <td class="cell">{{ $serial++ }}</td>
                                                <td class="cell">{{ $hca->username  }}</td>
                                                <td class="cell">{{ $hca->fullname  }}</td>
                                                <td class="cell">{{ $hca->email  }}</td>
                                                <td class="cell">{{ $hca->shift  }}</td>
                                                <td class="cell">{{ $hca->created_at  }}</td>
                                                
                                                <td class="cell">
                                                    <a class="btn-sm app-btn-secondary" href="{{ route('admin.viewhca', $hca->id) }}">view</a> |
                                                    <a class="btn-sm app-btn-secondary" href="{{ route('admin.edithca', $hca->id) }}">Edit</a> 
                                                </td>
                                            </tr>
                                            
                                            @empty
                                                <p class="text-danger">No Data found</p>
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
    </div>
</div>
         
@endsection 