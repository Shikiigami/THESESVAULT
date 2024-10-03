<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>List of Requests</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- Favicons -->
  <link href="{{ asset ('img/rchive.png') }}" rel="icon">
  <link href="{{ asset ('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
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
  <!-- ======= Header ======= -->
  @include('includes.header')
  
  <!-- ======= Sidebar ======= -->
  @include('includes.aside')

  <main id="main" class="main">
  <div class="pagetitle">
  <h1><img src="{{ asset ('img/rchive.png') }}" alt="img" width="40" height="40"> List of All Requests</h1>
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
      }, 5000); // Remove the alert after fading out
    });
  }, 2000); // Wait for 2 seconds before auto-fading
});

</script>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Requests</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
    <section class="section dashboard">
      <div class="row">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Requests Data<a href="{{route('requests.total')}}" class="btn btn-success btn-sm" style="margin-right: 50px; float:right;"><i class="bi bi-folder-symlink"></i> Total request</a></h5>
               <div class="table-responsive">
              <table class="table datatable table-hover">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Thesis Call No</th>
                    <th scope="col">Role</th>
                    <th scope="col">College</th>
                    <th scope="col">Prog./Dep.</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Receive Thru</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td scope="row">{{$request->user->name}}</td>
                        <td scope="row">{{$request->user->email}}</td>
                        <td scope="row">{{$request->research->callno}}</td>
                        @php
                        $userRole = ($request->user->role == 'user') ? 'Student' : (($request->user->role == 'faculty') ? 'faculty' : 'N/A');
                        @endphp
                        <td >{{$userRole}}</td>
                        @if (empty($request->user->college->college_name))
                        <td></td>
                        @else
                            <td>{{$request->user->college->college_name}}</td>
                        @endif
                        <td >{{$request->user->program}}</td>
                        <td >{{$request->purpose}}</td>
                        <td >{{$request->receive_thru}}</td>
                        <td style="vertical-align: middle!important;text-align: center;  ">
                        <div style="display: inline-flex; gap: 5px; justify-content: center;">
                        @if($request->req_status =='Pending')
                        <form action="{{ route('request.approved', ['id' => $request->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">
                                Approve
                            </button>
                        </form>        
                        <form action="{{ route('request.declined', ['id' => $request->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Decline
                            </button>
                        </form>    
                       @elseif ($request->req_status =='Approved')
                       <form action="{{ route('request.undo', ['id' => $request->id]) }}" method="POST">
                          @csrf
                          @method('PUT')
                        <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-success btn-sm" type="button"> Approved</button>
                      </div>
                    </form>
                      @else
                      <form action="{{ route('request.undo', ['id' => $request->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="d-grid gap-2 mt-3">
                      <button class="btn btn-danger btn-sm" type="submit"> Declined</button>
                    </div>
                      </form>
                      @endif
                </div>
          </td>
        </tr>
        @endforeach
          </tbody>
        </table>
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
  <script>
    $(document).ready(function() {
      // Initialize Select2
      $('#selectField').select2({
        placeholder: "Search for an option"
      });
    });
  </script>
  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


  <!-- Template Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>
  <!-- Your HTML -->
  <script>$(function () {
    $('[data-bs-toggle="popover"]').popover();
});
</script>

</body>

</html>