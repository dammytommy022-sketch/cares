<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Hca;
use App\Models\Note;
use App\Models\Formfcl;
use App\Models\Formpcc;
use App\Models\Formmec;
use App\Models\Formmbec;
use App\Models\Formsiwc;
use App\Models\Formbc;
use App\Models\Formfc;
use App\Models\Formfic;
use App\Models\Formmbc;
use App\Models\Forms;
use App\Models\Residents;
use App\Models\Schedule;
use App\Models\HCAPasswordModel;
use App\Mail\HCAEmailForgetPassword;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail; 
use DB; 
use Illuminate\Support\Facades\Validator;

class HcaController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
        $user = session('user');
        $hcaFloor = session('hca');
        //dd($user, $hcaFloor);
        if ($hcaFloor == "hca1"){
            $floor = "floor 1";
            $residents = Residents::all()->where('room_no', $floor);
            //dd($user, $hcaFloor, $residents);
            return view('user.dashboard',  ['residents' => $residents], compact('user'));
        }
        elseif($hcaFloor == "hca2"){
            $floor = "floor 1";
            $residents = Residents::all()->where('room_no', $floor);
            //dd($user, $hcaFloor, $residents);
            return view('user.dashboard',  ['residents' => $residents], compact('user'));
        }
        elseif($hcaFloor == "hca3"){
            $floor = "floor 2";
            $residents = Residents::all()->where('room_no', $floor);
            //dd($user, $hcaFloor, $residents);
            return view('user.dashboard',  ['residents' => $residents], compact('user'));
        }
        elseif($hcaFloor == "hca4"){
            $floor = "floor 2";
            $residents = Residents::all()->where('room_no', $floor);
            //dd($user, $hcaFloor, $residents);
            return view('user.dashboard',  ['residents' => $residents], compact('user'));
        }
        elseif($hcaFloor == "hca5"){
            $floor = "floor 3";
            $residents = Residents::all()->where('room_no', $floor);
            //dd($user, $hcaFloor, $residents);
            return view('user.dashboard',  ['residents' => $residents], compact('user'));
        }
        elseif($hcaFloor == "hca6"){
            $floor = "floor 3";
            $residents = Residents::all()->where('room_no', $floor);
            //dd($user, $hcaFloor, $residents);
            return view('user.dashboard',  ['residents' => $residents], compact('user'));
        }
        
        

        $residents = Residents::all();
       // $hca = $user->fullname;


        
        return view('user.dashboard',  ['residents' => $residents], compact('user'));
    }
    public function resident($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        //dd($residents);
        return view('user.resident', compact('residents', 'user'));
    }
    public function note($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        $hca_no = $residents->hca_no;
        $notes = Note::where('hca_no', $hca_no)->latest()->get();
        //$notes = Note::all()->where('hca_no', $hca_no)->latest();
        return view('user.note', compact('residents', 'user', 'notes'));
    }
    public function postnote(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $note = new Note([
            'hca_no' => $dataform['hca_no'],
            'hca_name' => $dataform['hca_name'],
            'date' => $dataform['date'],
            'note' => $dataform['note'],
            // Add other attributes as needed
        ]);
        $note->save(); // Save the user to the database
    
        return redirect()->route('hca.note', ['id' => $id])->with('success', 'Your Obsaervation has been added');

    }
    public function form($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        return view('user.form', compact('residents', 'user'));
    }
    public function forms($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        return view('user.forms', compact('residents', 'user'));
    }
    public function form_fcl($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        $hca_no = $residents->hca_no;
        $historys = Formfcl::where('resident_no', $hca_no)->latest()->get();
        //dd($historys);
        
        return view('user.form_fcl', compact('residents', 'user', 'historys'));
    }

    public function post_fcl(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Formfcl([
            'resident_no' => $dataform['resident_no'],
            'hca_name' => $dataform['hca_name'],
            'date_log' => $dataform['date_log'],
            'time_log' => $dataform['time_log'],
            'family_name' => $dataform['family_name'],
            'reason' => $dataform['reason'],
            
            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.fcl', ['id' => $id])->with('success', 'Communication Log Successful');
    }
    public function form_pcc($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        $hca_no = $residents->hca_no;
        $historys = Formpcc::where('resident_no', $hca_no)->latest()->get();
        
        return view('user.form_pcc', compact('residents', 'user', 'historys'));
    }
    public function post_pcc(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Formpcc([
            'resident_no' => $dataform['resident_no'],
            'hca_name' => $dataform['hca_name'],
            'date_log' => $dataform['date_log'],
            'time_log' => $dataform['time_log'],
            'activity' => $dataform['activity'],
            'observation' => $dataform['observation'],
            
            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.pcc', ['id' => $id])->with('success', 'Activity logged successfully');
    }
    public function form_mec($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        $hca_no = $residents->hca_no;
        $historys = Formmec::where('resident_no', $hca_no)->latest()->get();
        
        return view('user.form_mec', compact('residents', 'user', 'historys'));
    }
    public function post_mec(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Formmec([
            'resident_no' => $dataform['resident_no'],
            'hca_name' => $dataform['hca_name'],
            'date_log' => $dataform['date_log'],
            'time_log' => $dataform['time_log'],
            'medication' => $dataform['med_name'],
            'dosage' => $dataform['dosage'],
            'instruction' => $dataform['instruction'],
            
            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.mec', ['id' => $id])->with('success', 'Medication logged successfully');
    }
    public function form_mbec($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        $hca_no = $residents->hca_no;
        $historys = Formmbec::where('resident_no', $hca_no)->latest()->get();
        
        return view('user.form_mbec', compact('residents', 'user', 'historys'));
    }
    public function post_mbec(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Formmbec([
            'resident_no' => $dataform['resident_no'],
            'hca_name' => $dataform['hca_name'],
            'date_log' => $dataform['date_log'],
            'time_log' => $dataform['time_log'],
            'activity' => $dataform['activity'],
            'duration' => $dataform['duration'],
            'assistance' => $dataform['assistance'],
            'observation' => $dataform['observation'],
            
            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.mbec', ['id' => $id])->with('success', 'Acctivity logged successfully');
    }
    public function form_siwc($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        $hca_no = $residents->hca_no;
        $historys = Formsiwc::where('resident_no', $hca_no)->latest()->get();
        
        return view('user.form_siwc', compact('residents', 'user', 'historys'));
    }
    public function post_siwc(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Formsiwc([
            'resident_no' => $dataform['resident_no'],
            'hca_name' => $dataform['hca_name'],
            'date_log' => $dataform['date_log'],
            'time_log' => $dataform['time_log'],
            'length' => $dataform['length'],
            'width' => $dataform['width'],
            'treatment' => $dataform['treatment'],
            
            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.siwc', ['id' => $id])->with('success', 'Skin Assesment logged successfully');
    }
    public function form_bowel($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        return view('user.form_bowel', compact('residents', 'user'));
    }
     
    public function postform_bowel(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Forms([
            'hca_no' => $dataform['hca_no'],
            'hca_name' => $dataform['hca_name'],
            'date' => $dataform['date'],
            'time' => $dataform['time'],
            'form_type' => $dataform['formtype'],
            'type' => $dataform['type'],
            'quality' => $dataform['quality'],
            'color' => $dataform['color'],
            'note' => $dataform['note'],
            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.resident', ['id' => $id])->with('success', 'Bowel Input recorded successfully');
    }

    public function form_fluid($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        return view('user.form_fluidintake', compact('residents', 'user'));
    }
    public function postform_fluid(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Forms([
            'hca_no' => $dataform['hca_no'],
            'hca_name' => $dataform['hca_name'],
            'date' => $dataform['date'],
            'time' => $dataform['time'],
            'form_type' => $dataform['formtype'],
            'type' => $dataform['type'],
            'quantity' => $dataform['qty_given'],
            'qty_taken' => $dataform['qty_taken'],
            'note' => $dataform['note'],
            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.resident', ['id' => $id])->with('success', 'Fluid Intake Input recorded successfully');
    }
    
    public function form_mbc($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        $hca_no = $residents->hca_no;
        $historys = Formmbc::where('resident_no', $hca_no)->latest()->get();

        return view('user.form_mbc', compact('residents', 'user', 'historys'));
    }

    public function post_mbc(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Formmbc([
            'resident_no' => $dataform['resident_no'],
            'hca_name' => $dataform['hca_name'],
            'date_log' => $dataform['date_log'],
            'time_log' => $dataform['time_log'],
            'mood' => $dataform['mood_details']

            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.mbc', ['id' => $id])->with('success', 'Medication logged successfully');
    }


    public function form_fc($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        $hca_no = $residents->hca_no;
        $historys = Formfc::where('resident_no', $hca_no)->latest()->get();

        return view('user.form_fc', compact('residents', 'user', 'historys'));
    }

    public function post_fc(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Formfc([
            'resident_no' => $dataform['resident_no'],
            'hca_name' => $dataform['hca_name'],
            'date_log' => $dataform['date_log'],
            'time_log' => $dataform['time_log'],
            'amount' => $dataform['amount'],
            'type' => $dataform['type'],
            'info' => $dataform['info']

            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.fc', ['id' => $id])->with('success', 'Fluid Chart logged successfully');
    }


    public function form_bc($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        $hca_no = $residents->hca_no;
        $historys = Formbc::where('resident_no', $hca_no)->latest()->get();

        return view('user.form_bc', compact('residents', 'user', 'historys'));
    }

    public function post_bc(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Formbc([
            'resident_no' => $dataform['resident_no'],
            'hca_name' => $dataform['hca_name'],
            'date_log' => $dataform['date_log'],
            'time_log' => $dataform['time_log'],
            'type' => $dataform['type'],
            'info' => $dataform['info']

            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.bc', ['id' => $id])->with('success', 'Medication logged successfully');
    }


    public function form_fic($id)
    {
        $id = $id;
        $user = session('user');
        //dd($id);
        $residents = Residents::findOrFail($id);
        $hca_no = $residents->hca_no;
        $historys = Formfic::where('resident_no', $hca_no)->latest()->get();

        return view('user.form_fic', compact('residents', 'user', 'historys'));
    }

    public function post_fic(Request $request)
    {
        $dataform = $request->all();
        $id = $dataform['id'];
        //dd($dataform);
        $form = new Formfic([
            'resident_no' => $dataform['resident_no'],
            'hca_name' => $dataform['hca_name'],
            'date_log' => $dataform['date_log'],
            'time_log' => $dataform['time_log'],
            'meal_portion' => $dataform['portion'],
            'meal_type' => $dataform['meal_type'],
            'info' => $dataform['info']

            // Add other attributes as needed
        ]);
        $form->save(); // Save the user to the database
        return redirect()->route('hca.fic', ['id' => $id])->with('success', 'Medication logged successfully');
    }

    public function login1(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $hcadata = Hca::where('email', $credentials['email'])->first();
        // Get the current time
        $currentTime = date('H:i');
        //Get the current date
        $currentDate = now()->format('Y-m-d');
        // Define shift timings
        $morningShiftStart = '08:00';
        $morningShiftEnd = '20:00';
        //dd($hcadata);
        if ($hcadata) {
            // Retrieve the user's fullname from HCA model
            $fullname = $hcadata->fullname;
           // dd($fullname);
            // Check each column individually and set $hca accordingly
            $hca1 = Schedule::where('hca1', $fullname)->first();
            if ($hca1) {
                $hca = $hca1->hca1;
                $shiftType = $hca1->shift_type;
                $shiftDate = $hca1->date;

                //dd($shiftDate); 
                // Check access based on shift and time
                if ($shiftType === 'Morning' && $currentDate === $shiftDate && $currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd) {
                    // Allow access for morning shift
                    //dd('Access Granted');
                    if (Auth::guard('hca')->attempt($credentials)) {
                        $user = Auth::guard('hca')->user();
                        //dd($user );
                        // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                        session(['user' => $user]);
                        session(['hca' => "hca1"]);
                        if ($user->isHca()) {
                            return redirect()->intended('/hca');
                        } else {
                            Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                            return redirect('/')->withErrors(['message' => 'Access denied.']);
                        }
                    }
                    
                } elseif ($shiftType === 'Evening' && $currentDate === $shiftDate && !($currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd)) {
                    // Allow access for morning shift
                    //dd('Access Granted');
                    if (Auth::guard('hca')->attempt($credentials)) {
                        $user = Auth::guard('hca')->user();
                        //dd($user );
                        // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                        session(['user' => $user]);
                        session(['hca' => "hca1"]);
                        if ($user->isHca()) {
                            return redirect()->intended('/hca');
                        } else {
                            Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                            return redirect('/')->withErrors(['message' => 'Access denied.']);
                        }
                    }
                }else{
                    return redirect('/')->withErrors(['message' => 'Access denied. You are not Schedule for this day and time.']);
                }
            } else{
                $hca2 = Schedule::where('hca2', $fullname)->first();
                if ($hca2) {
                    $hca = $hca2->hca2;
                    $shiftType = $hca2->shift_type;
                    $shiftDate = $hca2->date;

                   
                    // Check access based on shift and time
                    if ($shiftType === 'Morning'  && $currentDate === $shiftDate && $currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd) {
                        // Allow access for morning shift
                       //dd('Access Granted');
                        if (Auth::guard('hca')->attempt($credentials)) {
                            $user = Auth::guard('hca')->user();
                            //dd($user );
                            // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                            session(['user' => $user]);
                            session(['hca' => "hca2"]);
                            if ($user->isHca()) {
                                return redirect()->intended('/hca');
                            } else {
                                Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                                return redirect('/')->withErrors(['message' => 'Access denied.']);
                            }
                        }
                        
                    } elseif ($shiftType === 'Evening'  && $currentDate === $shiftDate && !($currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd)) {
                        // Allow access for morning shift
                       // dd('Access Granted');
                        if (Auth::guard('hca')->attempt($credentials)) {
                            $user = Auth::guard('hca')->user();
                            //dd($user );
                            // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                            session(['user' => $user]);
                            session(['hca' => "hca2"]);
                            if ($user->isHca()) {
                                return redirect()->intended('/hca');
                            } else {
                                Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                                return redirect('/')->withErrors(['message' => 'Access denied.']);
                            }
                        }
                    }else{
                        return redirect('/')->withErrors(['message' => 'Access denied. You are not Schedule for this day and time.']);
                    }
                }else{
                    $hca3 = Schedule::where('hca3', $fullname)->first();
                    if ($hca3) {
                        $hca = $hca3->hca3;
                        $shiftType = $hca3->shift_type;
                        $shiftDate = $hca3->date;
                        // Check access based on shift and time
                        if ($shiftType === 'Morning'  && $currentDate === $shiftDate && $currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd) {
                            // Allow access for morning shift
                            //dd('Access Granted');
                            if (Auth::guard('hca')->attempt($credentials)) {
                                $user = Auth::guard('hca')->user();
                                //dd($user );
                                // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                                session(['user' => $user]);
                                session(['hca' => "hca3"]);
                                if ($user->isHca()) {
                                    return redirect()->intended('/hca');
                                } else {
                                    Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                                    return redirect('/')->withErrors(['message' => 'Access denied.']);
                                }
                            }
                            
                        } elseif ($shiftType === 'Evening' && !($currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd)) {
                            // Allow access for morning shift
                            //dd('Access Granted');
                            if (Auth::guard('hca')->attempt($credentials)) {
                                $user = Auth::guard('hca')->user();
                                //dd($user );
                                // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                                session(['user' => $user]);
                                session(['hca' => "hca3"]);
                                if ($user->isHca()) {
                                    return redirect()->intended('/hca');
                                } else {
                                    Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                                    return redirect('/')->withErrors(['message' => 'Access denied.']);
                                }
                            }
                        }else{
                            return redirect('/')->withErrors(['message' => 'Access denied. You are not Schedule for this day and time.']);
                        }
                    }else{
                        $hca4 = Schedule::where('hca4', $fullname)->first();
                        if ($hca4) {
                            $hca = $hca4->hca4;
                            $shiftType = $hca4->shift_type;
                            $shiftDate = $hca4->date;
                            // Check access based on shift and time
                            if ($shiftType === 'Morning'  && $currentDate === $shiftDate && $currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd) {
                                // Allow access for morning shift
                                //dd('Access Granted');
                                if (Auth::guard('hca')->attempt($credentials)) {
                                    $user = Auth::guard('hca')->user();
                                    //dd($user );
                                    // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                                    session(['user' => $user]);
                                    session(['hca' => "hca4"]);
                                    if ($user->isHca()) {
                                        return redirect()->intended('/hca');
                                    } else {
                                        Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                                        return redirect('/')->withErrors(['message' => 'Access denied.']);
                                    }
                                }
                                
                            } elseif ($shiftType === 'Evening' && !($currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd)) {
                                // Allow access for morning shift
                                //dd('Access Granted');
                                if (Auth::guard('hca')->attempt($credentials)) {
                                    $user = Auth::guard('hca')->user();
                                    //dd($user );
                                    // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                                    session(['user' => $user]);
                                    session(['hca' => "hca4"]);
                                    if ($user->isHca()) {
                                        return redirect()->intended('/hca');
                                    } else {
                                        Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                                        return redirect('/')->withErrors(['message' => 'Access denied.']);
                                    }
                                }
                            }else{
                                return redirect('/')->withErrors(['message' => 'Access denied. You are not Schedule for this day and time.']);
                            }
                        }else{
                            $hca5 = Schedule::where('hca5', $fullname)->first();
                            if ($hca5) {
                                $hca = $hca5->hca5;
                                $shiftType = $hca5->shift_type;
                                $shiftDate = $hca5->date;
                                // Check access based on shift and time
                                if ($shiftType === 'Morning'  && $currentDate === $shiftDate && $currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd) {
                                    // Allow access for morning shift
                                   // dd('Access Granted');
                                    if (Auth::guard('hca')->attempt($credentials)) {
                                        $user = Auth::guard('hca')->user();
                                        //dd($user );
                                        // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                                        session(['user' => $user]);
                                        session(['hca' => "hca5"]);
                                        if ($user->isHca()) {
                                            return redirect()->intended('/hca');
                                        } else {
                                            Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                                            return redirect('/')->withErrors(['message' => 'Access denied.']);
                                        }
                                    }
                                    
                                } elseif ($shiftType === 'Evening'  && $currentDate === $shiftDate && !($currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd)) {
                                    // Allow access for morning shift
                                    //dd('Access Granted');
                                    if (Auth::guard('hca')->attempt($credentials)) {
                                        $user = Auth::guard('hca')->user();
                                        //dd($user );
                                        // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                                        session(['user' => $user]);
                                        session(['hca' => "hca5"]);
                                        if ($user->isHca()) {
                                            return redirect()->intended('/hca');
                                        } else {
                                            Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                                            return redirect('/')->withErrors(['message' => 'Access denied.']);
                                        }
                                    }
                                }else{
                                    return redirect('/')->withErrors(['message' => 'Access denied. You are not Schedule for this day and time.']);
                                }
                            }else{
                                $hca6 = Schedule::where('hca6', $fullname)->first();
                                if ($hca6) {
                                    $hca = $hca6->hca6;
                                    $shiftDate = $hca6->date;
                                                         
                                    $shiftType = $hca6->shift_type;
                                   //dd($shiftDate);   
                                   // Check access based on shift and time
                                    if ($shiftType === 'Morning'  && $currentDate === $shiftDate && $currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd) {
                                        // Allow access for morning shift
                                        //dd('Access Granted');
                                        if (Auth::guard('hca')->attempt($credentials)) {
                                            $user = Auth::guard('hca')->user();
                                            //dd($user );
                                            // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                                            session(['user' => $user]);
                                            session(['hca' => "hca6"]);
                                            if ($user->isHca()) {
                                                return redirect()->intended('/hca');
                                            } else {
                                                Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                                                return redirect('/')->withErrors(['message' => 'Access denied.']);
                                            }
                                        }
                                        
                                    } elseif ($shiftType === 'Evening'  && $currentDate === $shiftDate && !($currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd)) {
                                        // Allow access for morning shift
                                       // dd('Access Granted');
                                       if (Auth::guard('hca')->attempt($credentials)) {
                                            $user = Auth::guard('hca')->user();
                                            //dd($user );
                                            // Check if the authenticated user's role allows access (assuming role level <= 2 is admin)
                                            session(['user' => $user]);
                                            session(['hca' => "hca6"]);
                                            if ($user->isHca()) {
                                                return redirect()->intended('/hca');
                                            } else {
                                                Auth::guard('hca')->logout(); // Log out if user's role isn't allowed
                                                return redirect('/')->withErrors(['message' => 'Access denied.']);
                                            }
                                        }
                                    }else{
                                        return redirect('/')->withErrors(['message' => 'Access denied. You are not Schedule for this time.']);
                                    }
                                }else {
                                    //dd('No matching schedule found for ' . $fullname);
                                    return back()->withErrors(['message' => 'You have not been Schedule ' . $fullname]);
                                }
                            }
                        }
                    }
                }
            }
            // $hca now contains the matched schedule
            //dd($hca);
        }        
     
        
        return back()->withErrors(['message' => 'Invalid credentials']);

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $hcadata = Hca::where('email', $credentials['email'])->first();

        if (!$hcadata) {
            Log::warning("Login attempt failed: no HCA found for email {$credentials['email']}");
            return back()->withErrors(['message' => 'Invalid credentials']);
        }

        $fullname = $hcadata->fullname;
        $currentTime = date('H:i');
        $currentDate = now()->format('Y-m-d');
        $morningShiftStart = '08:00';
        $morningShiftEnd = '20:00';

        $scheduleFound = null;
        $assignedHcaColumn = null;

        Log::info("HCA login attempt: {$fullname} at {$currentDate} {$currentTime}");

        // Loop through all hca columns to find a matching schedule
        foreach (['hca1', 'hca2', 'hca3', 'hca4', 'hca5', 'hca6'] as $column) {
            $records = Schedule::where($column, $fullname)->get();

            foreach ($records as $record) {
                $shiftDate = $record->date;
                $shiftType = $record->shift_type;
                $isToday = ($shiftDate === $currentDate);
                $isMorningTime = $currentTime >= $morningShiftStart && $currentTime <= $morningShiftEnd;

                // Log each record check
                Log::info("Checking schedule for {$fullname} → Column: {$column}, Date: {$shiftDate}, Shift: {$shiftType}");

                if ($isToday) {
                    if (($shiftType === 'Morning' && $isMorningTime) ||
                        ($shiftType === 'Evening' && !$isMorningTime)) {

                        $scheduleFound = $record;
                        $assignedHcaColumn = $column;

                        Log::info("✅ Schedule matched for {$fullname}: {$shiftType} shift ({$assignedHcaColumn}) on {$shiftDate}");
                        break 2; // Break both loops
                    }
                }
            }
        }

        if (!$scheduleFound) {
            Log::warning("❌ Access denied for {$fullname}: no valid schedule found for {$currentDate} {$currentTime}");
            return back()->withErrors(['message' => 'Access denied. You are not scheduled for this day or time.']);
        }

        // Attempt login now that schedule is confirmed
        if (Auth::guard('hca')->attempt($credentials)) {
            $user = Auth::guard('hca')->user();
            session([
                'user' => $user,
                'hca' => $assignedHcaColumn,
                'schedule_matched' => [
                    'column' => $assignedHcaColumn,
                    'date' => $scheduleFound->date,
                    'shift' => $scheduleFound->shift_type,
                    'time' => $currentTime,
                ],
            ]);

            Log::info("✅ {$fullname} logged in successfully as {$assignedHcaColumn} (Shift: {$scheduleFound->shift_type}, Date: {$scheduleFound->date})");

            if ($user->isHca()) {
                return redirect()->intended('/hca');
            } else {
                Auth::guard('hca')->logout();
                Log::warning("⚠️ {$fullname} denied after auth — not an HCA role");
                return redirect('/')->withErrors(['message' => 'Access denied.']);
            }
        }

        Log::warning("❌ Invalid credentials for {$fullname}");
        return back()->withErrors(['message' => 'Invalid credentials']);
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
    
    public function postcreatehca(Request $request) {
        $dataform = $request->all();
        //dd($dataform);

        $user = new Hca([
            'username' => $dataform['username'],
            'fullname' => $dataform['fullname'],
            'email' => $dataform['email'],
            'password' => Hash::make($dataform['password']), // Hash the password
            // Add other attributes as needed
        ]);
    
        $user->save(); // Save the user to the database
    
        // Redirect or show a success message
        // For example:
        return redirect()->route('admin.hcaworkers')->with('success', 'New HCA account created successfully!');

    }

    public function forgotpassword(){
        return view('user.forgotpassword');
    }

   
    public function submitForgetPasswordForm(Request $request)
    {
       
        $request->validate([
            'email' => 'required|email|exists:hca_worker',
        ]);
       // dd('id');
        $token = Str::random(64);

            HCAPasswordModel::create([
                'email' => $request->email, 
                'token' => $token, 
            ]);
            $user = HCAPasswordModel::where('email',$request->email)->first();

            $email = new HCAEmailForgetPassword($user);
            Mail::to($user->email)->send($email);


        return back()->with('success', 'We have e-mailed your password reset link!');
    }   

    public function showResetPasswordForm($token) { 
        return view('user.passwordsreset', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request){
        $request->validate([
            'email' => 'required|email|exists:hca_worker',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required',
        ]);
        $updatePassword = DB::table('HCApassword_resets')
                            ->where([
                                'email' => $request->email,
                                'token' => $request->token
                            ])->first();
        if(!$updatePassword){
            return back()->with('error', 'Invalida token!');
        }

        $users = Hca::where('email', $request->email)
                    ->update([
                        'password' =>  Hash::make($request->password),
                    ]);
        
        DB::table('HCApassword_resets')->where([
            'email' => $request->email
        ])->delete();
        return redirect()->route('home')->with('success', 'Your password has been changed!');
    }

    // Admin logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function emailTest(){
        
        //dd("Test");
        //return view('signin');
        $fullname = "Oladokun Damilola";
        $email = "oladokundamiloladaniel@gmail.com";
        $token = Str::random(64);
        //dd($email);
        $sendMail = new SendMail($email, $fullname, $token);
        Mail::to($email)->send($sendMail);
        //return response()->json('message', 'Notification marked as read');
        //return view('/welcome');
        //dd("mail sent");
        dd("Notification marked as read");
        
        
    }

    public function setting()
    {
        $user = session('user');
        $user_id = $user->id;
        //dd($user_id);
        $user = Hca::where('id', $user_id)->pluck('profile_image')->first();
        $userP = Hca::where('id', $user_id)->first();

        return view('user.setting', compact('user', 'userP'));
    }

    public function updateProfile(Request $request)
    {
        try {
            // Get the user from session
            $userD = session('user');
            $user_id = $userD->id;

            // Validate the request
            $validator = Validator::make($request->all(), [
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'fullName' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 400);
            }

            // Fetch the user record
            $user = Hca::findOrFail($user_id);

            // Update profile information
            $user->fullname = $request->input('fullName');

            // Handle the file upload
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);

                // Update the user's profile image path in the database
                $user->profile_image = 'uploads/' . $imageName;
            }

            // Save changes to the user record
            $user->save();

            return response()->json(['message' => 'Profile updated successfully']);
        } catch (\Exception $e) {
            Log::error('Profile update failed:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function changePassword(Request $request)
    {
        $userD = session('user');
        $user_id = $userD->id;
        $request->validate([
            'password' => 'required',
            'newpassword' => 'required|string|min:8|different:password',
            'renewpassword' => 'required|same:newpassword',
        ]);

        $user = Hca::where('id', $user_id)->first();

        if (!Hash::check($request->password, $user->password)) {
            
            return response()->json(['error' => 'The current password is incorrect.'], 422);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return response()->json(['success' => 'Password has been changed successfully.']);
    }
}