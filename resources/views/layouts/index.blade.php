
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset ('img/rchive.png') }}" rel="icon">
  <link href="{{ asset ('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            @if (auth()->user()->role === 'admin')
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Total No. of Theses <span>Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-file-text-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{  $filesCount  }}</h6>
                      <span class="text-success small pt-1 fw-bold">14%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->
            @endif
            <!-- Revenue Card -->
            
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Most Selected Interest <span>| Related</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bx-line-chart"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size: 23px;">{{$interest}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ number_format($percentageResult[0]->highest_percentage, 0) }}%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->
            <!-- Customers Card -->
            @if (auth()->user()->role === 'admin')
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Total No. of users <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$userCount}}</h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>

                </div>
              </div>

        </div><!-- End Customers Card -->
        @endif
    @if(auth()->user()->role === 'user')
    <div class="col-lg-12">
      <div class="card info-card revenue-card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"></a>
        </div>

        <div class="card-body">
    <h5 class="card-title">Suggested For You <span>| Related</span></h5>

    <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="ri-lightbulb-flash-line"></i>
        </div>
        <div class="ps-3">
            @if ($researchData->isEmpty())
                <p>No research papers found. Please add interest on your profile</p>
            @else
                <div class="research-content">
                    @foreach ($researchData as $research)
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

        // Start the animation
        $(researchItems[currentIndex]).fadeIn(1000);
        setInterval(showNextResearchItem, 3000); // Change the interval as needed (in milliseconds)
    });
</script>
      </div>
        </div>
@endif
@if(auth()->user()->role === 'user')
    <div class="col-lg-12">
      <div class="card info-card sales-card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"></a>
        </div>

        <div class="card-body">
    <h5 class="card-title">You also Might Like <span>| Related</span></h5>

    <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="ri-thumb-up-fill"></i>
        </div>
        <div class="ps-3">
                <div class="research-content">
                       @foreach ($topFrequentItemsets as $filename)
                        <div class="frequent-item" style="display: none;">
                            <a href="{{ route('get.view', ['filename' => $filename]) }}" class="research-paper"><h6>{{ $filename  }}</h6></a>
                            <span class="text-success small pt-1 fw-bold" id="callno">Let's View</span>
                            <span class="text-muted small pt-2 ps-1">Its for you</span>
                        </div>
                    @endforeach
                </div>
        </div>
    </div> 
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const frequentItems = document.querySelectorAll('.frequent-item');
        let currentIndex = 0;

        function showNextResearchItem() {
            const currentItem = frequentItems[currentIndex];
            const nextIndex = (currentIndex + 1) % frequentItems.length;
            const nextItem = frequentItems[nextIndex];

            $(currentItem).fadeOut(1000, () => {
                $(nextItem).fadeIn(1000);
            });

            currentIndex = nextIndex;
        }

        // Start the animation
        $(frequentItems[currentIndex]).fadeIn(1000);
        setInterval(showNextResearchItem, 3000); // Change the interval as needed (in milliseconds)
    });
