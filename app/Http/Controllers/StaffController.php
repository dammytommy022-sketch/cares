<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;
use App\Models\House;



class StaffController extends Controller
{
    // Display all staff
    public function index(Request $request)
    {
        $query = Staff::query()
            ->where('employment_details->status', '!=', 'Suspended');   // ⬅ EXCLUDE SUSPENDED

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                ->orWhere('employee_id', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%");
            });
        }

        $staffs = $query->paginate(15);

        return view('admin.staff.index', compact('staffs'));
    }

    public function all(Request $request)
    {
        $query = Staff::query();
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                ->orWhere('employee_id', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%");
            });
        }

        $staffs = $query->paginate(15);

        return view('admin.staff.all', compact('staffs'));
    }


    // Show create form (first 2 sections only)
    public function create()
    {
        $houses = House::all();
        $supervisors = Staff::whereIn('role', ['Manager', 'Team_Leader'])->get();

        return view('admin.staff.create', compact('houses', 'supervisors'));
    }

    // Store new staff
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'basic_info' => 'required|array',
            'employment_details' => 'required|array',
        ]);

        // Extract non-JSON fields
        $full_name = $validated['basic_info']['full_name'] ?? null;
        $employee_id = $validated['basic_info']['employee_id'] ?? null;
        $role = $validated['basic_info']['role'] ?? null;

        // Create Staff member
        $staff = Staff::create([
            'full_name'   => $full_name,
            'employee_id' => $employee_id,
            'role'        => $role,

            // JSON fields
            'basic_info'         => $validated['basic_info'],
            'employment_details' => $validated['employment_details'],
        ]);

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff member created. Complete remaining details in edit.');
    }


    // Show edit form (all 6 sections)
    public function edit(Staff $staff)
    {
        $houses = House::all();
        $supervisors = Staff::whereIn('role', ['Manager', 'Team_Leader'])->get();

        return view('admin.staff.edit', compact('staff', 'houses', 'supervisors'));
    }

    // Update staff details
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'basic_info'             => 'nullable|array',
            'employment_details'     => 'nullable|array',
            'qualifications_training'=> 'nullable|array',
            'compliance_legal'       => 'nullable|array',
            'performance_notes'      => 'nullable|array',
            'emergency_contact'      => 'nullable|array',
        ]);

        // ───── Update non-JSON columns from basic_info only if they exist ─────
        if (!empty($validated['basic_info'])) {

            $staff->full_name   = $validated['basic_info']['full_name']   ?? $staff->full_name;
            $staff->employee_id = $validated['basic_info']['employee_id'] ?? $staff->employee_id;
            $staff->role        = $validated['basic_info']['role']        ?? $staff->role;
        }

        // ───── Update JSON sections (merge instead of overwrite) ─────
        $jsonSections = [
            'basic_info',
            'employment_details',
            'qualifications_training',
            'compliance_legal',
            'performance_notes',
            'emergency_contact'
        ];

        foreach ($jsonSections as $section) {
            if (isset($validated[$section])) {
                $staff->{$section} = array_merge(
                    $staff->{$section} ?? [],
                    $validated[$section]
                );
            }
        }

        $staff->save();

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff member updated successfully.');
    }


    // Show single staff summary
    public function show(Staff $staff)
    {
        $staff->load('house');
        return view('admin.staff.show', compact('staff'));
    }

    // Delete staff
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('admin.staff.index')
                         ->with('success', 'Staff member deleted.');
    }
}
