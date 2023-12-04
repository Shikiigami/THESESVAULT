<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{ asset ('img/rchive.png') }}" rel="icon">
    <link href="{{ asset ('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

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


    <title>PalSu ThesesVault</title>
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-lava.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">


</head>

<body>  

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{route('landingPage')}}" class="logo">
                            <img src="{{ asset('img/thesesvault.png') }}" alt="logo" height="50">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#welcome" class="menu-item">Home</a></li>
                            <li class="scroll-to-section"><a href="#developers" class="menu-item">About</a></li>
                            <li class="scroll-to-section"><a href="#contact-us" style="background-color: transparent;">Contact Us</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-text col-lg-6 col-md-12 col-sm-12 col-xs-12"
                        data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <h1>Unlock a world full of knowledge with <em>THESESVAULT</em></h1>
                        <p>Dive into a treasure trove of Palawan State University's very own Theses and Dissertations Digital Repository.
                            Discover the knowledge you need to excel in your studies and research projects. <br></p> 
                            <a href="#needhelp"  class="main-button-slider" style="margin-right: 20px;">CLICK ME! FOR GUIDE</a><span> <a href="{{route('login')}}"  class="main-button-slider">GET STARTED</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <!-- ***** Welcome Area End ***** -->
    <section class="section" id="videoTextGuide">
        <div class="col-lg-8 offset-lg-2">
            <div class="center-heading">
                <h2>System Navigation<em> Guide</em></h2>
            </div>
        </div>
</section>
    <section class="section" id="needhelp">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-lg-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <div class="features-item">
                        <div class="features-icon">
                            <div class="video-wrapper">
                                <iframe width="1536" height="864" src="https://www.youtube.com/embed/D_ihJvYC844" title="System Navigation Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
    <section class="section" id="developers">
        <section class="section" id="developer">
            <div class="col-lg-8 offset-lg-2">
                <div class="center-heading">
                    <h2>System<em> Developers</em></h2>
                </div>
            </div>
    </section>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <div class="features-item">
                        <div class="features-icon">
                            <h2>IT</h2>
                            <img src="{{ asset('img/mau.png') }}" alt="">
                            <h4>Maurene Llado</h4>
                            <h5>System Developer</h5>
                            <p>Fourth year student taking Bachelor of Science in Information Technology in Palawan State University</p>
                            <a href="#reviews" class="main-button">
                                Visit Me
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter bottom move 30px over 0.6s after 0.4s">
                    <div class="features-item">
                        <div class="features-icon">
                            <h2>IT</h2>
                            <img src="{{asset('img/ingrid.png')}}" alt="">
                            <h4>Ingrid Calma</h4>
                            <h5>System Analyst</h5>
                            <p>Fourth year student taking Bachelor of Science in Information Technology in Palawan State University</p>
                            <a href="#reviews" class="main-button">
                               Visit Me
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter bottom move 30px over 0.6s after 0.4s">
                    <div class="features-item">
                        <div class="features-icon">
                            <h2>IT</h2>
                            <img src="{{asset('img/jiezca.png')}}" alt="">
                            <h4>Jiezca Casayas</h4>
                            <h5>Frontend Developer</h5>
                            <p>Fourth year student taking Bachelor of Science in Information Technology in Palawan State University</p>
                            <a href="#reviews" class="main-button">
                                Visit Me
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12"
                data-scroll-reveal="enter bottom move 30px over 0.6s after 0.4s">
                <div class="features-item">
                    <div class="features-icon">
                        <h2>IT</h2>
                        <img src="{{asset('img/sean.png')}}" alt="">
                        <h4>Sean Harvey Orga</h4>
                        <h5>Frontend Developer</h5>
                        <p>Fourth year student taking Bachelor of Science in Information Technology in Palawan State University</p>
                        <a href="#reviews" class="main-button">
                           Visit Me
                        </a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <div class="left-image-decor"></div>

    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="promotion">
        <div class="container">
            <div class="row">
                <div class="left-image col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix-big"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="{{ asset('img/systembackgroud.png') }}" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="right-text offset-lg-1 col-lg-6 col-md-12 col-sm-12 mobile-bottom-fix">
                    <ul>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                            <img src="{{ asset('img/about-icon-01.png') }}" alt="">
                            <div class="text">
                                <h4>ThesesVault as Document Repository</h4>
                                <p>ThesesVault could serve as a digital repository for storing and organizing academic theses, dissertations. </p>
                            </div>
                        </li>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.5s">
                            <img src="{{ asset('img/about-icon-02.png') }}" alt="">
                            <div class="text">
                                <h4>ThesesVault as Access and Search</h4>
                                <p>You can <a rel="nofollow"
                                        href=""></a> Providing access to a wide range of theses, enabling researchers, students, and academics to search.</p>
                            </div>
                        </li>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.6s">
                            <img src="{{ asset('img/about-icon-03.png') }}" alt="">
                            <div class="text">
                                <h4>Knowledge Sharing</h4>
                                <p>Sharing of academic knowledge and research findings by making theses available to a broader audience,
                                    </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <div class="right-image-decor"></div>


    <!-- ***** Footer Start ***** -->
    <footer id="contact-us">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <!-- ***** Contact Form Start ***** -->
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="contact-form">
                            <form id="contact" action="" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <fieldset>
                                            <input name="name" type="text" id="name" placeholder="Full Name" required=""
                                                style="background-color: rgba(250,250,250,0.3);">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <fieldset>
                                            <input name="email" type="text" id="email" placeholder="E-Mail Address"
                                                required="" style="background-color: rgba(250,250,250,0.3);">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <textarea name="message" rows="6" id="message" placeholder="Your Message"
                                                required="" style="background-color: rgba(250,250,250,0.3);"></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="main-button">Send Message
                                                Now</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- ***** Contact Form End ***** -->
                    <div class="right-content col-lg-6 col-md-12 col-sm-12">
                        <h2>More About <em>ThesesVault</em></h2>
                        <p style="text-align: justify">At ThesesVault, we're dedicated to being the cornerstone of your academic journey. We believe that every idea, every thesis, 
                            holds the potential to shape the future. Our platform isn't just about housing research; it's a sanctuary where innovation meets dedication. 
                            We empower scholars to transcend boundaries, fostering an environment where knowledge thrives and ideas flourish. 
                            <br><br>If you need this contact form to send email to your inbox, you may follow our <a
                                rel="nofollow" href="" target="_parent">contact</a> page
                            for more detail.</p>
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-footer">
                        <p>&copy; Copyright <strong><span>PSU Library</span></strong>. All Rights Reserved

                        | Designed by <a href="http://psulibrary.palawan.edu.ph/home/">Palawan State University</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

   <!-- jQuery -->
<script src="{{ asset('js/jquery-2.1.0.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('js/owl-carousel.js') }}"></script>
<script src="{{ asset('js/scrollreveal.min.js') }}"></script>
<script src="{{ asset('js/waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('js/imgfix.min.js') }}"></script>

<!-- Global Init -->
<script src="{{ asset('js/custom.js') }}"></script>

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
<!-- Your HTML -->

</body>
</html>