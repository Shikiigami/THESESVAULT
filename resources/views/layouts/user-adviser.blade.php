<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>List of Advisers</title>
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

    <div class="pagetitle">
      <h1><img src="{{ asset ('img/adviser.png') }}" alt="img" width="40" height="40">List of Advisers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Advisers</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section ">
    <div class="col-lg-12">
      <div class="row">
        
          
      @foreach ($advisers as $adviser)
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">
         <!-- advisers-card -->
          <div class="card mb-0">
            <div class="row g-1">
              <div class="col-md-4">
                <img src="{{$adviser->profile_picture ? asset('storage/advisers_pic/' . $adviser->profile_picture) : asset('img/null-profile.png')  }}" style="background-size:cover; margin:10px;"alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#adviserModal{{$adviser->adviserId}}">
                        <h5 class="card-title">{{$adviser->adviser_name}}</h5>
                    </a>
                    <div class="modal fade" id="adviserModal{{$adviser->adviserId}}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-m">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><span>List of theses advised by: </span>{{$adviser->adviser_name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 style="display: flex; align-items: center;">
                                    <span style="margin-left: 10px; font-size: 20px;">
                                          @if ($adviser->adviser->count() > 0)
                                              <ul>
                                                  @foreach ($adviser->adviser as $research)
                                                      <li><a href="{{ route('get.view', ['filename' => $research->filename]) }}">{{pathinfo($research->filename, PATHINFO_FILENAME) }}</li></a>
                                                  @endforeach
                                              </ul>
                                          @else
                                              <p>No research data found for this adviser.</p>
                                          @endif
                                      </span>
                                    </h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
          <p class="card-text">
                      @php
                          $college_name = "";
                          if ($adviser->adviser_college == '130') {
                              $college_name = "CEAT";
                          } elseif ($adviser->adviser_college == '131') {
                              $college_name = "CS";
                          }
                      @endphp
                      <b>College: </b> {{$college_name}} <span>Faculty</span><br>
                      <b>No. of Thesis Advisees: </b> {{ $adviser->adviser_count }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      @endforeach
    </div>
</div>
{{ $advisers->links('vendor.pagination.default') }}
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
  
  <div class="modal fade" id="verticalycentered6" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-m">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <h5 style="display: flex; align-items: center;">
    <i class="ri-alert-line" style="font-size: 50px;"></i>
    <span style="margin-left: 10px;">
        System will know you if you download this file,
        You must be responsible for any consequences.
    </span>
</h5>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Download</button>
        </div>
      </div>
    </div>
  </div>
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