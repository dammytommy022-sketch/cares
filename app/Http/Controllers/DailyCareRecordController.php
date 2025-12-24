<?php

namespace App\Http\Controllers;

use App\Models\DailyCareRecord;
use App\Models\BehaviourIncident;
use App\Models\RiskAssessment;
use App\Models\WoundRecord;
use App\Models\Incident;
use App\Models\RestraintRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyCareRecordController extends Controller
{
    /**
     * List daily care records for a resident
     */
    public function index(Patient $resident)
    {
        $recordsDailyCare = DailyCareRecord::where('resident_id', $resident->resident_id)->orderBy('date', 'desc')->latest()->get();
        $recordsBehaviour = BehaviourIncident::where('resident_id', $resident->resident_id)->orderBy('date', 'desc')->latest()->get();
        $recordsRisk      = RiskAssessment::where('resident_id', $resident->resident_id)->orderBy('created_at', 'desc')->latest()->get();
        $recordsWound     = WoundRecord::where('resident_id', $resident->resident_id)->orderBy('date', 'desc')->latest()->get();
        $records = [
            'dailyCare' => $recordsDailyCare,
            'behaviour' => $recordsBehaviour,
            'risk'      => $recordsRisk,
            'wound'     => $recordsWound,
        ];
        return view('admin.records.dailyForms.index', [
            'resident' => $resident,
            'records'  => $records,
        ]);
    }

    /**
     * Store new daily care record (AJAX)
     */
    public function storeDailyCare(Request $request)
    {
        $validated = $request->validate([
            'resident_id' => 'required|string',
            'date'        => 'required|date',
            'task_type'   => 'required|string|max:255',
            'completed'   => 'nullable|boolean',
            'notes'       => 'nullable|string',
        ]);

        // Temporary staff data (replace with Auth staff later)
        $employeeId = auth()->user()->employee_id ?? 'SW1009';
        $initials   = auth()->user()->initials ?? 'AB';

        DailyCareRecord::create([
            'resident_id'    => $validated['resident_id'],
            'date'           => $validated['date'],
            'task_type'      => $validated['task_type'],
            'completed'      => $validated['completed'] ?? true,
            'notes'          => $validated['notes'],
            'employee_id'    => $employeeId,
            'staff_initials' => $initials,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Daily care record saved successfully',
        ]);
    }

    public function toggle(DailyCareRecord $record)
    {
        $record->update([
            'completed' => !$record->completed
        ]);

        return response()->json(['message' => 'Status updated']);
    }

     /**
     * Store Risk Assessment
     */
    public function storeRisk(Request $request)
    {
        $validated = $request->validate([
            'resident_id' => 'required|string',
            'risk_type'   => 'required|string',
            'risk_level'  => 'required|string',
            'description'=> 'required|string',
            'controls'   => 'nullable|string',
        ]);

        RiskAssessment::create([
            ...$validated,
            'staff_initials' => auth()->user()->initials ?? 'AB',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Risk assessment added successfully',
        ]);
    }

    /**
     * Store Wound Record
     */
    public function storeWound(Request $request)
    {
        $validated = $request->validate([
            'resident_id' => 'required|string',
            'date'        => 'required|date',
            'wound_type'  => 'required|string',
            'location'    => 'required|string',
            'dressing'    => 'nullable|string',
            'notes'       => 'nullable|string',
        ]);

        WoundRecord::create([
            ...$validated,
            'staff_initials' => auth()->user()->initials ?? 'AB',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Wound record saved successfully',
        ]);
    }

    /**
     * Store Behaviour Incident
     */
    public function storeBehaviour(Request $request)
    {
        $validated = $request->validate([
            'resident_id'   => 'required|string',
            'date'          => 'required|date',
            'incident_type' => 'required|string',
            'description'   => 'required|string',
            'action_taken'  => 'nullable|string',
        ]);

        BehaviourIncident::create([
            ...$validated,
            'staff_initials' => auth()->user()->initials ?? 'AB',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Behaviour incident recorded successfully',
        ]);
    }

     public function storeRestraint(Request $request)
    {
        $validated = $request->validate([
            'resident_id'            => 'required|string',
            'incident_date'          => 'required|date',
            'incident_time'          => 'required',
            'behaviour_type'         => 'required|string|max:255',
            'restraint_type'         => 'nullable|string|max:255',
            'duration_minutes'       => 'nullable|integer|min:1',
            'trigger'                => 'nullable|string',
            'action_taken'           => 'required|string',
            'outcome'                => 'nullable|string',
            'injury_occurred'        => 'required|boolean',
            'review_status'          => 'required|string',
            'notes'                  => 'nullable|string',
        ]);

        // Combine date + time
        $incidentDateTime = \Carbon\Carbon::parse(
            $validated['incident_date'] . ' ' . $validated['incident_time']
        );

        // Temporary staff (replace with auth later)
        $employeeId = auth()->user()->employee_id ?? 'SW1009';

        // Convert review status to reported flag
        $reported = in_array($validated['review_status'], ['Reviewed', 'Escalated']);

        \App\Models\RestraintRecord::create([
            'resident_id'           => $validated['resident_id'],
            'employee_id'           => $employeeId,
            'incident_datetime'     => $incidentDateTime,
            'record_type'           => $validated['behaviour_type'],
            'trigger'               => $validated['trigger'] ?? null,
            'restraint_method'      => $validated['restraint_type'] ?? null,
            'severity'              => 'Medium', // default, can be improved later
            'duration_minutes'      => $validated['duration_minutes'] ?? null,
            'intervention_details'  => trim(
                $validated['action_taken'] . "\n\n" . ($validated['notes'] ?? '')
            ),
            'outcome'               => $validated['outcome'] ?? null,
            'injury_occurred'       => $validated['injury_occurred'],
            'reported'              => $reported,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Restraint / behaviour record saved successfully',
        ]);
    }

    public function storeIncident(Request $request)
    {
        $validated = $request->validate([
            'resident_id'   => 'required|string',
            'incident_date' => 'required|date',
            'incident_type' => 'required|string|max:255',
            'status'        => 'required|in:Open,Under Review,Closed,Monitored',
            'action_taken'  => 'required|string',
            'notes'         => 'nullable|string',
        ]);

        $employeeId = auth()->user()->employee_id ?? 'SW1009';

        Incident::create([
            'resident_id'            => $validated['resident_id'],
            'employee_id'            => $employeeId,
            'incident_date'          => $validated['incident_date'],
            'incident_type'          => $validated['incident_type'],
            'status'                 => $validated['status'],
            'action_taken'           => $validated['action_taken'],

            // Map notes → description
            'description'            => $validated['notes'] ?? null,

            // Optional fields (future-ready)
            'location'               => null,
            'reported_to_manager'    => false,
            'safeguarding_required'  => false,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Incident saved successfully',
        ]);
    }


}
