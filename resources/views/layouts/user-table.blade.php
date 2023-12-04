<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users List</title>
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
  @include('includes.header')
  
  <!-- ======= Sidebar ======= -->
  @include('includes.aside')

  <main id="main" class="main">
  <div class="pagetitle">
  <h1><img src="{{ asset ('img/users-data.png') }}" alt="img" width="40" height="40"> Users Data</h1>
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
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Users</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
          <h5 class="card-title">User Data List<button type="button" class="btn btn-danger btn-sm" style="margin-right: 50px; float:right;" data-bs-toggle="modal" data-bs-target="#deleteAllUsers">
            <i class="bi bi-trash"></i> Batch Delete
        </button>
          </h5>
        <div class="modal fade" id="deleteAllUsers" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered  modal-m">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-search"></i> Delete All User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 style="display: flex; align-items: center;">
                            <i class="bx bxs-trash" style="font-size: 35px; color:red;"></i>
                            <span class="text-danger" style="margin-left: 10px; font-size: 20px;">
                                Are you sure you want to delete all Inactive users?
                            </span>
                        </h6>
                    </div>
                    <div class="modal-footer">
                        <form id="deleteAllForm" method="POST" action="{{ route('batch.delete.users') }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
          <!-- Table with hoverable rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">Profile Picture</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Program</th>
                <th scope="col">College</th>
                <th scope="col">Verified Date</th>
                <th scope="col">Last login</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                 
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                <td scope="row">
                        @if ($user->profile_picture)
                            <img src="{{ asset('storage/pictures/' . $user->profile_picture) }}" alt="photo" width="50" height="50" style="border-radius: 50%">
                        @else
                            <img src="{{ asset('img/null-profile.png') }}" alt="Default Photo" width="50" height="50">
                        @endif
                    </td>
                    <td scope="row">{{$user->name}}</td>
                    <td scope="row">{{$user->email}}</td>
                    <td scope="row">{{$user->program}}</td>
                    <td scope="row">{{ $user->college->college_name ?? 'None' }}</td>
                    <td scope="row">{{$user->email_verified_at}}</td>
                    <td scope="row">
                      <span class="badge {{ $user->last_login < $sixMonthsAgo ? 'border-danger border-1 text-danger' : 'border-success border-1 text-success' }}">
                          {{ $user->last_login }}
                      </span>
                  </td>
                    </td>               
                    <td scope="row">
                    @if($user->status === 'Active')
                    <span class="badge bg-success">{{ $user->status }}</span>
                    @else
                    <span class="badge bg-danger">{{ $user->status }}</span>
                    @endif
                    </td>
                    @if($user->last_login < $sixMonthsAgo || is_null($user->email_verified_at) && $user->created_at < $oneDayAgo)
                    <td scope="row">
                      <form action="{{ route('delete.user', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$user->id}}"><i class="bi bi-trash"></i></button>
                          <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1">
                              <div class="modal-dialog modal-dialog-centered  modal-m">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">{{$user->name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  <h6 style="display: flex; align-items: center;">
                              <i class="bx bxs-trash" style="font-size: 35px; color:red;"></i>
                              <span class="text-danger" style="margin-left: 10px; font-size: 20px;">
                                 Are you sure you want to delete <span class="text-primary">{{ $user->name }}</span> as user?
                              </span>
                              </h6>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                              <button type="submit" class="btn btn-danger btn-sm"><span>Delete</span></button>
                                </div>
                                </div>
                              </div>h
                            </div>
                        </div>
                    </form>
                    </td>
                    @else
                    <td></td>
                    @endif
                </tr>
            @endforeach
      </tbody>
    </table>
    {{ $users->links('vendor.pagination.default') }}
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
  <!-- Your HTML -->
</body>

</html>