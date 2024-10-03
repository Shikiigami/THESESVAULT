<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login As</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    
    <!-- Favicons -->
    <link href="{{ asset ('img/rchive.png') }}" rel="icon">
    <link href="{{ asset ('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

     <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/new.css') }}"  rel="stylesheet">
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            margin-bottom: 20px;
        }

        .container {
            text-align: center; /* Center align the content inside container */
        }
    </style>
</head>

<body>
  <div class="container">
    <h1 class="card-title">Login as</h1> <br>
    <div class="row justify-content-center">
        <div class="col-lg-3 col-6">
          <a href="{{route('login')}}">
            <div class="card">
                <div class="card-body text-center align-items-center">
                    <img src="{{asset('img/student.png')}}" alt=""><br> <hr>
                    <button class="card-title btn btn-success btn-sm col-lg-12">Student/Faculty</button>
                </div>
            </div>
          </a>
        </div>

        <div class="col-lg-3 col-6">
          <a href="{{route('admin.index')}}">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{asset('img/admin.png')}}" alt=""><br><hr>
                    <button class="card-title btn btn-success btn-sm col-lg-12">Admin</button>
                </div>
            </div>
          </a>
        </div>
    </div>
</div>
<script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>
</body>


</html>
