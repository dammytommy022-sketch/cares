<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Activity;
use App\Models\Meal;
use App\Models\Weight;

class LifestyleController extends Controller
{
    
    public function storeActivity(Request $request)
    {
        $data = $request->validate([
            'resident_id' => 'required|exists:patients,resident_id',
            'date' => 'required|date',
            'activity' => 'required|string',
            'participation' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $employeeId = 'SW12345'; // later from auth user

        Activity::create([
            'resident_id'         => $data['resident_id'],
            'date'                => $data['date'],
            'activity'            => $data['activity'],
            'participation_level' => $data['participation'] ?? null,
            'notes'               => $data['notes'] ?? null,
            'employee_id'         => $employeeId,
        ]);

        return response()->json(['message' => 'Activity added successfully']);
    }


    public function storeMeal(Request $request)
    {
        $data = $request->validate([
            'resident_id' => 'required|exists:patients,resident_id',
            'date' => 'required|date',
            'meal' => 'required|string',
            'portion' => 'required|string',
            'fluids' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        $employeeId = 'SW12345'; // later from auth user

        Meal::create([
            'resident_id' => $data['resident_id'],
            'date'        => $data['date'],
            'meal'        => $data['meal'],
            'portion'     => $data['portion'],
            'fluids'      => $data['fluids'],
            'notes'       => $data['notes'] ?? null,
            'employee_id'         => $employeeId,

        ]);

        return response()->json(['message' => 'Meal added']);
    }

    public function storeWeight(Request $request)
    {
        $data = $request->validate([
            'resident_id' => 'required',
            'recorded_at' => 'required|date',
            'weight' => 'required|numeric|min:1',
            'notes' => 'nullable|string',
        ]);

        Weight::create([
            ...$data,
            'unit' => 'kg',
            'employee_id' => auth()->user()->employee_id ?? 'Admin',
        ]);

        return response()->json(['message' => 'Weight recorded successfully']);
    }
}

