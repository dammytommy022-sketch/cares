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
                        <h4 class="app-card-title">Residents Board</h4>
                        <small class="text-muted">Manage residents, view details, update records</small>

                    </div><!--//col-->
                        
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body  px-4  pb-2">
                <div >
                    <div class="tab-pane fade show active" id="all-shift" role="tabpanel" aria-labelledby="all-shift-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="app-content pt-4 p-md-1 p-lg-2">
                                    <div class="container-xl">

                                        {{-- Page Header --}}
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <a href="{{ route('admin.residents.create') }}" class="btn btn-success px-4 rounded-pill shadow-sm text-white">
                                                <i class="fas fa-plus me-1"></i> Add New Resident
                                            </a>
                                            
                                            <form method="GET" action="{{ route('admin.residents.index') }}" class="mb-4">
                                                <div class="input-group shadow-sm ">
                                                    <span class="input-group-text bg-white border-end-0">
                                                        <i class="fas fa-search text-muted"></i>
                                                    </span>

                                                    <input 
                                                        type="text" 
                                                        name="search" 
                                                        value="{{ request('search') }}" 
                                                        class="form-control border-start-0 "
                                                        placeholder="Search residents by name, placement type, guardian, etc..."
                                                        autofocus
                                                    >

                                                    <button class="btn btn-primary px-4 text-white rounded-end-pill" type="submit">
                                                        Search
                                                    </button>
                                                </div>
                                            </form>

                                            
                                        </div>

                                        {{-- Search Bar --}}
                                        

                                        {{-- Table Card --}}
                                        <div class=" border-0  app-card  app-card-basic p-4 bg-light shadow rounded-4">
                                            <div class="card-body p-0">

                                                <table class="table table-hover table-borderless align-middle mb-0">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th class="ps-4" width="60">#</th>
                                                            <th><i class="fas fa-user text-muted me-1"></i> Full Name</th>
                                                            <th><i class="fas fa-id-badge text-muted me-1"></i> Preferred Name</th>
                                                            <th><i class="fas fa-home text-muted me-1"></i> Placement</th>
                                                            <th><i class="fas fa-venus-mars text-muted me-1"></i> Gender</th>
                                                            <th width="160"><i class="fas fa-calendar text-muted me-1"></i> Created</th>
                                                            <th width="150" class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @php
                                                            $sn = ($residents->currentPage() - 1) * $residents->perPage() + 1;
                                                        @endphp

                                                        @forelse ($residents as $resident)
                                                            <tr>
                                                                <td class="ps-4 fw-semibold">{{ $sn++ }}</td>

                                                                {{-- Full Name --}}
                                                                <td class="fw-semibold">
                                                                    {{ $resident->basic_info['full_name'] ?? '—' }}
                                                                </td>

                                                                {{-- Preferred Name --}}
                                                                <td class="text-muted">
                                                                    {{ $resident->basic_info['preferred_name'] ?? '—' }}
                                                                </td>

                                                                {{-- Placement Type --}}
                                                                <td>
                                                                    @php 
                                                                        $placement = $resident->placement_info['type'] ?? '—';
                                                                        $badgeClass = [
                                                                            'Short-term' => 'bg-info',
                                                                            'Long-term' => 'bg-primary',
                                                                            'Emergency' => 'bg-danger',
                                                                            'Respite' => 'bg-warning text-dark'
                                                                        ][$placement] ?? 'bg-secondary';
                                                                    @endphp

                                                                    <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2">
                                                                        {{ $placement }}
                                                                    </span>
                                                                </td>

                                                                {{-- Gender --}}
                                                                <td>
                                                                    @php
                                                                        $gender = $resident->basic_info['gender'] ?? '—';
                                                                        $genderColor = $gender === 'Male' ? 'bg-primary' : ($gender === 'Female' ? 'bg-warning' : 'bg-secondary');
                                                                    @endphp
                                                                    <span class="badge {{ $genderColor }} rounded-pill px-3 py-2">
                                                                        {{ $gender }}
                                                                    </span>
                                                                </td>

                                                                {{-- Created Date --}}
                                                                <td class="text-muted">
                                                                    {{ $resident->created_at->format('d M Y') }}
                                                                </td>

                                                                {{-- Action Buttons --}}
                                                                <td class="text-center">
                                                                    <div class="btn-group" role="group">

                                                                        <a href="{{ route('admin.residents.show', $resident->id) }}" 
                                                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>

                                                                        <a href="{{ route('admin.residents.edit', $resident->id) }}" 
                                                                            class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>

                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        @empty
                                                            <tr>
                                                                <td colspan="7" class="text-center py-5 text-muted">
                                                                    <i class="fas fa-users fa-2x mb-3"></i>
                                                                    <div>No residents found.</div>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        {{-- Pagination --}}
                                        <div class="mt-4 d-flex justify-content-center">
                                            {{ $residents->links('pagination::bootstrap-4') }}
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
