@extends('user.layout.header')
@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Medication Chart</h1>
        <div class="row g-4">
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <i class="fa fa-file "></i>
                                </div><!--//icon-holder-->
                                
                            </div><!--//col-->
                            <div class="col-auto">
                                <h4 class="app-card-title">+Add New Medication Log</h4>
                                <small class="mb-0">Log Medication details</small>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body px-4 w-100">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="item  py-3">
                            <form role="form" action="{{ route('hca.postmec') }}" method="POST">
                                @csrf

                                <input type="hidden" name="resident_no" class="form-control" value="{{ $residents->hca_no}}">
                                <input type="hidden" name="id" class="form-control" value="{{ $residents->id}}">
                                <input type="hidden" name="hca_name" class="form-control" value="{{ $user->fullname}}">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Medication Name</label>
                                        <input type="text" name="med_name" class="form-control">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="setting-input-6" class="form-label">Medication Dosage</label>
                                        <select name="dosage" id="setting-input-6" class="form-control">
                                            <option>-- select dosage --</option>
                                            <option value="1"> 1</option>
                                            <option value="2"> 2</option>
                                            <option value="3"> 3 </option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Administration Date</label>
                                        <input type="date" id="date_log" name="date_log" class="form-control" readonly>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Administration Time</label>
                                        <input type="time" name="time_log" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Special Instruction</label>
                                        <textarea class="form-control" name="instruction" placeholder="Specify instuction" id="" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-primary  w-100 mt-4 mb-0">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><!--//item-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//col-->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <i class="fa fa-file "></i>
                                </div><!--//icon-holder-->
                                
                            </div><!--//col-->
                            <div class="col-auto">
                                <h4 class="app-card-title">Medication History</h4>
                                <small class="mb-0">Logs of Medication</small>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body px-4 w-100">
                        <div class="app-card app-card-accordion shadow-sm mb-4">
                            <div class="app-card-body p-4 pt-0">
                                <div id="faq1-accordion" class="faq1-accordion faq-accordion accordion">
                                    @if ($historys->isEmpty())
                                        <p>No Personal Care history. </p>
                                    @else 
                                    @php $serial = 1 @endphp
                                    @foreach($historys as $history)
                                    <div class="accordion-item">
                                        @php $list = $serial++; @endphp
                                        <h2 class="accordion-header" id="faq1-heading-{{ $list }}">
                                        <button class="accordion-button btn btn-link" type="button" data-bs-toggle="collapse"  data-bs-target="#faq1-{{ $list }}" aria-expanded="false" aria-controls="faq1-{{ $list }}">
                                            {{ $history->medication }}- <small><i> ({{$history->time_log}})</i></small>
                                        </button>
                                        </h2>
                                        <div id="faq1-{{ $list }}" class="accordion-collapse collapse border-0" aria-labelledby="faq1-heading-{{ $list }}">
                                            <div class="accordion-body text-start p4">
                                               
                                                <p> {{ $history->instruction }}</p>
                                               <div class="text-end">
                                                    <small>By - {{ $history->hca_name }}</small><br>
                                                    <small><i>{{ $history->date_log }}</i></small>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div><!--//accordion-item-->  
                                    
                                    @endforeach 
                                    @endif 
                                </div><!--//faq1-accordion-->
                                
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//app-card-body-->
                   
                    
                </div><!--//app-card-->
            </div><!--//col-->
            
        </div><!--//row-->
    </div><!--//container-fluid-->
</div><!--//app-content-->
<script>
    // Set the current date to the input field and disable it
    document.getElementById('date_log').valueAsDate = new Date();
  </script>
@endsection