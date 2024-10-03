<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Recent Login</title>
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
  <h1><img src="{{ asset ('img/rchive.png') }}" alt="img" width="40" height="40"> Recent Login</h1>
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
            <div class="card info-card customers-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"></a>
              </div>

              <div class="card-body">
                <h5 class="card-title">Daily Logs <span>Today</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-check"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $userToday ?? '0' }}</h6>
                    <span class="text-success small pt-1 fw-bold">Increase %</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->
          <!-- Revenue Card -->
    <!-- Recent Login By Month Card -->
          <!-- Recent Login By Month Card -->
<div class="col-xxl-4 col-md-6">
    <div class="card info-card customers-card">
        <div class="card-body">
            <h5 class="card-title">Monthly Logs <span>|
                @switch($month)
                    @case(1)
                        January
                        @break
                    @case(2)
                        February
                        @break
                    @case(3)
                        March
                        @break
                    @case(4)
                        April
                        @break
                    @case(5)
                        May
                        @break
                    @case(6)
                        June
                        @break
                    @case(7)
                        July
                        @break
                    @case(8)
                        August
                        @break
                    @case(9)
                        September
                        @break
                    @case(10)
                        October
                        @break
                    @case(11)
                        November
                        @break
                    @case(12)
                        December
                        @break
                    @default
                        Unknown
                @endswitch
            </span> {{$year}}</h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bx bx-line-chart"></i>
                </div>
                <div class="ps-3">
                    <h6>{{ $loginCounts ?? '0' }}</h6>
                    <span class="text-success small pt-1 fw-bold">Increase: %</span> <span class="text-muted small pt-2 ps-1">increase</span>
                </div>
            </div>
        </div>
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="modal" data-bs-target="#monthsModal"><i class="bx bx-dots-vertical-rounded"></i></a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="monthsModal" tabindex="-1" aria-labelledby="monthsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="monthsModalLabel">Select Month</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('login.by_month') }}" method="POST" id="loginByMonthForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <select name="year" id="yearInput" class="form-control">
                                @foreach($years as $year)
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

<div class="col-xxl-4 col-md-6">
    <div class="card info-card customers-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
            <ul class="dropdown-menu">
                @foreach ($years as $year)
                    <li>
                        <form method="post" action="{{ route('select-year') }}" onsubmit="event.preventDefault(); selectYear('{{ $year }}');">
                            @csrf
                            <input type="hidden" name="year" value="{{ $year }}">
                            <button type="submit" class="dropdown-item">{{ $year }}</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
        <div id="selectedYearData" class="card-body">
         
                <h5 class="card-title">Yearly Logs <span>| @if (isset($selectedYearCount)) {{ $selectedYearCount->year }}@endif</span></h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <div class="ps-3">
                        <h6 id="selectedYearCount">@if (isset($selectedYearCount)){{ $selectedYearCount->count }}@endif</h6>
                        <span class="text-success small pt-1 fw-bold">Increase: %</span> <span class="text-muted small pt-2 ps-1">increase</span>
                    </div>
                </div>
        </div>
    </div>
</div>
        <script>
            function selectYear(year) {
                // Make AJAX request to fetch data for the selected year
                fetch('/select-year', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                    },
                    body: JSON.stringify({ year: year })
                })
                .then(response => response.json())
                .then(data => {
                    // Update the HTML elements with the fetched data
                    document.getElementById('selectedYearCount').innerText = data.selectedYearCount;
                    // You can update other HTML elements as needed
                })
                .catch(error => console.error('Error:', error));
            }
        </script>
        
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Logins<a href="{{route('program.index')}}" class="btn btn-success btn-sm" style="margin-right: 50px; float:right;"> Program Statistics</a></h5>
              <div class="table-responsive">
              <table class="table datatable table-hover">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time in</th>
                    <th scope="col">Program</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($recentUsers as $user)
                    <tr>
                        <td scope="row">{{$user->userLogin->name}}</td>
                        <td scope="row">{{ \Carbon\Carbon::parse($user->login_time)->format('F j, Y') }}</td>
                        <td scope="row">{{ \Carbon\Carbon::parse($user->login_time)->format('h:i A') }}</td>
                        <td scope="row">{{$user->userLogin->program}}</td>
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
  <!-- Your HTML -->
  <script>$(function () {
    $('[data-bs-toggle="popover"]').popover();
});
</script>

</body>

</html>