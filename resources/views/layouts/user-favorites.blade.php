<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>List of all Favorites</title>
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
      <h1><img src="{{ asset ('img/user-favorite.png') }}" alt="img" width="40" height="40"> My Favorites</h1>
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
          <li class="breadcrumb-item active">Favorites</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <section class="section dashboard">
  <div class="row">
    @if ($userFavorites->isEmpty())
        <p>No favorites selected.</p>
    @else

    @foreach ($userFavorites as $favorites)
      <!-- favorites Card -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"></a>
          </div>
          <div class="card-body">
          <h5 class="card-title">{{$favorites->callno }}
                <form action="{{ route('file.remove', ['fid' => $favorites->fid]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE') <!-- Add the DELETE method -->
                    <button type="submit" class="fav-button"><i class="bi bi-bookmark-check-fill"></i></button>
                </form>
            </h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bx bxs-file"></i>
              </div>
              <div class="ps-3">
              <h6 class="d-flex align-items-center" style="font-size: 20px;"><a href="#" data-bs-toggle="modal" data-bs-target="#verticalycentered7{{$favorites->fid}}">
                {{ Illuminate\Support\Str::limit(pathinfo($favorites->filename, PATHINFO_FILENAME), 42, '...') }}
              </a></h6>
              </div>
            </div>
            <div class="d-flex align-items-start" style="float: right; margin: 10px;">
              <a href="#" data-bs-toggle="modal" data-bs-target="#citation{{$favorites->fid}}"><span class="btn btn-success btn-sm align-items-start;"><i class="bi bi-chat-quote-fill"></i> Citation</span></a>&nbsp;
              <a href="{{ route('get.view', ['filename' => $favorites->filename]) }}" target="_blank"><span class="btn btn-warning btn-sm align-items-start"><i class="bi bi-eye-fill"></i> View</span></a>&nbsp;
            </div>
          </div>
        </div>
      </div><!-- End favorites Card -->
     <!-- view modal -->
    <div class="modal fade" id="verticalycentered7{{$favorites->fid}}" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ pathinfo($favorites->filename, PATHINFO_FILENAME) }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p class="text-primary">
              <b class="text-dark">Tittle: </b>{{$favorites->filename}}<br>
              <b class="text-dark">Authors: </b>{{$favorites->author}} <br>
              <b class="text-dark">Published Date: </b> {{$favorites->date_published}}<br>
              @php
                $collegeName = ($favorites->college == 130) ? 'CEAT' : (($favorites->college == 131) ? 'CS' : 'N/A');
                @endphp
              <b class="text-dark">College: </b>{{$collegeName}}<br>
              <b class="text-dark">Adviser: </b>{{$favorites->adviser}}
              </p>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div><!-- End view Modal-->

     <!-- Citatation modal -->
   <div class="modal fade" id="citation{{$favorites->fid}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-m">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ pathinfo($favorites->filename, PATHINFO_FILENAME) }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <h5 class="text" style="display: flex; align-items: center;">
    <i class="ri-file-list-line" style="font-size: 50px;"></i>
    <span class="text-success small pt-1 fw-bold" style="margin-left: 10px;">
    {{$favorites->citation}}
    </span>
       </h5>
      </div>
    </div>
  </div>
  </div> <!--End of Citation Modal -->
     
    @endforeach
   @endif
  </div>
  {{ $userFavorites->links('vendor.pagination.default') }}
</section>
<script>
  $(document).ready(function () {
  $('#verticalycentered7').on('show.bs.modal', function (event) {
    var modal = $(this);
    var link = $(event.relatedTarget);
    var researchId = link.data('research-id');

    $.ajax({
      url: '/fetch-fav-research/' + researchId,
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        modal.find('.modal-title').text(data.filename);
        modal.find('.modal-body').html(data.modalContent);
      },
      error: function (xhr, textStatus, errorThrown) {
        console.error('Error fetching research data: ' + errorThrown);
      }
    });
  });
});

</script>
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