<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- Favicons -->
  <link href="{{ asset ('img/rchive.png') }}" rel="icon">
  <link href="{{ asset ('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset ('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset ('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/new.css') }}"  rel="stylesheet">

</head>
<body>

  {{-- preloader --}}

  <div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<script>
  // Get the preloader element
const preloader = document.getElementById('preloader');

function hidePreloader() {
  preloader.style.display = 'none';
}

setTimeout(hidePreloader, 1000); 

</script>
{{-- end of preloader --}}

<!-- ======= Header ======= -->
@include('includes.user-header')
  
<!-- ======= Sidebar ======= -->
@include('includes.user-aside')
  <main id="main" class="main">
  <div class="fixed-top-alert">
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show falling-alert" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show falling-alert" role="alert">
      <i class="bi bi-exclamation-octagon me-1"></i>
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
    var alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alert) {
      alert.classList.add('fade-out-up'); // Apply the fade-out-up animation class

      setTimeout(function () {
        alert.remove();
      }, 1000); // Remove the alert after fading out
    });
  }, 2000); // Wait for 2 seconds before auto-fading
});

</script>
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ Auth::user()->profile_picture ? asset('storage/pictures/' . Auth::user()->profile_picture) : asset('img/null-profile.png') }}" alt="Profile Picture" class="rounded-circle">
              <h2>{{ Auth::user()->name }}</h2>
              <h3>{{ Auth::user()->email }}</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

              <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">College</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->college->college_name ?? 'No College' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Program</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->program }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Interest</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->interest }}</div>
                  </div>
                </div>

  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

   <!-- Profile Edit Form -->
   <form method="POST" action="{{ route('user-update.profile') }}" enctype="multipart/form-data">
   @csrf
   @method('PUT')
    <div class="row mb-3">
        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
        <div class="col-md-8 col-lg-9">
        <img id="profilePicturePreview" src="{{ Auth::user()->profile_picture ? asset('storage/pictures/' . Auth::user()->profile_picture) : asset('img/null-profile.png') }}" alt="Profile Picture">

          <input type="file" name="profile_picture" id="profile_picture" style="display: none;" onchange="displaySelectedImage(this)">
<script>
function displaySelectedImage(input) {
    var preview = document.getElementById('profilePicturePreview');
    var errorMessage = document.getElementById('profilePictureError');
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            errorMessage.style.display = 'none'; // Hide error message
        };

        var validExtensions = ['jpg', 'jpeg', 'png'];
        var fileExtension = input.files[0].name.split('.').pop().toLowerCase();
        
        if (validExtensions.indexOf(fileExtension) === -1) {
            preview.src = "{{ asset('img/null-profile.png') }}";
            errorMessage.style.display = 'block';
        } else {
            reader.readAsDataURL(input.files[0]);
        }
    } else {
        preview.src = "{{ asset('img/null-profile.png') }}";
    }
}
</script>
            <div class="pt-2">
                <a href="#" class="btn btn-primary btn-sm col-md-3" title="Upload new profile image" onclick="document.getElementById('profile_picture').click();"><i class="ri-image-add-fill"></i></a>
            </div> 
        </div>
    </div>

    <div class="row mb-3">
        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
        <div class="col-md-8 col-lg-9">
            <input name="name" type="text" class="form-control" id="name" value="{{ Auth::user()->name }}">
        </div>
    </div>
    <div class="row mb-3">
    <label for="college" class="col-md-4 col-lg-3 col-form-label">College</label>
    <div class="col-md-8 col-lg-9">
        <select class="form-control" name="college_id" id="collegeSelect">
            @if (Auth::user()->college)
                <option value="{{ Auth::user()->college->id }}" selected>{{ Auth::user()->college->college_name }}</option>
            @else
                <option value="" selected>No College</option>
            @endif
        </select>
    </div>
</div>

<div class="row mb-3">
        <label for="program" class="col-md-4 col-lg-3 col-form-label">Interest</label>
        <div class="col-md-8 col-lg-9">
        <select class="form-control" name="interest" value="{{ Auth::user()->interest }}"  >
                    <option value="{{ Auth::user()->interest }}">{{ Auth::user()->interest }}</option>
                    <option value="Business">Business</option>
                    <option value="Technology">Technology</option>
                    <option value="Education">Education</option>
                  </select>
        </div>
    </div>
<script>
    $(document).ready(function () {
        // Make an AJAX request to fetch colleges
        $.ajax({
            url: "{{ route('user-edit.profile') }}",
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Populate the select element with fetched data
                var select = $('#collegeSelect');
                $.each(data, function (key, value) {
                    select.append('<option value="' + value.id + '">' + value.college_name + '</option>');
                });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error('Error fetching colleges: ' + errorThrown);
            }
        });
    });
</script>
<div class="row mb-3" id="programSelection">
  <!-- Program selection -->
  <label for="program" class="col-md-4 col-lg-3 col-form-label">Program</label>
  <div class="col-md-8 col-lg-9">
      <select class="form-control" name="program" id="program">
          <!-- Options will be populated dynamically based on the selected college -->
      </select>
  </div>
</div>

<script>
  $('#collegeSelect').change(function() {
      var selectedCollege = $(this).val();
      var programSelect = $('#program');

      programSelect.empty();

      if (selectedCollege === '131') {
          addProgramOptions(programSelect, [
              "BS Information Technology",
              "BS Computer Science",
              "BS Medical Biology",
              "BS Environmental Science",
              "BS Marine Biology"
          ]);
      } else if (selectedCollege === '130') {
          addProgramOptions(programSelect, [
              "BS Civil Engineering",
              "BS Mechanical Engineering",
              "BS Petroleum Engineering",
              "BS Electrical Engineering",
              "BS Architecture"
          ]);
      }
  });

  function addProgramOptions(selectElement, programs) {
      programs.forEach(function(program) {
          selectElement.append($('<option>', {
              value: program,
              text: program
          }));
      });
  }
</script>

    <div class="text-center">
        <button type="submit" id="submit" name="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>
</div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST" action="{{route('user.password')}}">
                      @csrf
                      @method('PUT')
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>PSU Library</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="http://psulibrary.palawan.edu.ph/home/">Palawan State University</a>
    </div>
  </footer><!-- End Footer -->
  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  

  <!-- Template Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>