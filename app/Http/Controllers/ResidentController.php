<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ResidentController extends Controller
{
    /**
     * Display a listing of all residents
     */
    

    public function index(Request $request)
    {
        $query = Patient::query();

        if ($search = $request->input('search')) {
            
            $query->where(function ($q) use ($search) {

                $q->where('basic_info->full_name', 'LIKE', "%{$search}%")
                ->orWhere('basic_info->preferred_name', 'LIKE', "%{$search}%")
                ->orWhere('basic_info->gender', 'LIKE', "%{$search}%")
                ->orWhere('basic_info->ethnicity', 'LIKE', "%{$search}%")

                ->orWhere('guardian_info->parents', 'LIKE', "%{$search}%")
                ->orWhere('guardian_info->contacts->phone', 'LIKE', "%{$search}%")
                ->orWhere('guardian_info->contacts->email', 'LIKE', "%{$search}%")

                ->orWhere('placement_info->type', 'LIKE', "%{$search}%")
                ->orWhere('placement_info->reason', 'LIKE', "%{$search}%")

                ->orWhere('medical_info->diagnoses', 'LIKE', "%{$search}%")
                ->orWhere('medical_info->allergies', 'LIKE', "%{$search}%");
            });
        }

        $residents = $query->latest()->paginate(10);

        return view('admin.residents.index', compact('residents'));
    }


    /**
     * Show the form for creating a new resident
     */
    public function create()
    {
        $nationalities = json_decode(file_get_contents(resource_path('data/nationalities.json')), true)['nationalities'];
        $ethnicities = json_decode(file_get_contents(resource_path('data/ethnicities.json')), true)['ethnicities'];
        $languages = json_decode(file_get_contents(resource_path('data/languages.json')), true)['languages'];
        $religions = json_decode(file_get_contents(resource_path('data/religions.json')), true)['religions'];
        return view('admin.residents.create', compact('nationalities', 'ethnicities', 'languages', 'religions')); 
    }

    /**
     * Store a newly created resident
     */
    public function store(Request $request)
    {
        // Validate all 10 JSON sections (each optional)
        $validated = $request->validate([
            'basic_info'               => 'nullable|array',
            'guardian_info'            => 'nullable|array',
            'placement_info'           => 'nullable|array',
            'medical_info'             => 'nullable|array',
            'education_info'           => 'nullable|array',
            'behaviour_info'           => 'nullable|array',
            'social_family_info'       => 'nullable|array',
            'legal_safeguarding_info'  => 'nullable|array',
            'daily_living_info'        => 'nullable|array',
            'documents.*'              => 'nullable|file|max:10240', // 10MB each
        ]);

        // Handle uploaded documents
        $documentPaths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $documentPaths[] = $file->store('resident_documents', 'public');
            }
        }

        // Assign validated data
        $resident = new Patient($validated);
        $resident->documents = $documentPaths;
        $resident->save();

        return redirect()
            ->route('admin.residents.index')
            ->with('success', 'Resident created successfully.');
    }

    /**
     * Display a single resident
     */
    public function show(Patient $resident)
    {
        return view('admin.residents.show', compact('resident'));
    }

    /**
     * Show the form for editing a resident
     */
    public function edit(Patient $resident)
    {
        return view('admin.residents.edit', compact('resident'));
    }

    /**
     * Update an existing resident
     */
    public function update(Request $request, Patient $resident)
    {
        Log::info("===== UPDATE REQUEST RECEIVED =====");
        Log::info("Raw Input: " . json_encode($request->all()));

        // Validate core JSON sections
        $validated = $request->validate([
            'basic_info'               => 'nullable|array',
            'guardian_info'            => 'nullable|array',
            'placement_info'           => 'nullable|array',
            'medical_info'             => 'nullable|array',
            'education_info'           => 'nullable|array',
            'behaviour_info'           => 'nullable|array',
            'social_family_info'       => 'nullable|array',
            'legal_safeguarding_info'  => 'nullable|array',
            'daily_living_info'        => 'nullable|array',
            'documents'                => 'nullable|array',
            'documents.*'              => 'nullable|file|max:10240' // 10MB
        ]);

        Log::info("Validated Data: " . json_encode($validated));

        // Merge JSON cleanly
        foreach ($validated as $key => $value) {
            if (is_array($value) && $key !== 'documents') {
                $resident->{$key} = array_merge($resident->{$key} ?? [], $value);
            }
        }

        // ALL DOCUMENT KEYS WE EXPECT
        $docKeys = [
            'birth_certificate',
            'id_passport',
            'care_plan',
            'risk_assessment',
            'behaviour_plan',
            'ehcp',
            'medical_reports',
            'consent_forms',
            'social_worker'
        ];

        $existingDocs = $resident->documents ?? [];

        Log::info("Existing Docs Before Update: " . json_encode($existingDocs));

        // Loop through document fields and update only if new file uploaded
        foreach ($docKeys as $docKey) {

            if ($request->hasFile("documents.$docKey")) {

                $file = $request->file("documents.$docKey");

                Log::info("New file detected for: $docKey");

                // Delete old file if exists
                if (!empty($existingDocs[$docKey]) && Storage::disk('public')->exists($existingDocs[$docKey])) {
                    Storage::disk('public')->delete($existingDocs[$docKey]);
                }

                // Upload new file
                $path = $file->store('resident_documents', 'public');
                $existingDocs[$docKey] = $path;

            } else {
                Log::info("No new file for: $docKey — keeping existing.");
            }
        }

        // Save updated documents array
        $resident->documents = $existingDocs;

        Log::info("Final Documents Stored: " . json_encode($resident->documents));

        $resident->save();

        return redirect()
            ->route('admin.residents.show', $resident->id)
            ->with('success', 'Resident updated successfully.');
    }




    /**
     * Delete a resident
     */
    public function destroy(Resident $resident)
    {
        // Optional: delete physical files
        if ($resident->documents) {
            foreach ($resident->documents as $doc) {
                storage_path('public/' . $doc);
            }
        }

        $resident->delete();

        return redirect()
            ->route('admin.residents.index')
            ->with('success', 'Resident deleted successfully.');
    }
}
