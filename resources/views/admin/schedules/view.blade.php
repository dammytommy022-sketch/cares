@extends('admin.layout.header')

@section('content')
<style>
    .table th, .table td {
        min-width: 40px;
        font-size: 13px;
        text-align: center;
        padding: 5px;
    }

    .shift-option:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }

    /* Sticky first column */
    .sticky-col {
        position: sticky;
        left: 0;
        background: #fff;
        z-index: 10;
    }

    /* Dropdown container animation */
    #shiftSelector {
        position: absolute;
        z-index: 9999;
        transform-origin: top;
        opacity: 0;
        transform: translateY(-5px) scale(0.95);
        transition: opacity 0.15s ease-out, transform 0.15s ease-out;
    }

    /* When visible */
    #shiftSelector.show {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* Arrow pointer */
    #shiftSelector::before {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        border-style: solid;
    }

    /* Arrow on the left side */
    #shiftSelector.arrow-left::before {
        right: -8px;
        top: 12px;
        border-width: 8px 0 8px 8px;
        border-color: transparent transparent transparent white;
    }

    /* Arrow on the right side */
    #shiftSelector.arrow-right::before {
        left: -8px;
        top: 12px;
        border-width: 8px 8px 8px 0;
        border-color: transparent white transparent transparent;
    }

</style>

