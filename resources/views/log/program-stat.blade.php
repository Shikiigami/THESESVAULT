<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Program Statistics</title>
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
  <h1><img src="{{ asset ('img/rchive.png') }}" alt="img" width="40" height="40">  Recent Program Logins</h1>
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
    
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"></a>
              </div>

              <div class="card-body">
                <h5 class="card-title"> Leading program <span> | Today</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-file-text-line"></i>
                  </div>
                  <div class="ps-2">
                    <h6><a type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#daysModal" href="" > Daily Report</a></h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="modal fade" id="daysModal" tabindex="-1" aria-labelledby="daysModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="daysModalLabel">Select Day</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('loginReportByDay.program') }}" method="GET" id="loginByDayForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <select name="day" id="dayInput" class="form-control">
                                        @for ($day = 1; $day <= 31; $day++)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>        
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"></a> 
              </div>

              <div class="card-body">
                <h5 class="card-title"> Leading program <span> | This Month</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-lightbulb-flash-line"></i>
                  </div>
                  <div class="ps-2">
                    <h6><a type="button" class="btn btn-success btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#monthsModal">Monthly Report</a></h6>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="modal fade" id="monthsModal" tabindex="-1" aria-labelledby="monthsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="monthsModalLabel">Select Month and Year</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('loginReport.program') }}" method="GET" id="loginByMonthForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="year" id="yearInput" class="form-control">
                                        @foreach($distinctYears as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="month" id="monthSelect" class="form-control">
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                            <option value="{{ $loop->index + 1 }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              </div>

              <div class="card-body">
                <h5 class="card-title"> Leading program <span> | This year</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-2">
                    <h6><a type="button" class="btn btn-success btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#yearsModal">Yearly Report</a></h6>
                  </div>
                </div>

              </div>
            </div>

          </div>
          <div class="modal fade" id="yearsModal" tabindex="-1" aria-labelledby="yearsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="yearsModalLabel">Select Year</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('loginReportByYear.program') }}" method="GET" id="loginByYearForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <select name="year" id="yearInput" class="form-control">
                                        @foreach($distinctYears as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>
    </section>
</main>
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>PalSU Library</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
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
  <script src="{{ asset('js/new.js') }}"></script>
  <!-- Your HTML -->
  <script>$(function () {
    $('[data-bs-toggle="popover"]').popover();
});
</script>

</body>

</html>