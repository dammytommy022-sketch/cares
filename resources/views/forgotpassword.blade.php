

<!DOCTYPE html>
<html lang="en">
    
<!-- Developed by Haytech Services, Sun, 01 Oct 2023 20:58:39 GMT -->

<!-- Mirrored from cgalor.com/app/user/reset_password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 11:49:31 GMT -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="milZFZ3P9MBAuWPy6uw1zgvioRkMicQXvq6Lwhac">
    <title>CryptoGalor | Forgot Password</title>
    <link rel="icon" href="{{ asset('assets/img/mini_logo.png')}}" type="image/png">
    <link href="{{ asset('assets/temp/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/temp/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/temp/css/line.css')}}">
    <script src="../../www.google.com/recaptcha/api.html" async defer></script>
    <!-- Main Css -->
    <link href="{{ asset('assets/temp/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/temp/css/colors/default.css')}}" rel="stylesheet">
        
    </head>
    <body class="h-100 bg-soft-primary">
       <section class=" auth">
        <div class="container">
            <div class="pb-3 row justify-content-center">

                <div class="col-12 col-md-6 col-lg-6 col-sm-10 col-xl-6">
                    <div class="text-center">
                       <a href=""><img src="../../trade/Q8QFTbXUJrELyhf1YI5ezaE8RCwVzEhBUpYUVhBx.html" alt="" class="mb-3 img-fluid auth__logo"></a> 
                    </div>
                    <div class="bg-white shadow card login-page roundedd border-1 ">
                        <div class="card-body">
                            <h4 class="text-center card-title">Reset Password</h4>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="{{route('postforgotPassword')}}" class=""  method="post" accept-charset="utf-8">
                               @csrf  
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Your Email <span class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                                <input class="pl-5 form-control" type="email" name="email" placeholder="your e-mail here" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="mb-0 col-lg-12">
                                         <button class="btn btn-primary btn-block pad" type="submit" name="btn-fpassword">Reset Password</button>
                                    </div>

                                    <div class="text-center col-12">
                                        <p class="mt-3 mb-0">
                                            <small class="mr-2 text-dark">Remember Password?
                                            </small> <a href="{{route('signin')}}" class="text-dark font-weight-bold">Login</a>
                                        </p>
                                    </div>
                                    <!--end col-->
                                    
                                    <div class="text-center col-12">
                                        <p class="mt-4 mb-0"><small class="mr-2 text-dark">&copy; Copyright  2022 &nbsp; CryptoGalor &nbsp; All Rights Reserved.</small>
                                        </p>
                                    </div>
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div>
                    <!---->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    


    <script src="{{ asset('assets/temp/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('assets/temp/js/bootstrap.bundle.min.js')}}"></script>
    
    <!-- Icons -->
    <script src="{{ asset('assets/temp/js/feather.min.js')}}"></script>
    <script src="{{ asset('assets/temp/js/app.js')}}"></script>
       
    </body>

<!-- Developed by Haytech Services, Sun, 01 Oct 2023 20:58:39 GMT -->

<!-- Mirrored from cgalor.com/app/user/reset_password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 11:49:31 GMT -->
</html>



                    
    <!--end section-->

            

 