<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

    <!-- Favicons -->
  <link href="{{ asset ('img/rchive.png') }}" rel="icon">
  <link href="{{ asset ('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link href="{{ asset ('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset ('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">


  <link href="{{ asset('css/auth.css') }}"  rel="stylesheet">
  <link href="{{ asset('css/newlogin.css') }}"  rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
        <div class="form-container">
          <p class="title"><a href ="https://psuthesesvault.online"><img src="{{asset('img/tvlogo.png')}}" alt="" width="250" style="margin-right: 15px;"></a></p>
            <form class="form" method="POST" action="{{ route('login') }}">
             @csrf
              <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
              <div class="fixed-mtop-alert">
                @error('email')
                    <div class="login-alert alert-danger alert-dismissible fade show falling-alert" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @else
                    @if(session('error'))
                        <div class="login-alert alert-danger alert-dismissible fade show falling-alert" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                @enderror
            </div>    
            <div class="input-container">
              <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
              <i class="far fa-eye toggle-password" id="togglePassword" style="margin-right: 10px; cursor: pointer;" ></i>
          </div>            
            <div class="fixed-mtop-alert">
                @error('password')
                    <div class="login-alert alert-success alert-dismissible fade show falling-alert" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </div>
              <p class="page-link">
                <input class="page-link-label" style="float: left; margin-top: 9px;" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label style="float: left; margin-top: 9px;" class="page-link-label" for="remember">{{ __('Remember Me') }}</label>
                @if (Route::has('password.request'))
               <span class="page-link-label"><a href="{{ route('password.request') }}">Forgot Password?</a></span>
                @endif
              </p>
              <button type="submit" class="form-btn">{{ __('Login') }}</button>
            </form>
            <p class="sign-up-label">
              Don't have an account?<a class="sign-up-link" style="text-decoration: none; color: rgb(64, 105, 227)" href="{{ route('register') }}"> <span>Register here</span></a>
            </p>
            <div class="buttons-container">
            <a href="{{url('google-redirect')}}">
              <div class="google-login-button">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 48 48">
                    <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                    </svg>    
                <span>Log in with Google</span>
              </div>
            </a>
            </div>
          </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        var alerts = document.querySelectorAll('.login-alert');
        alerts.forEach(function (alert) {
        alert.classList.add('fade-out-up'); 

        setTimeout(function () {
            alert.remove();
        }, 1000); 
        });
    }, 2000); 
    });
    </script>
     <script>
      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');
    
      togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
      });
    </script>  
    
    </html>
