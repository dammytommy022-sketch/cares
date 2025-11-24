@extends('admin.layout.header')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="app-content pt-4 p-md-3 p-lg-4">
    <div class="container-xl">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">All Schedules</h3>

            <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New Schedule
            </a>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Created On</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php 
                            $sn = ($schedules->currentPage() - 1) * $schedules->perPage() + 1;
                            $grouped = $schedules->groupBy(fn($item) => $item->month . '-' . $item->year);
                        @endphp

                        @foreach ($grouped as $group)
                            @php $first = $group->first(); @endphp

                            <tr>
                                <td>{{ $sn++ }}</td>
                                <td>{{ $first->month }}</td>
                                <td>{{ $first->year }}</td>
                                <td>{{ $first->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.schedules.show', $first->id) }}" class="btn btn-primary btn-sm">
                                        View / Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

       <!-- Pagination Links -->
        @if($schedules->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $schedules->withQueryString()->links('vendor.pagination.bootstrap-4') }}
            </div>
        @elseif($schedules->total() > 0)
            <div class="alert alert-warning text-center mt-4">
                Showing all {{ $schedules->total() }} schedules (no pagination needed)
            </div>
        @else
            <div class="alert alert-info text-center mt-4">
                No schedules found.
            </div>
        @endif




    </div>
</div>
@endsection
