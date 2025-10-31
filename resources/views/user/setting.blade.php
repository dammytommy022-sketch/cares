@extends('user.layout.header')

@section('content')
  <style>
    .bg-light {
      background-color: #f0f0f0;
    }

    .app-btn-danger {
      background-color: #fb866a;
      color: #ffffff;
    }
  </style>

  <div class="app-content p-2 pt-5 p-md-3 p-lg-4">
    <div class="pagetitle">
      <h3>Account</h3>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="row">
      <div class="col-xl-5">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img src="{{ asset($user) }}" alt="Profile" class="rounded-circle" style="height: 200px; width: 200px;">
            <h5>{{$userP->fullname}}</h5>
            <h6>{{$userP->username}}</h6>
            <div class="col-12 text-start">
              <h6 class="card-title">Profile Details</h6>
              <div class="row mb-3">
                <div class="col-lg-4  label">Full Name</div>
                <div class="col-lg-8">{{$userP->fullname}}</div>
              </div>

              <div class="row mb-3">
                <div class="col-lg-4  label">Username</div>
                <div class="col-lg-8">{{$userP->username}}</div>
              </div>

              <div class="row mb-3">
                <div class="col-lg-4  label">Email</div>
                <div class="col-lg-8">{{$userP->email}}</div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-7">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
             
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                  Password</button>
              </li>
            </ul>
            <div class="tab-content pt-2">
 

              <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                <form id="profileForm" method="POST" action="{{ route('hca.profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="alertContainer" class="alert-container"></div>
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                        <div class="col-md-8 col-lg-9">
                            <img id="profileImg" src="{{ asset($user) }}" class="rounded-circle" style="height: 100px; width: 100px;" alt="Profile">
                            <div class="pt-2">
                                <label for="fileInput" class="btn btn-primary btn-sm" title="Upload new profile image">
                                    <i class="fa fa-upload text-white"></i>
                                    <input type="file" id="fileInput" name="profile_image" style="display:none;" accept="image/*">
                                </label>
                                <button type="button" class="btn btn-danger btn-sm" id="removeImage" title="Remove my profile image">
                                    <i class="fa fa-trash text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="text" class="form-control" id="fullName" name="fullName" value="{{ $userP->fullname }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Username</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="text" class="form-control" id="Job" name="username" value="{{ $userP->username }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="email" class="form-control" id="email" name="email" value="{{ $userP->email }}">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <div id="responseMessage"></div>
                <form id="changePasswordForm" action="{{ route('hca.password') }}" method="POST">
                  @csrf
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      <div id="passwordMatchMessage"></div>
                    </div>
                    
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->
              </div>

            </div><!-- End Bordered Tabs -->
          </div>
        </div>

      </div>
    </div>
  </div><!--//app-content-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#renewPassword').keyup(function() {
        var newPassword = $('#newPassword').val();
        var reenteredPassword = $(this).val();

        if (newPassword === reenteredPassword) {
          $('#passwordMatchMessage').html('Passwords match!').css('color', 'green');
        } else {
          $('#passwordMatchMessage').html('Passwords do not match!').css('color', 'red');
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
        $('#changePasswordForm').submit(function(e) {
            e.preventDefault(); // Prevent form submission

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // Handle successful response
                    $('#responseMessage').html('<div class="alert alert-success" role="alert">' + response.success + '</div>');
                    $('#changePasswordForm')[0].reset(); // Reset form fields
                     $('#passwordMatchMessage').hide(); 
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    var errorMessage = JSON.parse(xhr.responseText).error;
                    $('#responseMessage').html('<div class="alert alert-danger" role="alert">' + errorMessage + '</div>');
                }
            });
        });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('fileInput').addEventListener('change', function() {
            var file = this.files[0];
            var img = document.getElementById('profileImg');
            var reader = new FileReader();

            reader.onload = function(e) {
                img.src = e.target.result;
            };

            reader.readAsDataURL(file);
        });

        document.getElementById('removeImage').addEventListener('click', function() {
            var img = document.getElementById('profileImg');
            img.src = '{{ asset('assets/img/profile-img.jpg') }}'; // Set the default image source
            document.getElementById('fileInput').value = ''; // Clear the file input value
        });
    });

    document.getElementById('profileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text || response.statusText) });
            }
            return response.json();
        })
        .then(data => {
            var alertContainer = document.getElementById('alertContainer');
            if (data.message) {
                alertContainer.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else if (data.error) {
                alertContainer.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${data.error}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            var alertContainer = document.getElementById('alertContainer');
            alertContainer.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    There was a problem updating your profile: ${error.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        });
    });
  </script>

@endsection
