<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\Personnel;
use Illuminate\Support\Facades\Log;
use Exception;

class PersonnelController extends Controller
{
    public function create()
    {
        $houses = House::all();
        return view('admin.personnel.create', compact('houses'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('Incoming form data', $request->all());
            //dd($request);
            // ✅ Validate input
            $validated = $request->validate([
                'fullname' => 'required|string|max:255',
                'role' => 'required|in:Manager,Team Leader,Staff',
                'house_id' => 'required|exists:houses,id',
                'email' => 'nullable|email',
                'hours_type' => 'required|in:8,12',
                'preferred_shift' => 'nullable|in:Morning,Evening',
                'can_do_ot' => 'nullable|boolean',
                'status' => 'nullable|in:active,inactive',
            ]);

            // ✅ Handle checkbox value properly
            $validated['can_do_ot'] = $request->has('can_do_ot') ? 1 : 0;

            Log::info('Attempting to create new personnel record', $validated);

            // ✅ Try inserting into DB
            $personnel = Personnel::create($validated);

            Log::info('Personnel created successfully', ['id' => $personnel->id]);

            return redirect()
                ->route('admin.personnel.create')
                ->with('success', 'Staff created successfully.');

        } 
        catch (Exception $e) {
            Log::error('Error creating personnel record', [
                'message' => $e->getMessage(),
                'errors' => method_exists($e, 'errors') ? $e->errors() : null,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while saving staff details.');
        }

    }
}