</script>
      </div>
        </div>
        @endif
          <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Most viewed Theses in your College</h5>   
              <!-- Bar Chart -->
              <canvas id="barChart" style="max-height: 250px;"></canvas>
              <script>
              var labelChart = JSON.parse('<?php echo json_encode($label_chart); ?>');
              var countUser = JSON.parse('<?php echo json_encode($count_user); ?>');
  
                  document.addEventListener("DOMContentLoaded", () => {
                      new Chart(document.querySelector('#barChart'), {
                          type: 'bar',
                          data: {
                              labels: labelChart,
                              datasets: [{
                                  label: 'Top views',
                                  data: countUser,
                                  backgroundColor: [
                                      'rgba(255, 99, 132, 0.2)',
                                      'rgba(255, 159, 64, 0.2)',
                                      'rgba(255, 205, 86, 0.2)',
                                      'rgba(75, 192, 192, 0.2)',
                                      'rgba(54, 162, 235, 0.2)',
                                      'rgba(153, 102, 255, 0.2)',
                                      'rgba(201, 203, 207, 0.2)'
                                  ],
                                  borderColor: [
                                      'rgb(255, 99, 132)',
                                      'rgb(255, 159, 64)',
                                      'rgb(255, 205, 86)',
                                      'rgb(75, 192, 192)',
                                      'rgb(54, 162, 235)',
                                      'rgb(153, 102, 255)',
                                      'rgb(201, 203, 207)'
                                  ],
                                  borderWidth: 1
                              }]
                          },
                          options: {
                              scales: {
                                  x: {
                                      display: false,
                                  },
                                  y: {
                                      beginAtZero: true
                                  }
                              }
                          }
                      });
                  });
              </script>
              <!-- End Bar CHart -->

            </div>
          </div>
        </div>

            {{-- <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Research added by Month</h5>
    
                  <!-- Line Chart -->
                  <canvas id="researchByMonth" style="max-height: 300px;"></canvas>
                  <script>
                    var month_chart = JSON.parse('<?php echo json_encode($month_chart); ?>');
                    var count_research = JSON.parse('<?php echo json_encode($count_myresearch); ?>');
                    document.addEventListener("DOMContentLoaded", () => {
                      new Chart(document.querySelector('#researchByMonth'), {
                        type: 'line',
                        data: {
                          labels: month_chart,
                          datasets: [{
                            label: 'No. Research',
                            data: count_research,
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                          }]
                        },
                        options: {
                          scales: {
                            y: {
                              beginAtZero: true
                            }
                          }
                        }
                      });
                    });
                  </script>
                  <!-- End Line CHart -->
    
                </div>
              </div>
            </div> --}}
            @if(auth()->user()->role === 'user')
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
            <h5 class="card-title">PalSU Colleges</h5>
            <div class="d-flex justify-content-center align-items-center"> <!-- Center the image and text -->
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="max-width: 400px;"> <!-- Set max-width for the carousel -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/ceat2.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/cs2.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span aria-hidden="true"><i class="bi bi-caret-left-fill" style="color:#F58216; font-size: 2rem;"></i></span>
                <span class="visually-hidden">Previous</span>
            </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span aria-hidden="true"><i class="bi bi-caret-right-fill" style="color:#F58216; font-size: 2rem;"></i></span>
                        <span class="visually-hidden">Next</span>
                    </button>
        </div>
    </div>
</div>
@endif
@if(auth()->user()->role === 'user')
<div class="col-lg-6">
              <div class="card">
                <div class="card-body">
            <h5 class="card-title">PalSU Courses</h5>
            <div class="d-flex justify-content-center align-items-center">
                <div id="carouselExampleControls2" class="carousel slide" data-bs-ride="carousel" style="max-width: 400px;"> <!-- Set max-width for the carousel -->
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/pe.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/me.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/ce.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/arki.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/ee.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/site.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/acs.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/essa.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/yba.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/mbs.png') }}" class="d-block mx-auto" alt="..." style="max-width: 200px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="prev">
                <span aria-hidden="true"><i class="bi bi-caret-left-fill" style="color:#F58216; font-size: 2rem;"></i></span>
                <span class="visually-hidden">Previous</span>
            </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="next">
                        <span aria-hidden="true"><i class="bi bi-caret-right-fill" style="color:#F58216; font-size: 2rem;"></i></span>
                        <span class="visually-hidden">Next</span>
                    </button>
        </div>
    </div>
</div>
@endif
<!-- Pie Chart -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Number of Theses by Program</h5>
    <!-- Pie Chart -->
    <div id="pieChart" style="min-height: 350px;" class="echart"></div>
    @if(auth()->user()->role === 'admin')
      <div class="d-flex justify-content-center">
          {{-- <a class="btn btn-success btn-sm" style="margin-right: 5px;" href="{{ route('generate.Piepdf.report') }}" target="_blank"><i class="bi bi-printer"></i> Generate report</a> --}}
          <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#generateByDateProgram"><i class="bi bi-calendar-check"></i> Generate Report</button>
      </div>
  @endif

    <script>
        document.addEventListener("DOMContentLoaded", () => {
          const label_program = JSON.parse('<?php echo json_encode($label_program); ?>');
          const count_research = JSON.parse('<?php echo json_encode($count_research); ?>');
          echarts.init(document.querySelector("#pieChart")).setOption({
            tooltip: {
              trigger: 'item'
            },
            legend: {
              orient: 'horizontal',
              left: 'left',
              itemWidth: 5,  
              itemHeight: 5
          },
            series: [{
              name: 'Program',
              type: 'pie',
              radius: '50%',
              data: count_research.map((count, index) => ({
                value: count,
                name: label_program[index],
                emphasis: {
                  itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)',
                  }
                }
              }))
            }]
          });
        });
      </script>
   

  </div>
