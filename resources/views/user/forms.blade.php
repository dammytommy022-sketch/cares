@extends('user.layout.header')
@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Forms</h1>
        <div class="row g-4">
            <div class="col-6 col-lg-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.fcl', ['id' => $residents->id])}}"></a>
                    </div>
                    <div class="app-card-body text-center p-2 has-card-actions">
                        <!-- <p>Family Care Log</p> -->
                        <small><b> Family Care Log</b></small>
                    </div><!--//app-card-body-->

                </div><!--//app-card--> 
            </div><!--//col-->
            <div class="col-6 col-lg-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.pcc', ['id' => $residents->id])}}"></a>
                    </div>
                    <div class="app-card-body text-center p-2 has-card-actions">
                        <!-- <p>Family Care Log</p> -->
                        <small><b> Personal Care Chart </b></small>
                    </div><!--//app-card-body-->

                </div><!--//app-card--> 
            </div><!--//col-->
            <div class="col-6 col-lg-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.mec', ['id' => $residents->id])}}"></a>
                    </div>
                    <div class="app-card-body text-center p-2 has-card-actions">
                        <!-- <p>Family Care Log</p> -->
                        <small><b> Medical Chart</b></small>
                    </div><!--//app-card-body-->

                </div><!--//app-card--> 
            </div><!--//col-->
            <div class="col-6 col-lg-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.siwc', ['id' => $residents->id])}}"></a>
                    </div>
                    <div class="app-card-body text-center p-2 has-card-actions">
                        <!-- <p>Family Care Log</p> -->
                        <small><b> Skin Integrity & Wound Chart</b></small>
                    </div><!--//app-card-body-->

                </div><!--//app-card--> 
            </div><!--//col-->
            <div class="col-6 col-lg-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.mbec', ['id' => $residents->id])}}"></a>
                    </div>
                    <div class="app-card-body text-center p-2 has-card-actions">
                        <!-- <p>Family Care Log</p> -->
                        <small><b> Mobility & Exercise Chart</b></small>
                    </div><!--//app-card-body-->

                </div><!--//app-card--> 
            </div><!--//col-->
            <div class="col-6 col-lg-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.resident1', ['id' => $residents->id])}}"></a>
                    </div>
                    <div class="app-card-body text-center p-2 has-card-actions">
                        <!-- <p>Family Care Log</p> -->
                        <small><b> Full Risk Assessment Chart</b></small>
                    </div><!--//app-card-body-->

                </div><!--//app-card--> 
            </div><!--//col-->
            <div class="col-6 col-lg-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.mbc', ['id' => $residents->id])}}"></a>
                    </div>
                    <div class="app-card-body text-center p-2 has-card-actions">
                        <!-- <p>Family Care Log</p> -->
                        <small><b> Mood & Behaviour Chart</b></small>
                    </div><!--//app-card-body-->

                </div><!--//app-card--> 
            </div><!--//col-->
            
            <div class="col-6 col-lg-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.fc', ['id' => $residents->id])}}"></a>

                    </div>
                    <div class="app-card-body text-center p-2 has-card-actions">
                        <!-- <p>Family Care Log</p> -->
                        <small><b> Fluids Chart</b></small>
                    </div><!--//app-card-body-->

                </div><!--//app-card--> 
            </div><!--//col-->
            <div class="col-6 col-lg-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.bc', ['id' => $residents->id])}}"></a>
                    </div>
                    <div class="app-card-body text-center p-2 has-card-actions">
                        <!-- <p>Family Care Log</p> -->
                        <small><b> Bowel chart</b></small>
                    </div><!--//app-card-body-->

                </div><!--//app-card--> 
            </div><!--//col-->
            <div class="col-6 col-lg-2">
                <div class="app-card app-card-doc shadow-sm h-100">
                    <div class="app-card-thumb-holder p-3">
                        <span class="icon-holder2"> 
                            <img src="{{asset('assets/images/user.png')}}" class="w-100" alt="user profile">
                        </span>
                            <a class="app-card-link-mask" href="{{route('hca.fic', ['id' => $residents->id])}}"></a>
                    </div>
                    <div class="app-card-body text-center p-2 has-card-actions">
                        <!-- <p>Family Care Log</p> -->
                        <small><b> Food intake chart</b></small>
                    </div><!--//app-card-body-->

                </div><!--//app-card--> 
            </div><!--//col-->
            
        </div><!--//row-->
    </div><!--//container-fluid-->
</div><!--//app-content-->
    
@endsection