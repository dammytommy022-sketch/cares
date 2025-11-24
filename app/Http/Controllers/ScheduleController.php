<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Personnel;
use App\Models\Schedules;
use App\Models\ScheduleCell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;

class ScheduleController extends Controller
{
    public function index()
    {
        // Paginate normally (DO NOT group here)
        $schedules = Schedules::orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $houses = House::all();
        return view('admin.schedules.create', compact('houses'));
    }
    /**
     * Generate a new schedule for a given house and month.
     */
    public function createMonthlySchedule(Request $request)
    {
        try {
            $validated = $request->validate([
                'house_id' => 'required|exists:houses,id',
                'month' => 'required|integer|min:1|max:12',
                'year' => 'required|integer|min:2020',
            ]);

            $house = House::findOrFail($validated['house_id']);
            $month = $validated['month'];
            $year = $validated['year'];

            // Check if schedule already exists
            if (Schedules::where('house_id', $house->id)->where('month', $month)->where('year', $year)->exists()) {
                return back()->with('warning', 'Schedule already exists for this month.');
            }

            // Create schedule
            $schedule = Schedules::create([
                'house_id' => $house->id,
                'month' => $month,
                'year' => $year,
                'created_by' => Auth::id(),
            ]);

            // Fetch personnel
            $personnel = Personnel::where('house_id', $house->id)
                ->where('status', 'active')
                ->where('hours_type', '12')
                ->get();

            // Split into morning + evening groups
            $morning = $personnel->where('preferred_shift', 'Morning')->values();
            $evening = $personnel->where('preferred_shift', 'Evening')->values();

            // Auto split
            $morningA = $morning->slice(0, 5);
            $morningB = $morning->slice(5);

            $eveningA = $evening->slice(0, 2);
            $eveningB = $evening->slice(2);

            $teamA = $morningA->merge($eveningA)->values();
            $teamB = $morningB->merge($eveningB)->values();

            // Weekly patterns
            $patternA1 = ['1','1','0','0','0','1','1'];  // Week 1,3
            $patternA2 = ['0','0','1','1','1','0','0'];  // Week 2,4

            $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;

            $cellsToInsert = [];

            for ($day = 1; $day <= $daysInMonth; $day++) {

                $weekIndex = intval(floor(($day - 1) / 7)) % 2; // 0 = PatternA1, 1 = PatternA2
                $dayOfWeek = ($day - 1) % 7;

                $isA1 = $weekIndex === 0;

                $teamAPattern = $isA1 ? $patternA1 : $patternA2;
                $teamBPattern = $isA1 ? $patternA2 : $patternA1; // opposite

                $date = Carbon::create($year, $month, $day);

                foreach ($teamA as $p) {
                    $on = $teamAPattern[$dayOfWeek] === '1';

                    $cellsToInsert[] = [
                        'schedule_id' => $schedule->id,
                        'personnel_id' => $p->id,
                        'date' => $date->toDateString(),
                        'day_name' => $date->format('D'),
                        'shift_type' => $on ? '12' : 'Off',
                        'hours' => $on ? 12 : 0,
                        'is_overtime' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                foreach ($teamB as $p) {
                    $on = $teamBPattern[$dayOfWeek] === '1';

                    $cellsToInsert[] = [
                        'schedule_id' => $schedule->id,
                        'personnel_id' => $p->id,
                        'date' => $date->toDateString(),
                        'day_name' => $date->format('D'),
                        'shift_type' => $on ? '12' : 'Off',
                        'hours' => $on ? 12 : 0,
                        'is_overtime' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            ScheduleCell::insert($cellsToInsert);

            return redirect()->route('admin.schedules.view', $schedule->id)
                ->with('success', "Shift rotation schedule generated successfully!");

        } catch (\Throwable $e) {

            Log::error("Schedule error", [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return back()->with('error', 'Error generating schedule.');
        }
    }




    /**
     * View a generated schedule (grid).
     */
    public function viewSchedule($id)
    {
        $schedule = Schedules::with(['house', 'cells.personnel'])->findOrFail($id);

        $grouped = $schedule->cells->groupBy('personnel_id');

        $morning = $grouped->filter(fn($records) =>
            $records->first()->personnel->preferred_shift === 'Morning'
        );

        $evening = $grouped->filter(fn($records) =>
            $records->first()->personnel->preferred_shift === 'Evening'
        );

        return view('admin.schedules.view', [
            'schedule' => $schedule,
            'grouped'  => $grouped,
            'morning'  => $morning,
            'evening'  => $evening,
        ]);
    }


    public function show(Schedules $schedule)
    {
        // Get all houses for the top buttons
        $houses = \App\Models\House::all();

        // Check if a house is selected via query string, default to current schedule's house
        $houseId = request()->query('house', $schedule->house_id);

        // Load the schedule for the selected house (same month/year)
        $schedule = Schedules::where('house_id', $houseId)
            ->where('month', $schedule->month)
            ->where('year', $schedule->year)
            ->firstOrFail();

        // Get all cells for that schedule
        $cells = $schedule->cells()->with('personnel')->get();

        // Group by personnel
        $grouped = $cells->groupBy('personnel_id');

        // Split by shift type
        $morning = $grouped->filter(fn($records) =>
            $records->first()->personnel->preferred_shift === 'Morning'
        );

        $evening = $grouped->filter(fn($records) =>
            $records->first()->personnel->preferred_shift === 'Evening'
        );

        return view('admin.schedules.view', [
            'schedule' => $schedule,
            'houses'   => $houses,
            'grouped'  => $grouped,
            'morning'  => $morning,
            'evening'  => $evening,
        ]);
    }



    public function updateCell(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|integer',
            'personnel_id' => 'required|integer',
            'date' => 'required|date',
            'shift_type' => 'required|string'
        ]);

        // Determine hours and overtime automatically
        $shift = $validated['shift_type'];

        // default values
        $hours = null;
        $isOvertime = false;

        switch ($shift) {

            case 'Morning':          // 8 hours shift
            case 'Training 8hrs':
                $hours = 8;
                break;

            case 'Evening':          // 12 hours shift
            case 'Training 12hrs':
                $hours = 12;
                break;

            case 'OT':               // overtime
                $hours = 0;          // you can change if needed
                $isOvertime = true;
                break;

            case 'Annual Leave':
            case 'Off':
                $hours = 0;          // makes sense for AL or off
                break;

            default:
                $hours = 0;          // fallback for unknown types
                break;
        }

        // Update database
        $cell = ScheduleCell::updateOrCreate(
            [
                'schedule_id' => $validated['schedule_id'],
                'personnel_id' => $validated['personnel_id'],
                'date' => $validated['date'],
            ],
            [
                'shift_type' => $shift,
                'hours' => $hours,
                'is_overtime' => $isOvertime
            ]
        );

        return response()->json([
            'success' => true,
            'cell' => $cell,
        ]);
    }

}
