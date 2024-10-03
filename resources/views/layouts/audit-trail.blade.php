<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Audit Trail</title>
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
  <h1><img src="{{ asset ('img/audit.png') }}" alt="img" width="40" height="40"> Audit Trail</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Audit Trail</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


    <section class="section dashboard">
      <div class="row">

    <div class="col-lg-12">

    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Users View Footprints</h5>

               <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Date & Time</th>
                    <th scope="col">User</th>
                    <th scope="col">View Filename</th>
                    <th scope="col">User Status</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($views as $view)
                    <tr>
                        <td scope="row">{{ \Carbon\Carbon::parse($view->viewed_at)->format('F j, Y') }}</td>
                        <td scope="row">{{$view->user->name}}</td>
                        <td scope="row"> <?php
                          $filename = pathinfo($view->filename, PATHINFO_FILENAME);
                          if (strlen($filename) > 44) {
                              $truncatedFilename = substr($filename, 0, 44) . '...';
                              echo htmlspecialchars($truncatedFilename);
                          } else {
                              echo htmlspecialchars($filename);
                          }
                          ?></td>
                        <td scope="row">
                        @if($view->user->status === 'Active')
                        <span class="badge bg-success">{{ $view->user->status }}</span>
                        @else
                        <span class="badge bg-danger">{{ $view->user->status }}</span>
                        @endif
                        </td>
                    </tr>
                @endforeach
          </tbody>
        </table>
         </div>
        {{ $views->links('vendor.pagination.default') }}
      </div>
    </div>
    </div>

    <div class="col-lg-12">
      <div class="card">
              <div class="card-body">
                <h5 class="card-title">Admin Actions</h5>
  
                 <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">Admin Name</th>
                      <th scope="col">Admin Role</th>
                      <th scope="col">Action</th>
                      <th scope="col">Research Filename</th>
                      <th scope="col">Action Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($logs) && count($logs) > 0)
                    @foreach ($logs as $log)
                        <tr>
                            <td scope="row">{{ $log->admin->name }}</td>
                            <td scope="row">
                              @if($log->admin->college)
                                  {{ $log->admin->college->college_name }}-
                              @endif
                              {{ $log->admin->role }}
                          </td>                          
                            <td scope="row">{{ $log->admin_action }}</td>
                            <td scope="row"> <?php
                          $filename = pathinfo($log->research, PATHINFO_FILENAME);
                          if (strlen($filename) > 44) {
                              $truncatedFilename = substr($filename, 0, 44) . '...';
                              echo htmlspecialchars($truncatedFilename);
                          } else {
                              echo htmlspecialchars($filename);
                          }
                          ?></td>
                            <td scope="row">{{ \Carbon\Carbon::parse($log->action_date)->format('F j, Y  H:i:s') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No logs available</td>
                    </tr>
                @endif
            </tbody>
          </table>
          </div>
        </div>
      </div>
      </div>


{{-- <div class="col-lg-12">
<div class="card">
        <div class="card-body">
          <h5 class="card-title">User Profile Footprints</h5>

          <!-- Table with hoverable rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">Date & Time</th>
                <th scope="col">User</th>
                <th scope="col">Action</th>
                <th scope="col">Changes</th>
                <th scope="col">User Status</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($auditrails as $auditrail)
                <tr>
                    <td scope="row">{{$auditrail->created_at}}</td>
                    <td scope="row">{{$auditrail->user->name}}</td>
                    <td scope="row">{{$auditrail->action}}</td>
                    <td scope="row">{{$auditrail->changes}}</td>
                    <td scope="row">
                      @if($auditrail->user->status === 'Active')
                      <span class="badge bg-success">{{ $auditrail->user->status }}</span>
                      @else
                      <span class="badge bg-danger">{{ $auditrail->user->status }}</span>
                      @endif
                        </td>
                </tr>
            @endforeach
      </tbody>
    </table>
    {{ $auditrails->links('vendor.pagination.default') }}
  </div>
</div>
</div> --}}
   
</div>
</section>

</main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>PSU Library</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
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