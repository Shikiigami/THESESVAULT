<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{$collegeName}}</title>
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
      <h1><img src="{{ asset ('img/rchive.png') }}" alt="ceat" width="50" height="50"> {{$collegeName}}<button type="button"  class="btn btn-primary" style="float:right" data-bs-toggle="modal" data-bs-target="#verticalycentered"><i class="bi bi-upload"></i> Upload</button></h1>
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
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Taytay Campus</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
            
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Theses Data</h5>

              <!-- Table with hoverable rows -->
              <table class="table datatable table-hover">
                <thead>
                  <tr>
                    <th scope="col">Doc No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Authors</th>
                    <th scope="col">Program</th>
                    <th scope="col">Adviser</th>
                    <th scope="col">Pub. Date</th>
                    <th scope="col">Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                @foreach ($taytayfiles as $file)
                    <tr>
                        <td scope="row">{{ $file->callno }}</td>
                        <td><a href="{{ asset('storage\pdf/' . $file->filename) }}">{{ pathinfo($file->filename, PATHINFO_FILENAME) }}</a></td>
                        <td>{{ $file->author }}</td>
                        <td>{{ $file->program }}</td>
                        <td>{{ $file->adviser }}</td>
                        <td>{{ $file->date_published }}</td>
                        <td style="vertical-align: middle!important;text-align: center;">
                      <div style="display: inline-flex; gap: 5px; justify-content: center;">
                      <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="View Approval / Abstract Sheet">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#approvalAbstract{{ $file->id }}" class="btn btn-success btn-sm">
                          <i class="bi bi-file-text"></i>
                      </a> 
                    </span>
                     {{-- Approval sheet and Abstract Modal --}}    
                     <div class="modal fade" id="approvalAbstract{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Approval Sheet and Abstract</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="View Approval sheett">
                            <p>View Approval Sheet: <span><a href=" {{ asset('storage/approvalSheet/' .$file->approvalSheet) }}">{{$file->approvalSheet}}</a></span></p>
                          </span>
                          <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="View Abstract Sheet">
                            <p>View Abstract: <span><a href=" {{ asset('storage/abstract/' .$file->abstract) }}">{{$file->abstract}}</a></span></p>
                          </span>
                          </div>
                        </div>
                      </div>
                    </div>

                  
                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Edit File">                         
                      <a href="#" class="btn btn-warning btn-sm edit-modal-trigger" data-file="{{ json_encode($file) }}" data-target="#editModal_{{ $file->id }}"><i class="bi bi-pencil-square"></i></a>
                    </span>
                        <!-- Start Edit Modal -->
                    <div class="modal fade" id="editModal_{{ $file->id }}" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered  modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                                <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit Research Material</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <form action="{{ route('file.update',['id' => $file->id]) }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation">
                              @csrf
                              @method('PUT')
                            <input type="hidden" name="id" value="{{ $file->id }}">
                            <div class="col-6">
                                <input type="text" name="callno" class="form-control" value="" >
                              </div>
                              <div class="col-6">
                                <input type="text" name="author" class="form-control" value=""  >
                              </div>
                              <div class="col-6">
                              <select class="form-control" name="program" value=""  >
                                <option value="" disabled selected>Program</option>
                                <option value="BS Business Administration">BS Business Administration</option>
                                <option value="BS Hospitality Management">BS Hospitality Management</option>
                                <option value="BS Information Technology">BS Information Technology</option>    
                              </select>
                              </div>
                              <div class="col-6">
                                  <select class="form-control" name="college" placeholder="College" required>
                                  <option value="" disabled selected>Select</option>
                                      @foreach ($colleges as $college)
                                          <option value="{{ $college->id }}">{{ $college->college_name }}</option>
                                      @endforeach
                              </select>
                                </div>
                                <div class="col-lg-6 position-relative">
                            <input class="form-control" type="text" name="adviser" placeholder="Adviser" required value="">
                            <div class="custom-select" id="adviserList" style="display: none; position: absolute; top: 100%; left: 0; width: 100%; max-width: calc(100% - 2px); z-index: 100; background-color: #fff; border: 1px solid #ced4da; border-top: none; overflow-y: auto; padding: 8px; border-radius: 8px;">
                                @foreach ($advisers as $adviser)
                                    <div class="option" style="padding: 2px;">{{ $adviser->adviser_name }}</div>
                                @endforeach
                            </div>
                        </div>
                        
                          <script>
                              $('input[name="adviser"]').on('input', function() {
                                  var input = $(this).val().toLowerCase();
                                  var options = $('#adviserList').find('.option');
                          
                                  options.each(function() {
                                      var optionText = $(this).text().toLowerCase();
                                      if (optionText.indexOf(input) > -1) {
                                          $(this).show();
                                      } else {
                                          $(this).hide();
                                      }
                                  });
                          
                                  $('#adviserList').show();
                              });
                          
                              $(document).on('click', function(e) {
                                  if (!$(e.target).closest('#adviserList').length && !$(e.target).is('input[name="adviser"]')) {
                                      $('#adviserList').hide();
                                  }
                              });
                          
                              $(document).on('click', '.option', function() {
                                  var selectedValue = $(this).text();
                                  $('input[name="adviser"]').val(selectedValue);
                                  $('#adviserList').hide();
                              });
                          </script>
                                <div class="col-6">
                                  <input type="date" name="date_published" class="form-control"  value=""   >
                                </div>
                                <div class="col-6">
                                  <textarea  name="tags" rows="1" class="form-control" placeholder="Tags"  value="" ></textarea>
                                </div>
                                <div class="col-6">
                                  <select class="form-control" name="privacy" value="" required>
                                    <option value="" disabled selected>Select Thesis Privacy</option>
                                    <option value="public">Public</option>
                                    <option value="restricted">Restricted</option>
                                  </select>
                                </div>
                                <div class="col-6">
                                  <select class="form-control" name="fieldname" placeholder="Field Name" required>
                                    <option value="" selected disabled> Field Name</option>
                                    @foreach($enumValues as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                  <select class="form-control" name="campus" placeholder="Campus" required>
                                      <option value="" disabled selected>Campus Name</option>
                                      <option value="Main Campus">Main Campus</option>
                                      <option value="Araceli">Araceli</option>
                                      <option value="Balabac">Balabac</option>
                                      <option value="Bataraza">Bataraza</option>
                                      <option value="Brooke's Point">Brooke's Point</option>
                                      <option value="Coron">Coron</option>
                                      <option value="Cuyo">PCAT Cuyo</option>
                                      <option value="Dumaran">Dumaran</option>
                                      <option value="El Nido">El Nido</option>
                                      <option value="Linapacan">Linapacan</option>
                                      <option value="Narra">Narra</option>
                                      <option value="Quezon">Quezon</option>
                                      <option value="Rizal">Rizal</option>
                                      <option value="Roxas">Roxas</option>
                                      <option value="San Rafael">San Rafael</option>
                                      <option value="San Vicente">San Vicente</option>
                                      <option value="Sofronio Española">Sofronio Española</option>
                                      <option value="Taytay">Taytay</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                  <textarea class="form-control" name="citation" rows="1" placeholder="Citation" value=""></textarea>
                                  </div>
                                  <div class="col-6">
                                    <input type="text" class="form-control" name="drive_link" value="" placeholder="Pdf Drive Link" required>
                                    </div>
                                    <div class="col-4">
                                      <label for="filename"> Thesis PDF file:</label>
                                    <input type="file" class="form-control" name="filename" accept=".pdf" value="">
                                    </div>
                                    <div class="col-4">
                                      <label for="approvalSheet"> Approval Sheet:</label>
                                    <input type="file" class="form-control" name="approvalSheet" accept=".pdf" value="">
                                    </div>
                                    <div class="col-4">
                                      <label for="abstract"> Abstract:</label>
                                    <input type="file" class="form-control" name="abstract" accept=".pdf">
                                    </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                              
                              <button type="submit" name="submit" class="btn btn-primary ">Update</button>
                          </div>
                              </div>
                              </form>
                          </div>
                        </div>
                      </div> 
                      <form action="{{ route('file.delete', ['id' => $file->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Delete File">
                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$file->id}}"><i class="bi bi-trash"></i></button>
                          </span>
                        <div class="modal fade" id="deleteModal{{$file->id}}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered  modal-m">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">{{ pathinfo($file->filename, PATHINFO_FILENAME) }}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <h6 style="display: flex; align-items: center;">
                            <i class="bx bxs-trash" style="font-size: 25px; color:red;"></i>
                            <span class="text-danger" style="margin-left: 10px; font-size: 20px;">
                               Are you sure you want to delete this file?
                            </span>
                            </h6>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-sm"><span>Delete</span></button>
                              </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </form>
                    </div>
                </td>
              </tr>cuyo
            @endforeach
                </tbody>
              </table>
              {{ $taytayfiles->links('vendor.pagination.default') }}
            </div>
          </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- Upload Modal -->
  <div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
              <h5 class="modal-title"><i class="bi bi-file-earmark-plus"></i> Add New Research Material</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data" class="row g-3 needs-validation">
          @csrf
          <div class="col-6">
              <input type="text" name="callno" class="form-control" placeholder="Call No." required>
            </div>
            <div class="col-6">
              <input type="text" name="author" class="form-control" placeholder="Authors" required >
            </div>
            <div class="col-6">
            <select class="form-control" name="program" placeholder="Program" required>
                <option value="" disabled selected>Program</option>
                <option value="BS Business Administration">BS Business Administration</option>
                <option value="BS Hospitality Management">BS Hospitality Management</option>
                <option value="BS Information Technology">BS Information Technology</option>
            </select>
            </div>
            <div class="col-6">
            <select class="form-control" name="college" placeholder="College" required>
                <option value="" disabled selected>College</option>
                    @foreach ($colleges as $college)
                        <option value="{{ $college->id }}">{{ $college->college_name }}</option>
                    @endforeach
            </select>
              </div>
             <div class="col-6">
            <input class="form-control" type="text" name="adviser" id="adviserInput" placeholder="Adviser" required>
            <div id="adviserSuggestions" class="suggestions-container"></div>
        </div>        
         <script>
          // Function to show search results based on input query
              function showAdviserResults(query) {
                  $.ajax({
                      url: "/filter-advisers", // Adjust the URL to your endpoint
                      type: "GET",
                      data: { adviser: query },
                      success: function(data) {
                          $('#adviserSuggestions').empty(); // Corrected here

                          $.each(data, function(key, value) {
                            var adviserItem = $('<li style="list-style-type: none; padding: 8px;"> ' + value.adviser_name + '</li>');
                              adviserItem.on('click', function() {
                                  $('#adviserInput').val(value.adviser_name);
                                  $('#adviserSuggestions').hide(); // Corrected here
                              });
                              $('#adviserSuggestions').append(adviserItem); // Corrected here
                          });

                          $('#adviserSuggestions').show(); // Corrected here
                      },
                      error: function(xhr, status, error) {
                          console.error('Error fetching advisers:', error);
                      }
                  });
              }
              // Handle keyup event for text input
              $('#adviserInput').on('keyup', function() {
                  var query = $(this).val().trim();

                  if (query === '') {
                      $('#adviserSuggestions').hide(); // Corrected here
                      return;
                  }

                  showAdviserResults(query);
              });
                        </script>
              <div class="col-6">
                <input type="date" name="date_published" class="form-control"  placeholder ="Published Date" required >
              </div>
              <div class="col-6">
                <textarea  name="tags" rows="1" class="form-control" placeholder="Tags"  value="" ></textarea>
              </div>
              <div class="col-6">
                <select class="form-control" name="privacy" value="" required>
                  <option value="" disabled selected>Select Thesis Privacy</option>
                  <option value="public">Public</option>
                  <option value="restricted">Restricted</option>
                </select>
              </div>
              <div class="col-6">
                <select class="form-control" name="fieldname" placeholder="Field Name" required>
                  <option value="" selected disabled> Field Name</option>
                  @foreach($enumValues as $value)
                  <option value="{{ $value }}">{{ $value }}</option>
                  @endforeach
                  </select>
              </div>
                  <div class="col-6">
                    <select class="form-control" name="campus" placeholder="Campus" required>
                        <option value="" disabled selected>Campus Name</option>
                        <option value="Main Campus">Main Campus</option>
                        <option value="Araceli">Araceli</option>
                        <option value="Balabac">Balabac</option>
                        <option value="Bataraza">Bataraza</option>
                        <option value="Brooke's Point">Brooke's Point</option>
                        <option value="Coron">Coron</option>
                        <option value="Cuyo">PCAT Cuyo</option>
                        <option value="Dumaran">Dumaran</option>
                        <option value="El Nido">El Nido</option>
                        <option value="Linapacan">Linapacan</option>
                        <option value="Narra">Narra</option>
                        <option value="Quezon">Quezon</option>
                        <option value="Rizal">Rizal</option>
                        <option value="Roxas">Roxas</option>
                        <option value="San Rafael">San Rafael</option>
                        <option value="San Vicente">San Vicente</option>
                        <option value="Sofronio Española">Sofronio Española</option>
                        <option value="Taytay">Taytay</option>
                      </select>
                  </div>
              <div class="col-6">
                <textarea class="form-control" name="citation" rows="1" placeholder="Citation"></textarea>
                </div>
                <div class="col-6">
                  <input type="text" class="form-control" name="drive_link" placeholder="Pdf Drive Link" required>
                  </div>
                  <div class="col-6">
                    <label for="filename"> Thesis PDF file:</label>
                  <input type="file" class="form-control" name="filename" accept=".pdf" value="">
                  </div>
                  <div class="col-6">
                    <label for="approvalSheet"> Approval Sheet:</label>
                  <input type="file" class="form-control" name="approvalSheet" accept=".pdf" value="">
                  </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            <button type="submit" name="submit" class="btn btn-primary "> Upload</button>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div><!-- End of Upload  Modal-->  
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>
  <script>$(function () {
    $('[data-bs-toggle="popover"]').popover();
});
</script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const editModalTriggerButtons = document.querySelectorAll('.edit-modal-trigger');

    editModalTriggerButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const fileData = JSON.parse(button.getAttribute('data-file'));
            const modalId = button.getAttribute('data-target'); // Get the modal ID
            const editModal = document.querySelector(modalId);
            const idField = editModal.querySelector('[name="id"]');
            const callnoField = editModal.querySelector('[name="callno"]');
            const authorField = editModal.querySelector('[name="author"]');
            const programField = editModal.querySelector('[name="program"]');
            const collegeField = editModal.querySelector('[name="college"]');
            const adviserField = editModal.querySelector('[name="adviser"]');
            const date_publishedField = editModal.querySelector('[name="date_published"]');
            const fieldnameField = editModal.querySelector('[name="fieldname"]');
            const campusField = editModal.querySelector('[name="campus"]');
            const citationField = editModal.querySelector('[name="citation"]');
            const drive_linkField = editModal.querySelector('[name="drive_link"]');
            const tagsField = editModal.querySelector('[name="tags"]');
            const privacyField = editModal.querySelector('[name="privacy"]');
            // Set values in the modal fields
            idField.value = fileData.id;
            callnoField.value = fileData.callno;
            authorField.value = fileData.author;
            programField.value = fileData.program;
            collegeField.value = fileData.college;
            adviserField.value = fileData.adviser;
            date_publishedField.value = fileData.date_published;
            fieldnameField.value = fileData.fieldname;
            campusField.value = fileData.campus;
            citationField.value = fileData.citation;
            drive_linkField.value =fileData.drive_link;
            tagsField.value =fileData.tags;
            privacyField.value =fileData.privacy;

            const bsModal = new bootstrap.Modal(editModal);
            bsModal.show();
        });
    });
});
</script>
</body>

</html>