<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; 
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Nurse;
use App\Models\Hca;
use App\Models\Residents;
use App\Models\Schedule;
use App\Models\Patient;
use App\Models\Staff;
use App\Mail\HCANotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    
    public function index()
    {
        $admin = Admin::where('id', 1)->pluck('profile_image')->first();
        //dd($admin);
        Session::put('admin', $admin);
        $totalResidents = Residents::count();
        $totalPatients = Patient::count();
        $totalSupportWKs = Staff::where('role', 'Support_Worker')->count();
        $totalMgTms = Staff::whereIn('role', ['Manager', 'Team_Leader'])->count();
        $totalNurse = Nurse::count();
        $totlaHca = Hca::count();
        $totlaShifts = Schedule::count();
        $schedules = Schedule::latest()->get();
        $morningshifts = Schedule::latest()->get()->where('shift_type', 'Morning');
        $eveningshifts = Schedule::latest()->get()->where('shift_type', 'Evening');
        $groupedSchedules = $schedules->groupBy('day');

        return view('admin.dashboard', compact('totalResidents', 'totalPatients', 'totalMgTms', 'totalSupportWKs', 'totalNurse', 'totlaHca', 'totlaShifts','schedules','morningshifts', 'eveningshifts'));
    }
    public function signin()
    {
        return view('admin.index');
    }
    public function createhca()
    {
        return view('admin.createhca');
    }
    public function createnurse()
    {
        return view('admin.createnurse');
    }

    public function records()
    {
        $residents = Residents::all();
        return view('admin.records', ['residents' => $residents]);
    }

    public function editnurse($id){
        $nurse = Nurse::find($id);
        return view('admin.editnurse', compact('nurse'));
    }
    public function viewnurse($id){
        $nurse = Nurse::find($id);
        return view('admin.viewnurse', compact('nurse'));
    }

    public function updatenurse(Request $request, Nurse $nurse)
    {
        $dataform = $request->all();
 
         $nurse->update($dataform);

        return redirect()->route('admin.nurses')->with('success', 'Nurse record updated successfully.');
    }


    public function nurses()
    {
        $nurses = Nurse::latest()->get();
        return view('admin.nurses', ['nurses' => $nurses]);
    }

    public function createresident()
    {
        return view('admin.createresident');
    }
    public function hcaworkers()
    {
        $hcas = Hca::latest()->get();
        return view('admin.hcaworkers', ['hcas' => $hcas]);
    }
    
    public function residents()
    {
        $residents = Residents::latest()->get();
        return view('admin.residents', ['residents' => $residents]);
    }

    public function editresidents($id){
        $residents = Residents::find($id);
        return view('admin.editresidents', compact('residents'));
    }

    public function viewresidents($id){
        $residents = Residents::find($id);
        return view('admin.viewresident', compact('residents'));
    }
    
     public function updateresidents(Request $request, Residents $residents)
     {
        $dataform = $request->all();
 
         $residents->update($dataform);
 
         return redirect()->route('admin.residents')->with('success', 'Nurse record updated successfully.');
     }

    // Handle the admin login form submission
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password'); 
        //dd($credentials );
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();
            //dd($user );
            // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
            if ($user->isAdmin()) {
                return redirect()->intended('/admin');
            } else {
                Auth::guard('admin')->logout(); // Log out if user's role isn't allowed
                return redirect('/admin_signin')->withErrors(['message' => 'Access denied.']);
            }
        }
        

        return back()->withErrors(['message' => 'Invalid credentials']);

    }

    public function postcreatehca(Request $request)
    {
        $dataform = $request->all();
        //dd($dataform);

        $user = new Hca([
            'username' => $dataform['username'],
            'title' => $dataform['title'],
            'fullname' => $dataform['fullname'],
            'email' => $dataform['email'],
            'phone' => $dataform['phone'],
            'address' => $dataform['address'],
            'next_of_kin' => $dataform['next_of_kin'],
            'phone2' => $dataform['phone2'],
            'shift' => $dataform['shift'],
            'role' => 4,
            'status' => "active",
            'password' => Hash::make($dataform['password']), // Hash the password
            // Add other attributes as needed
        ]);
    
        $user->save(); // Save the user to the database
    
        // Redirect or show a success message
        // For example:
        return redirect()->route('admin.hcaworkers')->with('success', 'New HCA account created successfully!');

    }

    public function edithca($id){
        $hcas = Hca::find($id);
        return view('admin.edithca', compact('hcas'));
    }

    public function viewhca($id){
        $hcas = Hca::find($id);
        return view('admin.viewhca', compact('hcas'));
    }

    public function updatehca(Request $request, Hca $hcas)
     {
        $dataform = $request->all();
 
         $hcas->update($dataform);
 
         return redirect()->route('admin.hcaworkers')->with('success', 'Nurse record updated successfully.');
     }
    public function postcreatenurse(Request $request)
    {
        $dataform = $request->all();
        //dd($dataform);

        $nurse = new Nurse([
            'username' => $dataform['username'],
            'title' => $dataform['title'],
            'fullname' => $dataform['fullname'],
            'position' => $dataform['position'],
            'email' => $dataform['email'],
            'phone' => $dataform['phone'],
            'address' => $dataform['address'],
            'next_of_kin' => $dataform['next_of_kin'],
            'phone2' => $dataform['phone2'],
            'supervision' => $dataform['supervision'],
            'status' => $dataform['status'],
            'role' => 3,
            'password' => Hash::make($dataform['password']), // Hash the password
            // Add other attributes as needed
        ]);
    
        $nurse->save(); // Save the user to the database
    
        // Redirect or show a success message
        // For example:
        return redirect()->route('admin.nurses')->with('success', 'New Nurse account created successfully!');

    }    
    

    public function postcreateresident(Request $request)
    {
        $dataform = $request->all();
        //dd($dataform);

        $prefix = "HCARSDT";
        $startValue = 0;
        $digits = 3;
        $sequentialValue = $this->generateSequentialValue($prefix, $startValue, $digits);
    

        $residents = new Residents([
            'title' => $dataform['title'],
            'hca_no' => $sequentialValue,
            'fullname' => $dataform['fullname'],
            'dob' => $dataform['dob'],
            'address' => $dataform['address'],
            'email' => $dataform['email'],
            'gender' => $dataform['gender'],
            'maritalstatus' => $dataform['maritalstatus'],
            'nationalty' => $dataform['nationalty'],
            'language' => $dataform['language'],
            'next_of_kin' => $dataform['fullname2'],
            'relationship' => $dataform['relationship'],
            'nextofkin_address' => $dataform['address2'],
            'phone_no' => $dataform['phone'],
            'nextofkin_gender' => $dataform['gender2'],
            'room_no' => $dataform['room_no'],
            'medical_status' => $dataform['medicalstatus'],
            'status' => "active",

            //'password' => Hash::make($dataform['password']), // Hash the password
            // Add other attributes as needed
        ]);
    
        $residents->save(); // Save the user to the database
    
        // Redirect or show a success message
        // For example:
        return redirect()->route('admin.residents')->with('success', 'New Resident Profile created successfully!');

    }

    private function generateSequentialValue($prefix, $startValue, $digits) {
        $counter = $startValue;
        $counter++;
        $formattedCounter = str_pad($counter, $digits, '0', STR_PAD_LEFT);
        $sequentialValue = $prefix . $formattedCounter;
    
        return $sequentialValue;
    }

    public function shifts(){
        // Retrieve all schedule data
        $schedules = Schedule::latest()->get();
        // Group schedules by day (e.g., Monday to Friday)
        $groupedSchedules = $schedules->groupBy('day');
        $morningshifts = Schedule::latest()->get()->where('shift_type', 'Morning');
        $eveningshifts = Schedule::latest()->get()->where('shift_type', 'Evening');
        return view('admin.shifts', compact('groupedSchedules','schedules', 'morningshifts', 'eveningshifts'));
    }

    public function editshift($id){
        
        $hcas = Hca::latest()->get();
        $nurses = Nurse::latest()->get();
        $shifts = Schedule::find($id);
        return view('admin.editshifts', compact('shifts','nurses','hcas'));
    }
    public function updateShift(Request $request, $id){
        // Validate the form data
        //dd($request);
        $request->validate([
            'shift_type' => 'required|in:Morning,Evening', // Adjust validation rules as needed
            'date' => 'required|date',
            'hca1' => 'required',
            'hca2' => 'required',
            'floor1' => 'required',
            'hca3' => 'required',
            'hca4' => 'required',
            'floor2' => 'required',
            'hca5' => 'required',
            'hca6' => 'required',
            'floor3' => 'required',
            'nurse1' => 'required',
            'nursefloor1' => 'required',
            'nurse2' => 'required',
            'nursefloor2' => 'required',  
            'nurse3' => 'required',
            'nursefloor3' => 'required',           
        ]);
        // Retrieve the shift record by ID
        $shift = Schedule::find($id);

        // Update the shift record with the form data
        $shift->update([
            'staff_type_name' => $request->input('staff_type_name'),
            'shift_type' => $request->input('shift_type'),
            'date' => $request->input('date'),
            'hca1' => $request->input('hca1'),
            'hca2' => $request->input('hca2'),
            'floor1' => $request->input('floor1'),
            'hca3' => $request->input('hca3'),
            'hca4' => $request->input('hca4'),
            'floor2' => $request->input('floor2'),
            'hca5' => $request->input('hca5'),
            'hca6' => $request->input('hca6'),
            'floor3' => $request->input('floor3'),
            'nurse1' => $request->input('nurse1'),
            'nursefloor1' => $request->input('nursefloor1'),
            'nurse2' => $request->input('nurse2'),
            'nursefloor2' => $request->input('nursefloor2'),
            'nurse3' => $request->input('nurse3'),
            'nursefloor3' => $request->input('nursefloor3'),
        ]);
        // Redirect to a relevant page after updating
        return redirect()->route('admin.shifts')->with('success', 'Shift updated Successfully');
   
    }

    public function deleteshift($id){
        
        $shift = Schedule::find($id);
        if ($shift) {
            $shift->delete();
            return redirect()->route('admin.shifts')->with('success', 'Shift deleted Successfully');
        } else {
            return redirect()->route('admin.shifts')->with('error', 'Shift not found');
        }
    }

    public function postcreateShift1(Request $request){
        
        $data = $request->all(); // Assuming $request contains the input data.
        //dd($request);
        $rules = [
            'staff_type_name' => $request->staff_type_name,
            'shift_type' => $request->shift_type,
            'date' => $request->date,
            'hca1' => $request->hca1,
            'hca2' => $request->hca2,
            'floor1' => $request->floor1,
            'hca3' => $request->hca3,
            'hca4' => $request->hca4,
            'floor2' => $request->floor2,
            'hca5' =>$request->hca5,
            'hca6' => $request->hca6,
            'floor3' => $request->floor3,
            'nurse1' => $request->nurse1,
            'nursefloor1'  => $request->nursefloor1,
            'nurse2'  => $request->nurse2,
            'nursefloor2'  => $request->nursefloor2,
            'nurse3'  => $request->nurse3,
            'nursefloor3'  => $request->nursefloor3,
        ];
       
        try{
            $datas = array(
                'name'=> $rules['hca1'], 
                'date'=> $rules['date'], 
                'shift_type'=> $rules['shift_type'], 
            );
             // Check if the user has already registered for the morning shift on the same date
            $morningShiftExists = Schedule::where('date', $rules['date'])
            ->where('shift_type', 'Morning')
            ->first();

            if ($morningShiftExists && $rules['shift_type'] === 'Evening') {
               
                $morningRegistrants = Schedule::where('date', $rules['date'])
                ->where('shift_type', 'Morning')
                ->get();
                if ($morningRegistrants->isNotEmpty()) {
                    $hcas = Hca::latest()->get();
                    $nurses = Nurse::latest()->get();
                    return view('admin.createShifts', compact('morningRegistrants','hcas', 'nurses'));
                }
            }

            // Check if a record for the same date and shift type already exists
            $existingRecord = Schedule::where('date', $rules['date'])
            ->where('shift_type', $rules['shift_type'])
            ->first();

            if ($existingRecord) {
                // A record for this date and shift type already exists
                // Check if the current user has already registered for this shift
                $userAlreadyRegistered = Schedule::where('date', $rules['date'])
                ->where('shift_type', $rules['shift_type'])
                ->first();

                if ($userAlreadyRegistered) {
                    return redirect()->back()->with('error', 'You have already registered for this shift.');
                }
                
                // A record for this date and shift type already exists
                //return redirect()->back()->with('error', 'A schedule already exists for this date and shift type.');
            }

            Schedule::create($request->all());

           //Email HCA
            $emailhca1 = Hca::where('fullname', $rules['hca1'])->get();
            foreach ($emailhca1 as $hca) {
                $email = $hca->email;
                // dd($email); // You can uncomment this line for debugging
                Mail::send('emails.HCANotification', $datas, function ($message) use ($email) {
                    $message->from('caredoctor001@gmail.com');
                    $message->to($email);
                    $message->subject('Residential Healthcare and Carehome');
                });
            }

            $emailhca2 = Hca::where('fullname', $rules['hca2'])->get();
            foreach ($emailhca2 as $hca) {
                $email = $hca->email;
                //dd($email);
                Mail::send('emails.HCANotification', $datas, function ($message) use ($email) {
                    $message->from('caredoctor001@gmail.com');
                   // $message->sender('web@firstmultiplemfbank.com', 'FMMFB IT');
                    $message->to($email);
                    $message->subject('Residential Healthcare and Carehome');
                });
            }
            
            $emailhca3 = Hca::where('fullname', $rules['hca3'])->get();
            foreach ($emailhca3 as $hca) {
                $email = $hca->email;
                //dd($email);
                Mail::send('emails.HCANotification', $datas, function ($message) use ($email) {
                    $message->from('caredoctor001@gmail.com');
                   // $message->sender('web@firstmultiplemfbank.com', 'FMMFB IT');
                    $message->to($email);
                    $message->subject('Residential Healthcare and Carehome');
                });
            }

            $emailhca4 = Hca::where('fullname', $rules['hca4'])->get();
            foreach ($emailhca4 as $hca) {
                $email = $hca->email;
                //dd($email);
                Mail::send('emails.HCANotification', $datas, function ($message) use ($email) {
                    $message->from('caredoctor001@gmail.com');
                   // $message->sender('web@firstmultiplemfbank.com', 'FMMFB IT');
                    $message->to($email);
                    $message->subject('Residential Healthcare and Carehome');
                });
            }

            $emailhca5 = Hca::where('fullname', $rules['hca5'])->get();
            foreach ($emailhca5 as $hca) {
                $email = $hca->email;
                //dd($email);
                Mail::send('emails.HCANotification', $datas, function ($message) use ($email) {
                    $message->from('caredoctor001@gmail.com');
                   // $message->sender('web@firstmultiplemfbank.com', 'FMMFB IT');
                    $message->to($email);
                    $message->subject('Residential Healthcare and Carehome');
                });
            }
            $emailhca6 = Hca::where('fullname', $rules['hca6'])->get();
            foreach ($emailhca6 as $hca) {
                $email = $hca->email;
                //dd($email);
                Mail::send('emails.HCANotification', $datas, function ($message) use ($email) {
                    $message->from('caredoctor001@gmail.com');
                   // $message->sender('web@firstmultiplemfbank.com', 'FMMFB IT');
                    $message->to($email);
                    $message->subject('Residential Healthcare and Carehome');
                });
            }
            
            //Nurse
            $nurse1 = Nurse::where('fullname', $rules['nurse1'])->get();
            foreach ($nurse1 as $hca) {
                $email = $hca->email;
                //dd($email);
                Mail::send('emails.HCANotification', $datas, function ($message) use ($email) {
                    $message->from('caredoctor001@gmail.com');
                   // $message->sender('web@firstmultiplemfbank.com', 'FMMFB IT');
                    $message->to($email);
                    $message->subject('Residential Healthcare and Carehome');
                });
            }
            $nurse2 = Nurse::where('fullname', $rules['nurse2'])->get();
            foreach ($nurse2 as $hca) {
                $email = $hca->email;
                //dd($email);
                Mail::send('emails.HCANotification', $datas, function ($message) use ($email) {
                    $message->from('caredoctor001@gmail.com');
                   // $message->sender('web@firstmultiplemfbank.com', 'FMMFB IT');
                    $message->to($email);
                    $message->subject('Residential Healthcare and Carehome');
                });
            } 
            $nurse3 = Nurse::where('fullname', $rules['nurse3'])->get();
            foreach ($nurse3 as $hca) {
                $email = $hca->email;
                //dd($email);
                Mail::send('emails.HCANotification', $datas, function ($message) use ($email) {
                    $message->from('caredoctor001@gmail.com');
                   // $message->sender('web@firstmultiplemfbank.com', 'FMMFB IT');
                    $message->to($email);
                    $message->subject('Residential Healthcare and Carehome');
                });
            }   
            
            //$email = new HCANotification($rules);
            //Mail::to('eshanokpe@gmail.com')->send($email);
           
        } catch(Exception $th){
            return response()->json(['something went Error']);
        }

       // $validatedData = $request->validate($rules, $data);
        // if ($validatedData->fails()) {
        //     return redirect()
        //         ->back()
        //         ->withErrors($validatedData)
        //         ->withInput();
        // }
       
        return redirect()->route('admin.shifts')->with('success', 'Schedule created successfully.');  
    }

    public function postcreateShift(Request $request)
    {
        try {
            $rules = $request->only([
                'staff_type_name',
                'shift_type',
                'date',
                'hca1', 'hca2', 'hca3', 'hca4', 'hca5', 'hca6',
                'floor1', 'floor2', 'floor3',
                'nurse1', 'nurse2', 'nurse3',
                'nursefloor1', 'nursefloor2', 'nursefloor3'
            ]);

            Log::info('Attempting to create new shift', $rules);

            // ✅ If we're creating an evening shift, check if a morning shift exists
            if ($rules['shift_type'] === 'Evening') {
                $morningShiftExists = Schedule::where('date', $rules['date'])
                    ->where('shift_type', 'Morning')
                    ->exists();

                Log::info('Morning shift existence check', [
                    'date' => $rules['date'],
                    'exists' => $morningShiftExists,
                ]);

                if ($morningShiftExists) {
                    Log::info('Morning shift exists, proceeding to create evening shift', [
                        'date' => $rules['date']
                    ]);
                }
            }

            // ✅ Check if the same shift type already exists for that date
            $existingShiftExists = Schedule::where('date', $rules['date'])
                ->where('shift_type', $rules['shift_type'])
                ->exists();

            Log::info('Checking for existing schedule', [
                'date' => $rules['date'],
                'shift_type' => $rules['shift_type'],
                'exists' => $existingShiftExists,
            ]);

            if ($existingShiftExists) {
                Log::warning('Duplicate shift creation attempt blocked', [
                    'date' => $rules['date'],
                    'shift_type' => $rules['shift_type']
                ]);
                return redirect()->back()->with('error', 'A schedule already exists for this date and shift type.');
            }

            // ✅ Create the new schedule
            $schedule = Schedule::create($rules);
            Log::info('New schedule created successfully', [
                'id' => $schedule->id,
                'date' => $rules['date'],
                'shift_type' => $rules['shift_type']
            ]);

            // ✅ Helper closure to send mail
            $sendEmail = function ($model, $field) use ($rules) {
                if (empty($field)) return;

                $records = $model::where('fullname', $field)->get();

                foreach ($records as $rec) {
                    if (empty($rec->email)) continue;

                    // ✅ Personalized email content
                    $datas = [
                        'name' => $rec->fullname,
                        'date' => $rules['date'],
                        'shift_type' => $rules['shift_type'],
                    ];

                    Log::info("Sending email to {$rec->email} ({$rec->fullname})");

                    Mail::send('emails.HCANotification', $datas, function ($message) use ($rec) {
                        $message->from('support@clearpointrecruitment.co.uk')
                            ->to($rec->email)
                            ->subject('Residential Healthcare and Carehome');
                    });
                }
            };

            // ✅ Send notifications
            foreach (['hca1','hca2','hca3','hca4','hca5','hca6'] as $hcaField) {
                $sendEmail(Hca::class, $rules[$hcaField] ?? null);
            }

            foreach (['nurse1','nurse2','nurse3'] as $nurseField) {
                $sendEmail(Nurse::class, $rules[$nurseField] ?? null);
            }


            Log::info('All notification emails sent successfully.');

            return redirect()->route('admin.shifts')->with('success', 'Schedule created successfully.');

        } catch (\Exception $e) {
            Log::error('Error creating shift', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Something went wrong while creating the schedule.');
        }
    }

    public function getMorningRegistrants($date, $staffType)
    {
        return Schedule::where('date', $date)
            ->where('shift_type', 'Morning')
            ->where('staff_type_name', $staffType)
            ->get();
    }

    public function addShifts(){
        $hcas = Hca::latest()->get();
        $nurses = Nurse::latest()->get();
        return view('admin.createShifts', compact('hcas', 'nurses'));
    }
 
    // Admin logout
    public function logout(Request $request)
    {
       Auth::logout();
 
       $request->session()->invalidate();
 
       $request->session()->regenerateToken();
 
       return redirect('/admin_signin');
    }

    public function setting()
    {
        $admin = Admin::where('id', 1)->pluck('profile_image')->first();
        $adminP = Admin::where('id', 1)->first();

        return view('admin.setting', compact('admin', 'adminP'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Admin::where('id', 1)->pluck('profile_image')->first();
        // Validate the request
        //dd($admin);
        $validator = Validator::make($request->all(), [
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
           'fullName' => 'required|string|max:255',
            // 'job' => 'required|string|max:255',
            // 'address' => 'nullable|string|max:255',
            // 'phone' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Fetch the admin record
        $admin = Admin::findOrFail(1); // Assuming the admin ID is 1, adjust as needed

        // Update profile information
         $admin->fullname = $request->input('fullName');
        // $admin->job = $request->input('job');
        // $admin->address = $request->input('address');
        // $admin->phone = $request->input('phone');

        // Handle the file upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads'), $imageName);

            // Update the admin's profile image path in the database
            $admin->profile_image = 'uploads/' . $imageName;
        }

        // Save changes to the admin record
        $admin->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }
    public function changePassword(Request $request)
    {
        $admin = Admin::where('id', 1)->pluck('profile_image')->first();
        $request->validate([
            'password' => 'required',
            'newpassword' => 'required|string|min:8|different:password',
            'renewpassword' => 'required|same:newpassword',
        ]);

        $user = Admin::where('username', 'admin')->first();

        if (!Hash::check($request->password, $user->password)) {
            
            return response()->json(['error' => 'The current password is incorrect.'], 422);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return response()->json(['success' => 'Password has been changed successfully.']);
    }

    public function createStep1()
    {
        return view('admin.residents.create-step1');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'dob'       => 'required|date',
            'gender'    => 'required'
        ]);

        $resident = Resident::create([
            'full_name'       => $request->full_name,
            'preferred_name'  => $request->preferred_name,
            'dob'             => $request->dob,
            'gender'          => $request->gender,
            'ethnicity'       => $request->ethnicity,
            'language'        => $request->language,
            'religion'        => $request->religion,
            'nationality'     => $request->nationality,
        ]);

        return redirect()->route('admin.residents.create.step2', $resident->id);
    }

}