<div class="app-content pt-5 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="app-card app-card-basic bg-light">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <i class="fas fa-users" style="font-size: 2em;"></i>
                        </div>
                    </div>
                    <div class="col-auto">
                        <h4 class="app-card-title">Schedule Board</h4>
                    </div>
                    <div class="mb-3 mt-2">
                        @foreach($houses as $house)
                            <a href="{{ route('admin.schedules.show', $schedule->id) }}?house={{ $house->id }}"
                            class="btn btn-sm me-2"
                            style="background-color: {{ $house->color ?? '#6c757d' }}; color:white;">
                                {{ $house->name }}
                            </a>
                        @endforeach
                    </div>
                    
                </div>
            </div>

            <div class="app-card-body px-4">

                <div class="container-fluid"
                    style="overflow-x: auto; overflow-y: auto; max-height: 80vh; white-space: nowrap;">
                    

                    <h2 class="mb-4">
                        Schedule for {{ $schedule->house->name }} —
                        {{ \Carbon\Carbon::create($schedule->year, $schedule->month)->format('F Y') }}
                    </h2>
                    <div id="scheduleWrapper" style="overflow:auto; position: relative;">
                        
                        <table class="table table-bordered table-sm text-center align-middle" id="scheduleTable" style="min-width: 1200px;">
                            <thead class="table-light">
                                <tr>
                                    <th class="sticky-col">Staff</th>
                                    @for ($day = 1; $day <= \Carbon\Carbon::create($schedule->year, $schedule->month)->daysInMonth; $day++)
                                        @php
                                            $date = \Carbon\Carbon::create($schedule->year, $schedule->month, $day);
                                        @endphp
                                        <th>
                                            <div>{{ $day }}</div>
                                            <small>{{ $date->format('D') }}</small>
                                        </th>
                                    @endfor
                                </tr>
                            </thead>

                            <tbody>

                                {{-- MORNING STAFF (Light Yellow Rows) --}}
                                @foreach($morning as $personnelId => $records)
                                    @php
                                        $person = $records->first()->personnel;
                                        $cells = $records->keyBy(fn($c) => \Carbon\Carbon::parse($c->date)->day);
                                    @endphp

                                    <tr data-personnel="{{ $person->id }}" >
                                        <td class="text-start fw-bold sticky-col" style="background-color:#FFF4C2;">
                                            {{ $person->fullname }}<br>
                                            <small>{{ $person->preferred_shift }}</small>
                                        </td>

                                        @for ($day = 1; $day <= \Carbon\Carbon::create($schedule->year, $schedule->month)->daysInMonth; $day++)
                                            @php
                                                $cell = $cells->get($day);
                                                $shiftType = $cell?->shift_type ?? '';
                                            @endphp

                                            <td class="editable-cell"
                                                data-date="{{ $schedule->year }}-{{ $schedule->month }}-{{ $day }}"
                                                data-shift="{{ $shiftType }}" style="background-color:#FFF4C2;">
                                                {{ $shiftType ?: '-' }}
                                            </td>
                                        @endfor
                                    </tr>
                                @endforeach

                                {{-- EVENING STAFF (Light Blue Rows) --}}
                                @foreach($evening as $personnelId => $records)
                                    @php
                                        $person = $records->first()->personnel;
                                        $cells = $records->keyBy(fn($c) => \Carbon\Carbon::parse($c->date)->day);
                                    @endphp

                                    <tr data-personnel="{{ $person->id }}" >
                                        <td class="text-start fw-bold sticky-col " style="background-color:#D6E8FF;">
                                            {{ $person->fullname }}<br>
                                            <small>{{ $person->preferred_shift }}</small>
                                        </td>

                                        @for ($day = 1; $day <= \Carbon\Carbon::create($schedule->year, $schedule->month)->daysInMonth; $day++)
                                            @php
                                                $cell = $cells->get($day);
                                                $shiftType = $cell?->shift_type ?? '';
                                            @endphp

                                            <td class="editable-cell"
                                                data-date="{{ $schedule->year }}-{{ $schedule->month }}-{{ $day }}"
                                                data-shift="{{ $shiftType }}" style="background-color:#D6E8FF;">
                                                {{ $shiftType ?: '-' }}
                                            </td>
                                        @endfor
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    
                    </div>

                    
                </div>

                {{-- Shift Dropdown Menu --}}
                <div id="shiftSelector" class="position-absolute bg-white border shadow rounded d-none"
                    style="z-index:9999;">
                    <ul class="list-unstyled m-0 p-2">
                        <li class="shift-option py-1 px-2" data-shift="8">🌅 8hrs</li>
                        <li class="shift-option py-1 px-2" data-shift="12">🌆 12hrs</li>
                        <li class="shift-option py-1 px-2" data-shift="OT">🕒 Overtime</li>

                        <li class="shift-option py-1 px-2" data-shift="AL">❌ AL</li>

                        <li class="shift-option py-1 px-2" data-shift="T 08">📘 T 08</li>
                        <li class="shift-option py-1 px-2" data-shift="T 12">📘 T 12</li>

                        <li class="shift-option py-1 px-2" data-shift="Off">❌ Off</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const selector = document.getElementById("shiftSelector");
    const wrapper = document.getElementById("scheduleWrapper");
    let currentCell = null;

    const shiftStyles = {
        "8":     { bg: "#28a745", color: "white" },
        "12":    { bg: "#007bff", color: "white" },
        "OT":    { bg: "#ffc107", color: "black" },
        "AL":    { bg: "#dc3545", color: "white" },
        "T 08":  { bg: "#6f42c1", color: "white" },
        "T 12":  { bg: "#563d7c", color: "white" },
        "Off":   { bg: "#6c757d", color: "white" }
    };

    document.querySelectorAll(".editable-cell").forEach(cell => {
        const shift = cell.dataset.shift;
        const style = shiftStyles[shift];
        if (style) {
            cell.style.backgroundColor = style.bg;
            cell.style.color = style.color;
        }
    });

    document.querySelectorAll(".editable-cell").forEach(cell => {
        cell.addEventListener("click", e => {
            e.stopPropagation();
            currentCell = cell;

            const cellRect = cell.getBoundingClientRect();
            const wrapperRect = wrapper.getBoundingClientRect();

            let top = cellRect.top - wrapperRect.top + wrapper.scrollTop;
            let left;

            const selectorWidth = selector.offsetWidth;
            const rightSpace = wrapperRect.right - cellRect.right;
            const leftSpace  = cellRect.left - wrapperRect.left;

            // Remove previous arrow classes
            selector.classList.remove("arrow-left", "arrow-right");

            if (rightSpace > selectorWidth + 20) {
                // Show on the RIGHT
                left = cellRect.right - wrapperRect.left + wrapper.scrollLeft + 10;
                selector.classList.add("arrow-left");
            } else {
                // Show on LEFT
                left = cellRect.left - wrapperRect.left + wrapper.scrollLeft - selectorWidth - 10;
                selector.classList.add("arrow-right");
            }

            // Boundary check (top)
            if (top + selector.offsetHeight > wrapper.scrollHeight) {
                top = wrapper.scrollHeight - selector.offsetHeight - 20;
            }
            if (top < 0) top = 10;

            selector.style.top = `${top}px`;
            selector.style.left = `${left}px`;

            selector.classList.remove("d-none");
            setTimeout(() => selector.classList.add("show"), 10);
        });
    });

    document.addEventListener("click", e => {
        if (!selector.contains(e.target)) {
            selector.classList.remove("show");
            setTimeout(() => selector.classList.add("d-none"), 150);
        }
    });
});
</script>






@endsection