</div>
<!-- End Pie Chart -->
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">
            <div class="filter">
            </div>

            <div class="card-body">
              <h5 class="card-title">Recently Added <span>| Today</span></h5>

              <div class="activity">
              @php
                    $colors = ['text-success', 'text-danger', 'text-primary', 'text-info', 'text-warning', 'text-muted'];
              @endphp
                @for ($i = 0; $i < count($files); $i++)
                    <div class="activity-item d-flex">
                        <div class="activite-label">{{ $files[$i]->formattedTimeDifference }}</div>
                        <i class='bi bi-circle-fill activity-badge {{ $colors[$i % count($colors)] }} align-self-start'></i>
                        <div class="activity-content">
                            <a href="{{ route('get.view', ['filename' => $files[$i]->filename]) }}" class="fw-bold text-dark">{{ pathinfo($files[$i]->filename, PATHINFO_FILENAME) }}</a>
                        </div>
                        
                    </div>
                @endfor

              </div>
            </div>
          </div><!-- End Recent Activity -->
          
          <!-- Website Traffic -->
          <div class="card">
            <div class="filter">
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Number of Theses by College <span>| Present</span></h5>
              <div id="trafficChart" style="min-height: 560px;" class="echart"></div>
              @if(auth()->user()->role === 'admin')
                <div class="d-flex justify-content-center">
                    {{-- <a class="btn btn-success btn-sm" style="margin-right: 5px;"  href="{{ route('generate.pdf.report') }}" target="_blank"><i class="bi bi-printer"></i> Generate report</a> --}}
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#generateByDateCollege"><i class="bi bi-calendar-check"></i> Generate Report</button>
                </div>
            @endif
              <h5 class="card-title"></h5>
            </div>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
              const labMyChart  = JSON.parse('<?php echo json_encode($lab_mychart); ?>');
              const countMyCollege = JSON.parse('<?php echo json_encode($count_mycollege); ?>');
              const chart = echarts.init(document.querySelector("#trafficChart"));
              const customColors = ['rgba(255, 99, 132, 0.2)', '#3BB143'];

                chart.setOption({
                    tooltip: {
                        trigger: 'item'
                    },
                    legend: {
                        top: '5%',
                        left: 'center'
                    },
                    series: [{
                        name: 'College',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '18',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: countMyCollege.map((count, index) => ({
                            value: count,
                            name: labMyChart[index],
                            itemStyle: {
                          color: labMyChart[index] === 'CEAT' ? 'rgba(255, 99, 132, 0.2)' : labMyChart[index] === 'CS' ? 'rgba(75, 192, 192, 0.2)' : customColors[index % customColors.length],
                          borderColor: labMyChart[index] === 'CEAT' ? 'rgba(255, 99, 132, 1)' : labMyChart[index] === 'CS' ? 'rgb(75, 192, 192)' : customBorderColor,
                          borderWidth: 1, 
                        }
                        }))
                    }]
                });
            });
        </script>
        {{-- Generate By date Modal --}}
        <div class="modal fade" id="generateByDateCollege" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered  modal-m">
            <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title"><i class="bi bi-printer"></i> Generate By Date College</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form method="GET" action="{{ route('collegeReportDate') }}" enctype="multipart/form-data" class="row g-3 needs-validation">
              <div class="col-6">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
                <div class="col-6">
                  <label for="end_date">End Date</label>
                  <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>
              <div class="d-grid gap-2">
              <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="bi bi-printer"></i> Create Report</button>
              </div>
              </div>
              </form>
            </div>
          </div>
        </div>
            </div>
          </div><!-- End Website Traffic -->

          {{-- Generate By date Program --}}
          <div class="modal fade" id="generateByDateProgram" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered  modal-m">
              <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-printer"></i> Generate By Date Program</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="GET" action="{{ route('programReportDate') }}" enctype="multipart/form-data" class="row g-3 needs-validation">
                <div class="col-6">
                  <label for="start_date">Start Date</label>
                  <input type="date" id="start_date" name="start_date" class="form-control" required>
                  </div>
                  <div class="col-6">
                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                  </div>
                <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="bi bi-printer"></i> Create Report</button>
                </div>
                </div>
                </form>
              </div>
            </div>
          </div>

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->
  <div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sean Harvey, Orga</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Pwede po ba ma'am pa approve?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div><!-- End Vertically centered Modal-->
  <div class="modal fade" id="verticalycentered2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Maurene, Llado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Pa approve po ma'am need po for research! Thank you po</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div><!-- End Vertically centered Modal-->
  <div class="modal fade" id="verticalycentered3" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Dorero, Charles Jazon</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Pa approved po admin for further research development</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div><!-- End Vertically centered Modal-->


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>PSU Library</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
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

</body>

</html>