<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>List of all Theses</title>
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
@if (auth()->user()->role === 'admin')
      @include('includes.header') {{-- Include the admin sidebar --}}
  @elseif (auth()->user()->role === 'user')
      @include('includes.user-header')  {{-- Include the user sidebar --}}
  @endif

  <!-- ======= Sidebar ======= -->
  @if (auth()->user()->role === 'admin')
      @include('includes.aside')  {{-- Include the admin sidebar --}}
  @elseif (auth()->user()->role === 'user')
      @include('includes.user-aside')  {{-- Include the user sidebar --}}
  @endif

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><img src="{{ asset ('img/rchive.png') }}" alt="img" width="40" height="40"> List of All Theses</h1>
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
      alert.classList.add('fade-out-up');

      setTimeout(function () {
        alert.remove();
      }, 1000); 
    });
  }, 2000);
});

</script>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Theses</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <section class="section dashboard">
  <div class="row">
    @foreach ($userResearch as $research)
      <!-- Sales Card -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"></a>
          </div>
          <div class="card-body">
            <h5 class="card-title">{{$research->callno }}
            <form action="{{ route('favorites.add', ['id' => $research->id]) }}" method="POST" style="display: inline;">
            @csrf 
            <button class="fav-button" type="submit">     
            @if ($research->isInFavorites)
                <i class="bi bi-bookmark-check-fill"></i>
            @else
                <i class="bi bi-bookmark"></i>
            @endif
          </button>
            </form>
          </h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bx bxs-file"></i>
              </div>
              <div class="ps-3">
              <h6 class="d-flex align-items-center" style="font-size: 20px;"><a href="#" data-bs-toggle="modal" data-bs-target="#verticalycentered7{{$research->id}}">
                {{ pathinfo($research->filename, PATHINFO_FILENAME) }}
              </a></h6>
              </div>
            </div>
            <div class="d-flex align-items-start" style="float: right; margin: 10px;">
              <a href="#" data-bs-toggle="modal" data-bs-target="#citation{{$research->id}}"><span class="btn btn-success btn-sm align-items-start;"><i class="bi bi-chat-quote-fill"></i> Citation</span></a>&nbsp;
              <a href="{{ route('get.view', ['filename' => $research->filename]) }}" target="_blank"><span class="btn btn-warning btn-sm align-items-start"><i class="bi bi-eye-fill"></i> View</span></a>&nbsp;
            </div>
          </div>
        </div>
      </div>
      <!-- view modal -->
  <div class="modal fade" id="verticalycentered7{{$research->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ pathinfo($research->filename, PATHINFO_FILENAME) }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
             <p class="text-primary">
             <b class="text-dark">Tittle: </b>{{$research->filename}}<br>
             <b class="text-dark">Authors: </b>{{$research->author}} <br>
             <b class="text-dark">Published Date: </b> {{$research->date_published}}<br>
             @php
              $collegeName = ($research->college == 130) ? 'CEAT' : (($research->college == 131) ? 'CS' : 'N/A');
              @endphp
             <b class="text-dark">College: </b>{{$collegeName}}<br>
             <b class="text-dark">Adviser: </b>{{$research->adviser}}
             </p>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div><!-- End view Modal-->

  <!-- Citatation modal -->
  <div class="modal fade" id="citation{{$research->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-m">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ pathinfo($research->filename, PATHINFO_FILENAME) }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <h5 class="text" style="display: flex; align-items: center;">
    <i class="ri-file-list-line" style="font-size: 50px;"></i>
    <span class="text-success small pt-1 fw-bold" style="margin-left: 10px;">
    {{$research->citation}}
    </span>
       </h5>
      </div>
    </div>
  </div>
  </div> <!--End of Citation Modal -->
  
   <!-- Start download Modal -->
    <div class="modal fade" id="download{{$research->id}}" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered  modal-m">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">{{ pathinfo($research->filename, PATHINFO_FILENAME) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <h6 style="display: flex; align-items: center;">
          <i class="ri-alert-line" style="font-size: 40px; color:red;"></i>
          <span class="text-danger" style="margin-left: 10px;">
          If you download this file, the system will be able to identify you, 
          and you will be held accountable for any resulting outcomes or repercussions.
          </span>
          </h6>
          <div class="modal-footer">
           <a href="{{ route('download.research', ['filename' => $research->filename]) }}" class="btn btn-primary btn-sm download-button">Download anyway</a>
            </div>

            </div>
          </div>
        </div>
    </div><!-- End download modal -->
    @endforeach
  </div>
  {{ $userResearch->links('vendor.pagination.default') }}
</section>

  </main><!-- End #main -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>PSU Library</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="http://psulibrary.palawan.edu.ph/home/">Palawan State University</a>
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- ======= Footer ======= -->

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