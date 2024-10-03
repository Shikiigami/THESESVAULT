<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>adviser List</title>
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
  <div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<script>
const preloader = document.getElementById('preloader');

function hidePreloader() {
  preloader.style.display = 'none';
}
setTimeout(hidePreloader, 1000); 
</script>

<!-- ======= Header ======= -->
@include('includes.header')
  
<!-- ======= Sidebar ======= -->
@include('includes.aside')


  <main id="main" class="main">
    <div class="pagetitle">
      <h1><img src="{{ asset ('img/adviser.png') }}" alt="img" width="40" height="40"> Adviser List<button type="button" class="btn btn-primary" style="float:right" data-bs-toggle="modal" data-bs-target="#verticalycentered6"><i class="bi bi-person-plus-fill"></i> Add Adviser</button></h1>
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
          <li class="breadcrumb-item active">Advisers</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
          <h5 class="card-title">Adviser Data</h5>
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">Picture</th>
                <th scope="col">Adviser Name</th>
                <th scope="col">Adviser College</th>
                <th scope="col">No. Research Advise</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($advisers as $adviser)
            <tr>
                <td scope="row">
                    @if ($adviser->profile_picture)
                            <img src="{{ asset('storage/advisers_pic/' . $adviser->profile_picture) }}" alt="photo" width="50" height="50" style="border-radius: 50%">
                        @else
                            <img src="{{ asset('img/null-profile.png') }}" alt="Default Photo" width="50" height="50">
                        @endif
                </td>
                <td scope="row" class="text-dark">{{ $adviser->adviser_name }}</td>
                <div class="modal fade" id="adviserModal{{$adviser->adviserId}}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-m">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><span>List of theses advised by: </span>{{$adviser->adviser_name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 style="display: flex; align-items: center;">
                                    <span style="margin-left: 10px; font-size: 15px;">
                                          @if ($adviser->adviser->count() > 0)
                                              <ul>
                                                  @foreach ($adviser->adviser as $research)
                                                      <li><a href="{{ asset('storage\pdf/' . $research->filename) }}">{{pathinfo($research->filename, PATHINFO_FILENAME) }}</a></li>
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
                <td scope="row">{{ $adviser->college_aid->college_name }}</td>
                <td scope="row"><a href="#" data-bs-toggle="modal" data-bs-target="#adviserModal{{$adviser->adviserId}}"><span class="badge bg-primary"><i class="bi bi-collection me-1"></i> {{ $adviser->adviser_count }}</span></a></td>
                <td style="vertical-align: middle!important;text-align: center;  ">
                    <div style="display: inline-flex; gap: 5px; justify-content: center;">
                    <a href="#" class="btn btn-warning btn-sm edit-modal-trigger" data-file="{{ json_encode($adviser) }}" data-target="#editModal_{{ $adviser->adviserId }}"><i class="bi bi-pencil-square"></i></a>
                    
                    <div class="modal fade" id="editModal_{{ $adviser->adviserId }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered  modal-m">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit Adviser</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form method="POST" action="{{ route('adviser.update', ['adviserId' => $adviser->adviserId]) }}" enctype="multipart/form-data" class="row g-3 needs-validation">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="adviserId" value="{{ $adviser->adviserId }}">
                    <div class="col-6">
                      <label for="adviser_name">Adviser Name</label>
                        <input type="text" name="adviser_name" id="adviser_name" class="form-control" placeholder="Adviser" value="">
                        </div>
                        <div class="col-6">
                          <label for="adviser_college"> Adviser College</label>
                        <select class="form-control" name="adviser_college" placeholder="College">
                            <option value="" disabled selected> College</option>
                                @foreach ($colleges as $college)
                                    <option value="{{ $college->id }}">{{ $college->college_name }}</option>
                                @endforeach
                        </select>
                        </div>
                        <div class="col-12">
                          <label for="profile_picture"><i class="bi bi-person-lines-fill"></i><span> Edit Adviser photo</span></label>
                        <input type="file"  class="form-control" name="profile_picture" id="profile_picture">
                        </div>
                    <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm"> Save</button>
                    </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            <form action="{{ route('adviser.delete', ['adviserId' => $adviser->adviserId]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$adviser->adviserId}}"><i class="bi bi-trash"></i></button>
                      <div class="modal fade" id="deleteModal{{$adviser->adviserId}}" tabindex="-1">
                          <div class="modal-dialog modal-dialog-centered  modal-m">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">{{$adviser->adviser_name}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <h6 style="display: flex; align-items: center;">
                          <i class="bx bxs-trash" style="font-size: 35px; color:red;"></i>
                          <span class="text-danger" style="margin-left: 10px; font-size: 20px;">
                             Are you sure you want to delete <span class="text-primary">{{ $adviser->adviser_name }}</span> as adviser?
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
              </div>
            </td>
            </tr>
            @endforeach
      </tbody>
    </table>
    {{ $advisers->links('vendor.pagination.default') }}
  </div>
</div>
</div> 
</div>
</section>
  </main><!-- End #main -->
  <div class="modal fade" id="verticalycentered6" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-m">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-person-plus-fill"></i> Add New Adviser</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('adviser.add') }}" enctype="multipart/form-data" class="row g-3 needs-validation">
          @csrf
          <div class="col-6">
              <input type="text" name="adviser_name" class="form-control" placeholder="Adviser" required>
            </div>
            <div class="col-6">
            <select class="form-control" name="adviser_college" placeholder="College" required>
                <option value="" disabled selected>College</option>
                    @foreach ($colleges as $college)
                        <option value="{{ $college->id }}">{{ $college->college_name }}</option>
                    @endforeach
            </select>
            </div>
            <div class="col-12">
            <label for="profile_picture"><i class="bi bi-person-lines-fill"></i><span> Add Adviser photo</span></label>
           <input type="file"  class="form-control" name="profile_picture" id="profile_picture" placeholder="Select picture" value="">
          </div>
        </div>
        <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-primary btn-sm "> Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>
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
  <script>
document.addEventListener('DOMContentLoaded', function () {
    const editModalTriggerButtons = document.querySelectorAll('.edit-modal-trigger');

    editModalTriggerButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const fileData = JSON.parse(button.getAttribute('data-file'));
            const modalId = button.getAttribute('data-target'); // Get the modal ID
            const editModal = document.querySelector(modalId);
            const adviserIdField = editModal.querySelector('[name="adviserId"]');
            const adviser_nameField = editModal.querySelector('[name="adviser_name"]');
            const adviser_collegeField = editModal.querySelector('[name="adviser_college"]');

            adviserIdField.value = fileData.adviserId;
            adviser_nameField.value = fileData.adviser_name;
            adviser_collegeField.value = fileData.adviser_college;
            const bsModal = new bootstrap.Modal(editModal);
            bsModal.show();
        });
    });
});
</script>
</body>
</html>