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
            <p class="title"><a href ="https://psuthesesvault.online"><img src="{{asset('img/tvlogo.png')}}" alt="" width="250" style="margin-right: 15px;"></a></p>
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
          <div style="text-align: center;">
            <select style=" border-radius: 23px; border: 1px solid #c0c0c0; outline: 0 !important; box-sizing: border-box; padding: 12px 15px;" class="form-select input" id="campusSelect" onchange="handleCampusChange(this)">
                <option value="main">Main Campus</option>
                <option value="ccrd">CCRD Campus</option>
            </select>
        </div>
        
        <div id="collegeSelect">
            <select style=" border-radius: 23px; border: 1px solid #c0c0c0; outline: 0 !important; box-sizing: border-box; padding: 12px 15px;" class="form-select input" id="college" name="college" aria-label=".form-select-sm example" value="{{ old('college') }}" required>
                <option disabled selected>Choose College</option>
                <option value="130">CEAT</option>
                <option value="131">CS</option>
                <option value="132">CBA</option>
                <option value="133">CNHS</option>
                <option value="134">CTE</option>
                <option value="135">CCJE</option>
                <option value="136">CHTM</option>
                <option value="137">CAH</option>
            </select>
        </div>
        
        <div id="ccrdSelect" style="display: none;">
            <select  style=" border-radius: 23px; border: 1px solid #c0c0c0; outline: 0 !important; box-sizing: border-box; padding: 12px 15px;" class="form-select input" id="ccrdCollege" name="college" aria-label=".form-select-sm example" value="{{ old('ccrdCollege') }}" required>
                <option disabled selected>Choose CCRD Campus</option>
                <option value="138">Araceli Campus</option>
                <option value="139">Balabac Campus</option>
                <option value="140">Bataraza Campus</option>
                <option value="141">Brooke's Point Campus</option>
                <option value="142">Coron Campus</option>
                <option value="143">PCAT Cuyo Campus</option>
                <option value="144">Dumaran Campus</option>
                <option value="145">El Nido Campus</option>
                <option value="146">Linapacan Campus</option>
                <option value="147">Narra Campus</option>
                <option value="148">Quezon Campus</option>
                <option value="149">Rizal Campus</option>
                <option value="150">Roxas Campus</option>
                <option value="151">San Rafael Campus</option>
                <option value="152">San Vicente Campus</option>
                <option value="153">Sofronio Española Campus</option>
                <option value="154">Taytay Campus</option>
            </select>
        </div>
        
        <div class="fixed-mtop-alert">
            @if ($errors->has('college'))
                <div class="login-alert alert-danger alert-dismissible fade show falling-alert" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ $errors->first('college') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        
        <select style=" border-radius: 23px; border: 1px solid #c0c0c0; outline: 0 !important; box-sizing: border-box; padding: 12px 15px;" class="form-select input" id="Program" name="program" aria-label=".form-select-sm example" value="{{ old('program') }}" required>
            <option disabled selected>Choose Program</option>
        </select>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function handleCampusChange(select) {
                var selectedCampus = select.value;
                if (selectedCampus === 'main') {
                    $('#collegeSelect').show();
                    $('#ccrdSelect').hide();
                } else if (selectedCampus === 'ccrd') {
                    $('#collegeSelect').hide();
                    $('#ccrdSelect').show();
                }
            }
        
            $(document).ready(function() {
                $('#college').change(function() {
                    var selectedCollege = $(this).val();
                    var programSelect = $('#Program');
                    programSelect.find('option').not(':first').remove();
                    if (selectedCollege === '131') {
                        addProgramOptions(programSelect, [
                            "BS Information Technology",
                            "BS Computer Science",
                            "BS Medical Biology",
                            "BS Environmental Science",
                            "BS Marine Biology"
                        ]);
                    }else if (selectedCollege === '130') {
                          addProgramOptions(programSelect, [
                              "BS Civil Engineering",
                              "BS Mechanical Engineering",
                              "BS Petroleum Engineering",
                              "BS Electrical Engineering",
                              "BS Architecture"
                          ]);
                      } else if (selectedCollege === '132') {
                          addProgramOptions(programSelect, [
                              "BS Accountancy",
                              "BS Business Administration",
                              "BS Entrepreneurship",
                              "BS Management Accounting",
                              "BS Public Administration"
                          ]);
                      } else if (selectedCollege === '133') {
                          addProgramOptions(programSelect, [
                              "BS Nursing",
                              "Diploma in Midwifery"
                          ]);
                      } else if (selectedCollege === '134') {
                          addProgramOptions(programSelect, [
                              "B Elementary Education",
                              "B Physical Education",
                              "B Secondary Education",
                          ]);
                      }
                      else if (selectedCollege === '135') {
                          addProgramOptions(programSelect, [
                              "BS Criminology"
                          ]);
                      } else if (selectedCollege === '136') {
                          addProgramOptions(programSelect, [
                              "BS Hospitality Management",
                              "BS Tourism Management",
                          ]);
                      } else if (selectedCollege === '137') {
                          addProgramOptions(programSelect, [
                              "BA Communication",
                              "BA Philippine Studies",
                              "BA Political Science",
                              "BS Psychology",
                              "BS Social Work",
                          ]);
                      }
                    
                });
        
                $('#ccrdCollege').change(function() {
                    var selectedCcrdCollege = $(this).val();
                    var programSelect = $('#Program');
                    programSelect.find('option').not(':first').remove();
                    if (selectedCcrdCollege === '138') {
                        addProgramOptions(programSelect, [
                            "BS Business Administration",
                            "BS Entrepreneurship"

                        ]);
                    } else if (selectedCcrdCollege === '139') {
                        addProgramOptions(programSelect, [
                            "BS Agriculture",
                            "BS Entrepreneurship",
                            "B Elementary Education"
                        ]);
                    } else if (selectedCcrdCollege === '140') {
                        addProgramOptions(programSelect, [
                            "BS Business Administration",
                            "BS Agriculture",
                            "BS Entrepreneurship",
                            "BS Information Technology",
                            "B Elementary Education"
                           
                        ]);
                    } else if (selectedCcrdCollege === '141') {
                        addProgramOptions(programSelect, [
                            "B Secondary Education",
                            "BS Businiess Administration",
                            "BS Entrepreneurship",
                            "BS Agriculture",
                            "B Elementary Education"
                           
                        ]);
                    } else if (selectedCcrdCollege === '142') {
                        addProgramOptions(programSelect, [
                            "BS Criminology",
                            "BS Business Administration",
                            "BS Hospitality Management",
                            "BS Tourism Management",
                            "B Elementary Education",
                            "B Secondary Education"
                           
                        ]);
                    } else if (selectedCcrdCollege === '143') {
                        addProgramOptions(programSelect, [
                            "BA Political Science",
                            "B Industial Technology",
                            "BS Criminology",
                            "BS Business Administration",
                            "BS Entrepreneurship",
                            "BS Hospitality Management",
                            "BS Tourism Management",
                            "B Elementary Education",
                            "B Secondary Education",
                            "BT Vocational Teacher Education"
                           
                        ]);
                    }  else if (selectedCcrdCollege === '144') {
                        addProgramOptions(programSelect, [
                            "BS Agriculture",
                            "BS Entrepreneurship"
                           
                        ]);
                    } else if (selectedCcrdCollege === '145') {
                        addProgramOptions(programSelect, [
                            "BS Criminology",
                            "BS Entrepreneurship",
                            "BS Hospitality Management",
                            "BS Tourism Management"
                           
                        ]);
                    } else if (selectedCcrdCollege === '146') {
                        addProgramOptions(programSelect, [
                            "BS Tourism Management",
                            "BS Fisheries"
                           
                        ]);
                    } else if (selectedCcrdCollege === '147') {
                        addProgramOptions(programSelect, [
                            "BA Political Science",
                            "BS Criminology",
                            "BS Business Administration",
                            "BS Entrepreneurship",
                            "BS Hospitality Management",
                            "BS Tourism Management",
                            "B Elementary Education",
                            "BS Agriculture",
                            "BS Computer Science "
                           
                        ]);
                    } else if (selectedCcrdCollege === '148') {
                        addProgramOptions(programSelect, [
                            "BS Business Administration",
                            "BS Entrepreneurship",
                            "BS Hospitality Management",
                            "BS Tourism Management",
                            "BS Agriculture",
                            "BS Information Technology",
                            "B Elementary Education",
                            "B Secondary Education"
                        ]);
                    } else if (selectedCcrdCollege === '149') {
                        addProgramOptions(programSelect, [
                            "BS Agriculture",
                            "BS Computer Science",
                            "BS Entrepreneurship",
                            "BS Environmental Science"
                        ]);
                    } else if (selectedCcrdCollege === '150') {
                        addProgramOptions(programSelect, [
                            "B Elementary Education",
                            "B Secondary Education",
                            "BS Business Administration",
                            "BS Criminology",
                            "BS Hospitality Management"
                        ]);
                    } else if (selectedCcrdCollege === '151') {
                        addProgramOptions(programSelect, [
                            "B Elementary Education",
                            "BS Agriculture",
                            "BS Entrepreneurship",
                            "BS Hospitality Management"
                        ]);
                    } 
                    else if (selectedCcrdCollege === '152') {
                        addProgramOptions(programSelect, [
                            "BA Political Science",
                            "BS Computer Science",
                            "BS Entrepreneurship",
                            "BS Environmental Science",
                            "BS Tourism Management"
                        ]);
                    } else if (selectedCcrdCollege === '153') {
                        addProgramOptions(programSelect, [
                            "B Elementary Education",
                            "B Secondary Education",
                            "BS Business Administration",
                            "BS Entrepreneurship",
                            "BS Agriculture"
                        ]);
                    } else if (selectedCcrdCollege === '154') {
                        addProgramOptions(programSelect, [
                            "BS Business Administration",
                            "BS Hospitality Management",
                            "BS Information Technology"
                        ]);
                    }

                });
        
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
                  <span style="margin-left: 5px;"><span>I agree to </span><a href="#" id="termsLink">Terms and Conditions</a></span>
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
                
                function enableCheckboxAndCheck() {
                    checkbox.checked = true;
                    checkbox.disabled = false;
                }
                
                termsLink.addEventListener('click', (event) => {
                    event.preventDefault();
                    showModal();
                });
                
                confirmAgreeBtn.addEventListener('click', () => {
                    enableCheckboxAndCheck();
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