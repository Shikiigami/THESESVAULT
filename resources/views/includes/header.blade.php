
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

<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="{{route('dashboard')}}" class="logo d-flex align-items-center">
    <img src="{{ asset('img/rchive.png') }}" alt="logo">
    <span class="d-none d-lg-block">ThesesVault</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar">
    <form class="search-form d-flex align-items-center" action="{{ route('search-research') }}" method="GET">
        <input type="text" id="search" name="search" placeholder="Search" required>
        <button type="submit" name="submit" class="icon"><i class="bi bi-search"></i></button>
    </form>
    <ul id="search-results" class="results-list"></ul>
    <ul id="search-history" class="results-list">
    </ul>
</div>
<!-- End Search Bar -->
<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).ready(function () {
    var searchInput = $('#search');
    var resultsList = $('#search-results');
    var historyList = $('#search-history');

    // Initially hide the results and history
    resultsList.hide();
    historyList.hide();
    
    // Function to show the most recent 3 search history items
    function showRecentHistory() {
        historyList.empty();

        var clickableItems = [
        "Author Search",
        "Adviser Search",
        "College Search",
        "Program Search"
    ];

    clickableItems.forEach(function (itemName) {
    var clickableItem = $('<li><i class="bi bi-search"></i> ' + itemName + '</li>');
    clickableItem.on('click', function () {
        if (itemName === "Author Search") {
            $('#searchByAuthor').modal('show');
            // You can also perform other actions here for Author Search
            searchInput.val(itemName);
            historyList.hide();
        } else if (itemName === "Adviser Search") {
            $('#searchByAdviser').modal('show');
           
            searchInput.val(itemName);
            historyList.hide();
        } else if (itemName === "College Search") {

            $('#searchByCollege').modal('show');
            searchInput.val(itemName);
            historyList.hide();
        } else if (itemName === "Program Search") {

        $('#searchByProgram').modal('show');
          searchInput.val(itemName);
          historyList.hide();
        } else {
            // Handle other items if needed
        }
    });
    historyList.append(clickableItem);
});


    

        // Retrieve the most recent 3 search history items via AJAX
        $.ajax({
            url: "{{ route('searches') }}",
            type: "GET",
            data: { search: '' }, // Use an empty query to retrieve history
            success: function (data) {
                var recentHistory = data.history.slice(0, 3);
                $.each(recentHistory, function (key, value) {
                    var historyItem = $('<li><i class="ri-history-line"></i> ' + value + '</li>');
                    historyItem.on('click', function () {
                        searchInput.val(value);
                        historyList.hide();
                    });
                    historyList.append(historyItem);
                });
                historyList.show();
            }
        });
    }

    // Function to show search results
    function showSearchResults(query) {
        $.ajax({
            url: "{{ route('searches') }}",
            type: "GET",
            data: { search: query },
            success: function (data) {
                resultsList.empty();
                historyList.hide(); // Hide search history when results are displayed

                $.each(data.results, function (key, value) {
                    var resultItem = $('<li>' + value + '</li>');
                    resultItem.on('click', function () {
                        searchInput.val(value);
                        resultsList.hide();
                    });
                    resultsList.append(resultItem);
                });

                resultsList.show();
            }
        });
    }

    // Handle click event on the search input
    searchInput.on('click', function () {
        var query = $(this).val();

        if (query === '') {
            // Show search history when input is clicked but empty
            showRecentHistory();
            resultsList.hide();
        }
    });

    // Handle keyup event for text input
    searchInput.on('keyup', function () {
        var query = $(this).val();

        if (query === '') {
            // Show search history when input is empty
            showRecentHistory();
            resultsList.hide();
            return;
        }

        showSearchResults(query);
    });

    // Click event for the document to hide history when clicking outside
    $(document).on('click', function (e) {
        if (!searchInput.is(e.target) && !historyList.is(e.target)) {
            historyList.hide();
        }
    });
});
</script>


<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">
    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>

    </li><!-- End Search Icon-->

    {{-- add admin --}}

    <li class="nav-item dropdown">
      <a class="nav-link nav-icon" href="#" data-bs-toggle="modal" data-bs-target="#addAdminModal">
        <i class="bi bi-person fs-3"></i>
        <span class="badge bg-success badge-number">+</span>
      </a>
    </li>
    
   
    <li class="nav-item dropdown pe-3">
      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
      <div style="position: relative; display: inline-block;">
    <img src="{{ Auth::user()->profile_picture ? asset('storage/pictures/' . Auth::user()->profile_picture) : asset('img/null-profile.png') }}" alt="Profile Picture" class="rounded-circle">
    @if(Auth::user()->status === 'Active')
        <span style="position: absolute; bottom: 0; right: 0; width: 12px; height: 12px; background-color: #4DED30; border-radius: 50%;"></span>
    @endif
