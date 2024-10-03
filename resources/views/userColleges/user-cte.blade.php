<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{$collegeUserName}}</title>
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
      <h1><img src="{{ asset ('img/cte.png') }}" alt="img" width="40" height="40"> {{$collegeUserName}}</h1>
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
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">CTE</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="col-lg-12">
      <div class="card info-card revenue-card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"></a>
        </div>

        <div class="card-body">
    <h5 class="card-title">Based on your selected college, you might like this <span>| Related</span></h5>

    <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="ri-lightbulb-flash-line"></i>
        </div>
        <div class="ps-3">
            @if ($collegeUsersAlgo->isEmpty())
                <p>No research papers found. Please add interest on your profile</p>
            @else
                <div class="research-content">
                    @foreach ($collegeUsersAlgo as $research)
                        <div class="research-item" style="display: none;">
                            <a href="{{ route('get.view', ['filename' => $research->filename]) }}" class="research-paper"><h6>{{ $research->filename }}</h6></a>
                            <span class="text-success small pt-1 fw-bold" id="callno">{{ $research->callno }}</span>
                            <span class="text-muted small pt-2 ps-1">Its for you</span>
                        </div>
                    @endforeach
                </div>
            @endif 
        </div>
    </div> 
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const researchItems = document.querySelectorAll('.research-item');
        let currentIndex = 0;

        function showNextResearchItem() {
            const currentItem = researchItems[currentIndex];
            const nextIndex = (currentIndex + 1) % researchItems.length;
            const nextItem = researchItems[nextIndex];

            $(currentItem).fadeOut(1000, () => {
                $(nextItem).fadeIn(1000);
            });
            currentIndex = nextIndex;
        }
        $(researchItems[currentIndex]).fadeIn(1000);
        setInterval(showNextResearchItem, 3000); // Change the interval as needed (in milliseconds)
    });
</script>
      </div>
        </div>

  <div class="row">
    @foreach ($userfiles as $research)
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
                <i class="bi bi-bookmark"></i> <!-- Display empty star icon -->
            @endif
          </button>
            </form>
            </h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bx bxs-file"></i>
              </div>
              <div class="ps-3">
                <h6 class="truncate-text d-flex align-items-justify" style="font-size: 17px;">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#verticalycentered7{{$research->id}}">
                      <span class="truncate-content">
                          <?php
                          $filename = pathinfo($research->filename, PATHINFO_FILENAME);
                          if (strlen($filename) > 44) {
                              $truncatedFilename = substr($filename, 0, 50) . '...';
                              echo htmlspecialchars($truncatedFilename);
                          } else {
                              echo htmlspecialchars($filename);
                          }
                          ?>
                      </span>
                  </a>
              </h6>
              
              </div>
            </div>
            <div class="d-flex align-items-start" style="float: right; margin: 10px;">
              <a href="#" data-bs-toggle="modal" data-bs-target="#request{{$research->id}}"><span class="btn btn-success btn-sm align-items-start;"><i class="bi bi-hand-index-thumb"></i> Request</span></a>&nbsp;
              @if($research->privacy === 'public')
              <a href="{{ route('get.view', ['filename' => $research->filename]) }}" target="_blank"><span class="btn btn-warning btn-sm align-items-start"><i class="bi bi-eye-fill"></i> View</span></a>&nbsp;
              @endif
              @if($research->privacy === 'restricted')
              <a href="#" data-bs-toggle="modal" data-bs-target="#fullrequest{{$research->id}}"><span class="btn btn-danger btn-sm align-items-start"><i class="bi bi-eye-fill"></i> View</span></a>&nbsp;
              @endif
            </div>
          </div>
        </div>
      </div>
            <script>
                function loadPDF(pdfSrc, modalId) {
                    var embedTag = document.getElementById('pdfEmbed' + modalId);
                    embedTag.setAttribute('src', pdfSrc);
            
                    var modal = new bootstrap.Modal(document.getElementById('viewfile' + modalId));
                    modal.show();
                }
  </script>

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
             <b class="text-dark">Title: </b>{{$research->filename}}<br>
             <b class="text-dark">Authors: </b>{{$research->author}} <br>
             <b class="text-dark">Approved Date: </b> {{$research->date_published}}<br>
             <b class="text-dark">College: </b>{{$research->college_name}}<br>
             <b class="text-dark">Program: </b>{{$research->program}}<br>
             <b class="text-dark">Citation: </b><br>
             <div class="citationContainer">
              <span class="text-primary small pt-1" style="display: flex; align-items: center;">
                  <code class="citationCode" style="margin: 0; padding: 10px; background-color: #f8f9fa; border: 1px solid #d1d1d1; border-radius: 4px; display: flex; align-items: center; width: 100%;">
                      {{$research->citation}}
                  </code>
                  <i class="ri-file-copy-2-line text-success clipboardIcon"  style="font-size: 30px; margin-left: 10px; cursor: pointer;"></i>
              </span>
          </div>
             </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div><!-- End view Modal-->

    <!-- requests modal -->
<div class="modal fade" id="request{{$research->id}}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-m">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Request Approval sheet of {{ pathinfo($research->filename, PATHINFO_FILENAME) }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="width: 100%;">
              <form method="POST" action="{{route('request.add', ['id'=> $research->id]) }}" class="row g-3 needs-validation">
                @csrf
                <div class="col-6">
                  <input type="text" name="purpose" class="form-control" placeholder="Purpose" required>
                </div>
                <div class="col-6">
                  <select  name="receive_thru" class="form-control" placeholder="Receive Thru" required >
                    <option value="" disabled selected>Receive Thru</option>
                    <option value="Email">Email</option>
                    <option value="F2F Transaction">F2F Transaction</option>
                  </select>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                  <button type="submit" name="submit" class="btn btn-primary "> Request</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>


<!-- full-text requests modal -->
<div class="modal fade" id="fullrequest{{$research->id}}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-m">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Request Full Text document of {{ pathinfo($research->filename, PATHINFO_FILENAME) }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="width: 100%;">
              <form method="POST" action="{{route('fullrequest.add', ['id'=> $research->id]) }}" class="row g-3 needs-validation">
                @csrf
                <div class="col-12">
                  <input type="text" name="purpose" class="form-control" placeholder="Purpose" required>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                  <button type="submit" name="submit" class="btn btn-primary "> Request</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
    @endforeach
  </div>
  {{ $userfiles->links('vendor.pagination.default') }}
</section>
<script>
  $(document).ready(function () {
  $('#verticalycentered7').on('show.bs.modal', function (event) {
    var modal = $(this);
    var link = $(event.relatedTarget);
    var researchId = link.data('research-id');

    $.ajax({
      url: '/fetch-research/' + researchId,
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