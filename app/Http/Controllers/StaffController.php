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
        $query = Staff::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('full_name', 'like', "%{$search}%")
                  ->orWhere('employee_id', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
        }

        $staffs = $query->paginate(15);

        return view('admin.staff.index', compact('staffs'));
    }

    // Show create form (first 2 sections only)
    public function create()
    {
        $houses = House::all();
        return view('admin.staff.create', compact('houses'));
    }

    // Store new staff
    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            // 'full_name' => 'required|string|max:255',
            // 'employee_id' => 'required|string|unique:staff,employee_id',
            // 'role' => 'required|string',
            'basic_info' => 'nullable|array',
            'employment_details' => 'nullable|array',
        ]);

        $full_name = $validated['basic_info']['full_name'];
        $employee_id = $validated['basic_info']['employee_id'];
        $role = $validated['basic_info']['role'];

        $info = [
            'full_name' => $full_name,
            'employee_id' => $employee_id,
            'role' => $role,
            'basic_info' => $validated['basic_info'],
            'employment_details' => $validated['employment_details'],
        ];

        //dd($info);

        $staff = Staff::create($info);

        return redirect()
            ->route('admin.staff.edit', $staff->id)
            ->with('success', 'Staff member created. Complete remaining details in edit.');
    }

    // Show edit form (all 6 sections)
    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    // Update staff details
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'basic_info' => 'nullable|array',
            'employment_details' => 'nullable|array',
            'qualifications_training' => 'nullable|array',
            'compliance_legal' => 'nullable|array',
            'performance_notes' => 'nullable|array',
            'emergency_contact' => 'nullable|array',
        ]);

        foreach ($validated as $section => $data) {
            if (is_array($data)) {
                // Merge existing JSON with new values
                $staff->{$section} = array_merge($staff->{$section} ?? [], $data);
            }
        }

        $staff->save();

        return redirect()
            ->route('admin.staff.show', $staff->id)
            ->with('success', 'Staff member updated successfully.');
    }

    // Show single staff summary
    public function show(Staff $staff)
    {
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
