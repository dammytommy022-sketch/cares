<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assetsU/assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Travel Wheel | Email Verification </title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assetsU/assets/img/favicon/twicon.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assetsU/assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assetsU/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assetsU/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assetsU/assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assetsU/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="../assetsU/assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="../assetsU/assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assetsU/assets/js/config.js"></script>
</head>

<body>
  <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">

                            <img src="../assetsU/assets/img/favicon/twlogo.png" width="200px" alt="">
                            </span>
                        </a>
                        </div>
                        <!-- /Logo -->
                        <h5 class="mb-2">Welcome to TravelWheel! 👋</h5>
                        <p class="mb-4">Please verify your Email Address to access your account!</p>

                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                        <div class="row pt-5">
                            <div class="col-6">
                                <a href="{{ route('login') }}">
                                    <button class="btn btn-primary d-grid w-100" type="submit">Go Back</button>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('register') }}">
                                    <button class="btn btn-primary d-grid w-100" type="submit">Sign-Up</button>
                                </a>
                            </div>
                        
                        </div>
                    </div>
                </div>
                <!-- /Register -->
                
            </div>
        </div>
        <div>
            <footer class="">
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About Us</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Products</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Terms and Conditions</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Help</a></li>
                </ul>
                <p class="text-center text-muted">© 2023 TravelWheel</p>
            </footer>
        </div>
       
    </div>

  <!-- / Content -->

  

  <!-- Core JS -->
  <!-- build:js ../assetsU/assets/vendor/js/core.js -->
  <script src="../assetsU/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assetsU/assets/vendor/libs/popper/popper.js"></script>
  <script src="../assetsU/assets/vendor/js/bootstrap.js"></script>
  <script src="../assetsU/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../assetsU/assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="../assetsU/assets/js/main.js"></script>

  <!-- Page JS -->

</body>

</html>