</div>
        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>{{ Auth::user()->name }}</h6>
          <span>{{ Auth::user()->email }}</span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{route('admin-profile')}}">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
            <i class="bi bi-question-circle"></i>
            <span>Need Help?</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item d-flex align-items-center"><i class="bi bi-box-arrow-right"></i><span>Logout</span></button>
          </form>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->
</header><!-- End Header -->

<div class="modal fade" id="searchByAuthor" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered  modal-m">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title"><i class="bi bi-search"></i> Search By Author</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="GET" action="{{route('searchByAuthor')}}" enctype="multipart/form-data" class="row g-3 needs-validation">
        <div class="col-12">
          <input type="text" id="search_author" name="search_author" class="form-control" placeholder ="Search By Author " required>
        </div>
      <div class="d-grid gap-2">
      <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="bx bx-search-alt-2 lg"></i>Search</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div>


{{-- Add Admin --}}
<div class="modal fade" id="addAdminModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title"><i class="bi bi-person-plus fs-3"></i> Add Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{route('add.admin')}}" enctype="multipart/form-data" class="row g-3 needs-validation">
        @csrf
        <div class="col-6">
          <input type="text" id="admin_name" name="admin_name" class="form-control" placeholder ="Admin Name" required>
        </div>
        <div class="col-6">
          <input type="text" id="admin_email" name="admin_email" class="form-control" placeholder ="Admin Email " required>
        </div>
        <div class="col-6">
          <input type="text" id="admin_password" name="admin_password" class="form-control" placeholder ="Password" required>
        </div>
        <div class="col-6">
          <input type="text" id="admin_cpassword" name="admin_cpassword" class="form-control" placeholder ="Confirm Password" required>
        </div>
      <div class="d-grid gap-2">
      <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="bi bi-plus"></i> Create Admin</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- End of Add Admin --}}


{{-- adviser search --}}

<div class="modal fade" id="searchByAdviser" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered  modal-m">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title"><i class="bi bi-search"></i> Search By Adviser</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="GET" action="{{route('searchByAdviser')}}" enctype="multipart/form-data" class="row g-3 needs-validation">
        <div class="col-12">
          <input type="text" id="search_adviser" name="search_adviser" class="form-control" placeholder ="Search By Adviser " required>
        </div>
      <div class="d-grid gap-2">
      <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="bx bx-search-alt-2 lg"></i> Search</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- college search --}}

<div class="modal fade" id="searchByCollege" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered  modal-m">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title"><i class="bi bi-search"></i> Search By College</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="GET" action="{{route('searchByCollege')}}" enctype="multipart/form-data" class="row g-3 needs-validation">
        <div class="col-12">
          <select class="form-control" id="search_college" name="search_college" placeholder="Search By College" required>
          <option value="" disabled selected>College</option>
            <option value="CEAT">CEAT</option>
            <option value="CS">CS</option>               
      </select>
        </div>
      <div class="d-grid gap-2">
      <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="bx bx-search-alt-2 lg"></i> Search</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- program search --}}

<div class="modal fade" id="searchByProgram" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered  modal-m">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title"><i class="bi bi-search"></i> Search By Program</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="GET" action="{{route('searchByProgram')}}" enctype="multipart/form-data" class="row g-3 needs-validation">
        <div class="col-12">
          <select class="form-control" name="search_program" placeholder="Search By Program" required>
                  <option value="" disabled selected>Program</option>
                  <option value="BS Information Technology">BS Information Technology</option>
                  <option value="BS Computer Science">BS Computer Science</option>
                  <option value="BS Medical Biology">BS Medical Biology</option>
                  <option value="BS Environmental Science">BS Environmental Science</option>
                  <option value="BS Marine Biology">BS Marine Biology</option>
                  <option value="BS Civil Engineering">BS Civil Engineering</option>
                  <option value="BS Mechanical Engineering">BS Mechanical Engineering</option>
                  <option value="BS Petroleum Engineering">BS Petroleum Engineering</option>
                  <option value="BS Electrical Engineering">BS Electrical Engineering</option>
                  <option value="BS Architecture">BS Architecture</option>    
                </select>
          </div>
      <div class="d-grid gap-2">
      <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="bx bx-search-alt-2 lg"></i> Search</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div>