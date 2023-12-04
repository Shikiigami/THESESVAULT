 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

    <!-- Favicons -->
  <link href="{{ asset ('img/rchive.png') }}" rel="icon">
  <link href="{{ asset ('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link href="{{ asset('css/auth.css') }}"  rel="stylesheet">
  <link href="{{ asset('css/newlogin.css') }}"  rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>
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
              <p class="title"><img src="{{asset('img/thesesvault.png')}}" alt="" width="200"></p>
              <form class="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
               @csrf
               <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="ex. Lastname, Firstname MI" required autocomplete="name" autofocus>
               <div class="fixed-mtop-alert">
                @error('name')
                    <div class="login-alert alert-danger alert-dismissible fade show falling-alert" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                     {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </div>
            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Psu Corporate Email">
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
          <select class="input" id="college" name="college" aria-label=".form-select-sm example" value="{{ old('college') }}" required>
            <option disabled selected>Choose College</option>
            <option value="130">CEAT</option>
            <option value="131">CS</option>
        </select>
        <div class="fixed-mtop-alert">
            @if ($errors->has('college'))
                <div class="login-alert alert-danger alert-dismissible fade show falling-alert" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ $errors->first('college') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            </div>
            <select class="input" id="Program" name="program" aria-label=".form-select-sm example" value="{{ old('program') }}" required>
              <option disabled selected>Choose Program</option>
          </select>
          
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script>
              $(document).ready(function() {
                  $('#college').change(function() {
                      var selectedCollege = $(this).val();
                      var programSelect = $('#Program');
          
                      // Remove all options first except the default option
                      programSelect.find('option').not(':first').remove();
          
                      // Add options based on the selected college
                      if (selectedCollege === '131') {
                          // College 131 - Add BS Information Technology to BS Marine Biology
                          addProgramOptions(programSelect, [
                              "BS Information Technology",
                              "BS Computer Science",
                              "BS Medical Biology",
                              "BS Environmental Science",
                              "BS Marine Biology"
                          ]);
                      } else if (selectedCollege === '130') {
                          // College 130 - Add BS Civil Engineering to BS Architecture
                          addProgramOptions(programSelect, [
                              "BS Civil Engineering",
                              "BS Mechanical Engineering",
                              "BS Petroleum Engineering",
                              "BS Electrical Engineering",
                              "BS Architecture"
                          ]);
                      }
                  });
          
                  // Function to add options to the program select
                  function addProgramOptions(selectElement, programs) {
                      programs.forEach(function(program) {
                          selectElement.append($('<option>', {
                              value: program,
                              text: program
                          }));
                      });
                  }
              });
          </script>
          <div class="fixed-mtop-alert">
          @if ($errors->has('program'))
              <div class="login-alert alert-danger alert-dismissible fade show falling-alert" role="alert">
              <i class="bi bi-check-circle me-1"></i>
              {{ $errors->first('program') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          </div>  
            <div class="input-container">
            <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
            <i class="far fa-eye toggle-password" id="togglePassword" style="margin-right: 10px; cursor: pointer;" ></i>
            </div>
            <div class="fixed-mtop-alert">
                  @error('password')
                      <div class="login-alert alert-danger alert-dismissible fade show falling-alert" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      {{$message}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </div>
              <div class="input-container">
               <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __(' Confirm Password') }}">
               <i class="far fa-eye toggle-password" id="togglePasswordConfirm" style="margin-right: 10px; cursor: pointer;" ></i>
              </div>

              <div id="myModal" class="modal">
                <div class="modal-content" style="max-height: 400px; overflow: auto;text-align: justify;">
                  <span class="close">&times;</span>
                  <h2>ThesesVault Terms and Conditions</h2>
                  <ol>
                    <li><strong>Acceptance of Terms:</strong> By accessing or using ThesesVault, you agree to be bound by these Terms and Conditions. If you do not agree with any part of these terms, you may not use ThesesVault.</li>
                    <li><strong>Compliance with Laws:</strong> Users of ThesesVault must comply with the Data Privacy Act of 2012 and Republic Act No. 8293 or the Intellectual Property Code of the Philippines. Any violation of these laws may result in the termination of your ThesesVault account and legal consequences.</li>
                    <li><strong>Data Privacy:</strong> ThesesVault is committed to protecting your privacy. All personal information provided or collected through ThesesVault will be handled in accordance with the Data Privacy Act of 2012. For more details, please refer to our Privacy Policy.</li>
                    <li><strong>Intellectual Property:</strong> All content and materials available on ThesesVault, including but not limited to text, graphics, logos, images, and software, are the intellectual property of the respective authors, researchers, and Palawan State University. Users agree not to reproduce, distribute, modify, or create derivative works from any material found on ThesesVault without explicit permission from the intellectual property owners.</li>
                    <li><strong>User Conduct:</strong> Users agree not to engage in any activities that may compromise the security or integrity of ThesesVault. This includes but is not limited to unauthorized access, interference with the functioning of the platform, or any action that violates applicable laws.</li>
                    <li><strong>Security Measures:</strong> ThesesVault employs security measures to protect user data. Users agree not to circumvent or attempt to circumvent these security features.</li>
                    <li><strong>Termination:</strong> ThesesVault reserves the right to terminate or suspend access to the platform at its discretion, especially in cases of non-compliance with these Terms and Conditions or applicable laws.</li>
                    <li><strong>Modifications to Terms:</strong> ThesesVault may revise these Terms and Conditions at any time without notice. By continuing to use ThesesVault after any modifications, users agree to be bound by the revised terms.</li>
                    <li><strong>Governing Law:</strong> These Terms and Conditions are governed by and construed in accordance with the laws of the Philippines.</li>
                    <li><strong>Contact Information: </strong> For any questions or concerns regarding these Terms and Conditions, please contact us at thesesvault@gmail.com By using ThesesVault, you acknowledge that you have read, understood, and agreed to these Terms and Conditions.</li>
                  </ol>
                  <h2>Privacy Policy</h2>
                  <ul style="list-style-type: none;">
                    <li><strong>1.</strong> This Privacy Policy outlines how we collect, use, disclose, and protect your personal information. By using ThesesVault, you agree to the terms outlined in this policy.</li>
                    <li><strong>2. Information We Collect</strong></li>
                    <li><strong>2.1 User-Provided Information: </strong> We collect the following personal data during the account registration process: Name, Email Address, College and Program</li>
                    <li><strong>2.2 Automatically Collected Information: </strong> Automatically Collected Information: We may automatically collect certain information, including your IP address, device information, and usage patterns, to enhance the functionality and security of ThesesVault.</li>
                    <li><strong>3. Use of Information:</strong> </li>
                    <li><strong>3.1 Personalization:</strong> Your information is used to personalize your ThesesVault experience, providing relevant content and features tailored to your university and academic program.</li>
                    <li><strong>3.2 Communication:</strong> e may use your email address to send important updates, announcements, and information related to ThesesVault.</li>
                    <li><strong>4. Data Security</strong></li>
                    <li><strong>4.1 Security Measures: </strong> ThesesVault employs the following measures to protect your personal information:
                    <br>-Encryption: Data transmitted between your device and ThesesVault is encrypted to ensure secure communication. <br>
                    - Access Controls: Access to user data is restricted to authorized personnel only. <br>
                    - Regular Audits: We conduct regular audits to identify and address potential security vulnerabilities.
                    </li>
                    <li><strong>5. Information Sharing</strong> </li>
                    <li><strong>5.1 Third-Party Services:</strong> ThesesVault may use third-party services to enhance functionality, and these services may have their privacy policies. We encourage you to review them.</li>
                    <li><strong>5.2 Legal Compliance: </strong> We may disclose your information to comply with legal obligations or respond to lawful requests from authorities.</li>
                    <li><strong>6. User Controls</strong> </li>
                    <li><strong>6.1 Account Settings: </strong>You can review and update your account information, including personal and university data, through ThesesVault's account settings.</li>
                    <li><strong>6.2 Communication Preferences: </strong> You can choose to receive or opt out of certain communications from ThesesVault.</li>
                    <li><strong>7. Changes to Privacy Policy: </strong> We may update this Privacy Policy to reflect changes in our practices. Please review the policy periodically for any updates.</li>
                    <li><strong>8. Contact Information</strong> For questions or concerns regarding this Privacy Policy, please contact us at thesesvault@gmail.com.</li>
                    <li><strong>By using ThesesVault, you acknowledge that you have read, understood, and agreed to this detailed Privacy Policy.</strong> </li>
                  </ul>
                  <button class="btn btn-primary" id="confirmAgreeBtn">Agree</button>
                </div>
              </div>
              
              <p class="page-link">
                <input class="page-link-label" style="float: left; margin-top: 9px;" type="checkbox" value="" id="invalidCheck2" required>
                <label style="float: left; margin-top: 9px;"  class="page-link-label" for="invalidCheck2">
                  <span style="margin-left: 5px;"><a href="#" id="termsLink">Agree to terms and conditions</a></span>
                </label>
              </p>
         <script>
          
                const modal = document.getElementById('myModal');
                const checkbox = document.getElementById('invalidCheck2');
                const termsLink = document.getElementById('termsLink');
                const confirmAgreeBtn = document.getElementById('confirmAgreeBtn');
                const closeButton = document.querySelector('.close'); // Get the close button

        
                function showModal() {
                  modal.style.display = 'block';
                }
                function hideModal() {
                  modal.style.display = 'none';
                }
                termsLink.addEventListener('click', (event) => {
                  event.preventDefault();
                  showModal();
                });

                confirmAgreeBtn.addEventListener('click', () => {
                  checkbox.checked = true;
                  hideModal(); 
                });

                closeButton.addEventListener('click', hideModal);

         </script>
                <button type="submit" class="form-btn">{{ __('Register') }}</button>
                
              </form>
              <p class="sign-up-label">
                Don't have an account?<a class="sign-up-link" style="text-decoration: none; color: rgb(64, 105, 227)" href="{{ route('login') }}"> <span>Login here</span></a>
              </p>
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

    <script>
      const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
      const passwordConfirm = document.querySelector('#password-confirm');

      togglePasswordConfirm.addEventListener('click', function (e) {
          const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordConfirm.setAttribute('type', type);
          this.classList.toggle('fa-eye-slash');
      });
    </script>
          

</body>
</html>
