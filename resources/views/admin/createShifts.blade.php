@extends('admin.layout.header')
@section('content')
    <div class="row">
        <div class="app-content pt-5 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="app-card app-card-basic bg-light">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <i class="fas fa-briefcase" style="font-size: 2em;"></i>
                                </div><!--//icon-holder-->
                                
                            </div><!--//col-->
                            <div class="col-auto">
                                <h4 class="app-card-title">Shift's Schedule Board</h4>
                            </div><!--//col-->
                                
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body  px-4">
                        <div>
                            <div class="tab-pane fade show active" id="all-shift" role="tabpanel" aria-labelledby="all-shift-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                        <div class="col-md-12 ">
                                            <div class="card card-plain"> 
                                                <div class="card-header">
                                                <h6 class="section-title">Create Shedule</h6>
                                                <small class="mb-5">Create New Shift Schedule</small>
                                                @if (session('error'))
                                                    <div class="alert alert-warning text-white">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                                @if ($errors->any())
                                                    <div class="alert alert-danger text-white">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if (isset($morningRegistrants) && $morningRegistrants->isNotEmpty())
                                                    <div class="alert alert-warning">
                                                        <p>Some individuals have already registered for the morning shift on this date:</p>
                                                        {{-- <ul>
                                                            @foreach ($morningRegistrants as $registrant)
                                                                <li>{{ $registrant->hca1 }}, {{ $registrant->hca2 }}, {{ $registrant->hca3 }}, {{ $registrant->hca4 }}, {{ $registrant->hca5 }}, {{ $registrant->hca6 }}</li>
                                                            @endforeach
                                                        </ul> --}}
                                                    </div>
                                                @endif

                                                <div class="card-body bg-white">
                                                    @error('worker_type' || 'staff_type_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <form role="form" class="settings-form" action="{{ route('admin.postcreateShift') }}" method="POST">
                                                        @csrf
                                                        {{-- First stage --}}
                                                        <div class="row">
                                                            <input type="hidden" name="staff_type_name" id="staff_type_name" class="form-control" value="HCA" />
                                                            <div class="col-lg-3">
                                                                <label for="shift_session" class="form-label">Shift Type</label>
                                                                <div class=" mb-3">
                                                                    <select name="shift_type" id="shift_session" class="form-select ml-3" required>
                                                                        <option value="" selected disabled >Shift Type:</option>
                                                                        <option value="Morning">Morning</option>
                                                                        <option value="Evening">Evening</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label for="shift_session" class="form-label"> Date</label>
                                                                <div class="input-group-outline mb-3">
                                                                    <input type="date" name="date" id="floor" class="form-control" required/>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                // Get a reference to the input element
                                                                const dateInput = document.getElementById("floor");
                                                            
                                                                // Get the current date
                                                                const today = new Date();
                                                                
                                                                // Convert the current date to the format "YYYY-MM-DD" for comparison
                                                                const formattedToday = today.toISOString().slice(0, 10);
                                                            
                                                                // Set the minimum attribute of the date input to today
                                                                dateInput.setAttribute("min", formattedToday);
                                                            </script>
                                                        
                                                        </div>
                                                        <br>
                                                        {{-- second form --}}
                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <label for="shift_session" class="form-label"><b>Floor 1</b></label>
                                                                <div class="input-group-outline mb-3">
                                                                    <input type="hidden" name="floor1" id="floor" class="form-control" value="floor1" readonly/>
                                                                    
                                                                </div>
                                                            </div>
                                                            @error('floor')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            <div class="col border">

                                                                <div class="col" id="hca_select_container" >
                                                                    <label for="hca_select" class="form-label"><b>Select HCA</b></label>
                                                                    <div class="input-group-outline mb-3">
                                                                        <select name="hca1" id="hca_select" class="form-control" required>
                                                                            <option selected disabled value="">Select HCA</option>
                                                                            @foreach ($hcas as $hca)
                                                                                <option value="{{ $hca->fullname }}" >{{ $hca->fullname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error('hca1')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            
                                                            </div>
                                                            <div class="col border">
                                                                <div class="col" id="hca_select_container" >
                                                                    <label for="hca_select" class="form-label"><b>Select HCA</b></label>
                                                                    <div class="input-group-outline mb-3">
                                                                        <select name="hca2" id="hca_select" class="form-control" required>
                                                                            <option selected disabled value="">Select HCA</option>
                                                                            @foreach ($hcas as $hca)
                                                                                <option value="{{ $hca->fullname }}" >{{ $hca->fullname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error('hca2')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col  " id="hca_select_container" >
                                                                <label for="hca_select" class="form-label"><b>Select Nurse</b></label>
                                                                <div class="input-group-outline mb-3">
                                                                    <select name="nurse1" id="hca_select" class="form-control" required>
                                                                    <option selected disabled value="">Select Nurse</option>
                                                                    @foreach ($nurses as $nurse)
                                                                        <option value="{{ $nurse->fullname }}" style="color:black">{{ $nurse->fullname }}</option>
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('nurse1')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                                <input type="hidden" name="nursefloor1" id="floor" class="form-control" value="nursefloor1"  />
                                                            </div>
                                                        
                                                            
                                                            <br>
                                                        </div>
                                                        <br>
                                                        <div style="background-color: black; width:100%; height:1px"></div>
                                                        <br>
                                                        {{-- second stage --}}
                                                        
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <label for="shift_session" class="form-label"><b> Floor 2</b></label>
                                                                <div class="input-group-outline mb-3">
                                                                    <input type="hidden" name="floor2" id="floor" class="form-control" value="floor2" placeholder="Floor 2" readonly/>
                                                                    
                                                                </div>
                                                            </div>
                                                            @error('floor')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            <div class="col border">
                                                                <div class="col" id="hca_select_container" >
                                                                    <label for="hca_select" class="form-label"><b>Select HCA</b></label>
                                                                    <div class="input-group-outline mb-3">
                                                                        <select name="hca3" id="hca_select" class="form-control" required>
                                                                            <option selected disabled value="">Select HCA</option>
                                                                            @foreach ($hcas as $hca)
                                                                                <option value="{{ $hca->fullname }}" >{{ $hca->fullname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error('hca1')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            
                                                            </div>
                                                            <div class="col border">
                                                                <div class="col" id="hca_select_container" >
                                                                    <label for="hca_select" class="form-label"><b>Select HCA</b></label>
                                                                    <div class="input-group-outline mb-3">
                                                                        <select name="hca4" id="hca_select" class="form-control" required>
                                                                            <option selected disabled value="">Select HCA</option>
                                                                            @foreach ($hcas as $hca)
                                                                                <option value="{{ $hca->fullname }}" >{{ $hca->fullname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error('hca2')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col ">
                                                                <div class="col" id="hca_select_container" >
                                                                    <label for="hca_select" class="form-label"><b>Select Nurse</b></label>
                                                                    <div class="input-group-outline mb-3">
                                                                        <select name="nurse2" id="hca_select" class="form-control" required>
                                                                            <option selected disabled value="">Select Nurse</option>
                                                                            @foreach ($nurses as $nurse)
                                                                                <option value="{{ $nurse->fullname }}" style="color:black">{{ $nurse->fullname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error('nurse2')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                                <input type="hidden" name="nursefloor2" id="floor" class="form-control" value="nursefloor2"  />
                                                            </div>
                                                            <br>
                                                        </div>
                                                        {{-- second stage --}}
                                                        
                                                        <br>
                                                        <div style="background-color: black; width:100%; height:1px"></div>
                                                        <br>
                                                        {{-- third form --}}
                                                        
                                                        <br>
                                                        <div class="row">
                                                            <input type="hidden" name="staff_type_name" id="staff_type_name" class="form-control" value="HCA" />
                                                        
                                                            <div class="col-lg-2">
                                                                <label for="shift_session" class="form-label"><b> Floor 3</b></label>
                                                                <div class="input-group-outline mb-3">
                                                                    <input type="hidden" name="floor3" id="floor" class="form-control" value="floor3" placeholder="Floor 3" readonly/>
                                                                    
                                                                </div>
                                                            </div>
                                                            @error('floor')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            <div class="col border">
                                                                <div class="col" id="hca_select_container" >
                                                                    <label for="hca_select" class="form-label"><b>Select HCA</b></label>
                                                                    <div class="input-group-outline mb-3">
                                                                        <select name="hca5" id="hca_select" class="form-control" required>
                                                                            <option selected disabled value="">Select HCA</option>
                                                                            @foreach ($hcas as $hca)
                                                                                <option value="{{ $hca->fullname }}" >{{ $hca->fullname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error('hca4')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            
                                                            </div>
                                                            <div class="col border">
                                                                <div class="col" id="hca_select_container" >
                                                                    <label for="hca_select" class="form-label"><b>Select HCA</b></label>
                                                                    <div class="input-group-outline mb-3">
                                                                        <select name="hca6" id="hca_select" class="form-control" required>
                                                                            <option selected disabled value="">Select HCA</option>
                                                                            @foreach ($hcas as $hca)
                                                                                <option value="{{ $hca->fullname }}" >{{ $hca->fullname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error('hca6')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col ">
                                                                <div class="col" id="hca_select_container" >
                                                                    <label for="hca_select" class="form-label"><b>Select Nurse</b></label>
                                                                    <div class="input-group-outline mb-3">
                                                                        <select name="nurse3" id="hca_select" class="form-control" required>
                                                                            <option selected disabled value="">Select Nurse</option>
                                                                            @foreach ($nurses as $nurse)
                                                                                <option value="{{ $nurse->fullname }}" style="color:black">{{ $nurse->fullname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                <input type="hidden" name="nursefloor3" id="floor" class="form-control" value="nursefloor3"  />

                                                                </div>
                                                                @error('hca5')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            
                                                            <br>
                                                        </div>
                                                        
                                                        <br>

                                                        <div style="background-color: black; width:100%; height:1px"></div>
                                                        
                                                        {{-- Four form --}}
                                                        

                                                        <div class="align-center col-4">
                                                            <div class="text-center">
                                                                <button type="submit" class="btn bg-primary text-white  w-50 mt-4 mb-0">Add Schedule</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div><!--//app-card-body-->		
                                </div><!--//app-card-->
                            </div><!--//tab-pane-->   
                        </div><!--//tab-content-->
                    </div><!--//app-card-body-->
                       
                </div>
            </div>
        </div>
    </div>
         
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#staff_type').change(function () {
                var selectedOption = $(this).val();
                var nurseSelectContainer = $('#nurse_select_container');
                var hcaSelectContainer = $('#hca_select_container');
                var nurseSelect = $('#nurse_select');
                var hcaSelect = $('#hca_select');

                if (selectedOption === 'HCA') {
                    nurseSelectContainer.hide();
                    hcaSelectContainer.show();
                    nurseSelect.val('').trigger('change'); // Clear and reset the nurse select field
                } else if (selectedOption === 'Nurse') {
                    hcaSelectContainer.hide();
                    nurseSelectContainer.show();
                    hcaSelect.val('').trigger('change'); // Clear and reset the HCA select field
                } else {
                    nurseSelectContainer.hide();
                    hcaSelectContainer.hide();
                    nurseSelect.val('').trigger('change'); // Clear and reset the nurse select field
                    hcaSelect.val('').trigger('change');   // Clear and reset the HCA select field
                }
            });
        });
    </script>
@endsection 