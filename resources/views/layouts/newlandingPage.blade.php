<!DOCTYPE html>
 <html lang="en">
<head>
    <link href="{{ asset ('img/rchive.png') }}" rel="icon">
    <link href="{{ asset ('img/apple-touch-icon.png') }}" rel="apple-touch-icon"> 
	<meta charset="utf-8">
	<title>PalSu ThesesVault</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" media="all" href="{{asset('css/landing_style.css')}}">
</head>
<body>
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
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

	<header id="header">
		<div class="container">
			<a href="{{route('landingPage')}}" id="logo" title="PalSulibrary">PalSu ThesesVault</a>
			<div class="menu-trigger"></div>
			<div class="logo-con" style="position: relative;">
				<a href="{{route('landingPage')}}"><img src="{{asset('img/nba_logo.png')}}" alt="" width="200" style="position: absolute; top: -20px; left: -120px;"></a>
			  </div>
			<nav id="menu">
				<ul>
					<li><a href="#sections">Sections</a></li>
					<li><a href="#posts">About</a></li>
					<li><a href="#programs">Programs</a></li>
 				</ul>
				<ul>
					<li><a href="gallery.html">Staff</a></li>
					<li><a href="https://www.youtube.com/embed/D_ihJvYC844">System Guide</a></li>
					<li><a href="#fancy" class="get-contact">Message us</a></li>
   				</ul>
			</nav>
		</div>
	</header>
	<!-- / header -->
	
	<div class="slider">
		<ul class="bxslider">
			<li>
				<div class="container">
					<div class="info">
						<h2>Welcome to <br><span>PalSu ThesesVault</span></h2>
						<a href="{{route('role.index')}}">Check out new Theses uploaded</a>
					</div>
				</div>
				<!-- / content -->
			</li>
			<li>
				<div class="container">
					<div class="info">
						<h2>Welcome to <br><span>PalSu ThesesVault</span></h2>
						<a href="{{route('role.index')}}">Check out new Theses uploaded</a>
					</div>
				</div>
				<!-- / content -->
			</li>
			<li>
				<div class="container">
					<div class="info">
						<h2>Welcome to <br><span>PalSu ThesesVault</span></h2>
						<a href="{{route('role.index')}}">Check out new Theses uploaded</a>
					</div>
				</div>
				<!-- / content -->
			</li>
		</ul>
		<div class="bg-bottom"></div>
	</div>
	
	<section class="posts" id="posts">
		<div class="container">
			<article>
				<div class="pic"><img width="121" src="{{asset('img/orange-bg1.png')}}" alt=""></div>
				<div class="info">
					<h3>ThesesVault as Document Repository</h3>
					<p>ThesesVault could serve as a digital repository for storing and organizing academic theses, dissertations.</p>
				</div>
			</article>
			<article>
				<div class="pic"><img width="121" src="{{asset('img/orange-bg2.png')}}" alt=""></div>
				<div class="info">
					<h3>ThesesVault as Access and Search</h3>
					<p> Providing access to a wide range of theses, enabling researchers, students, and academics to search.</p>
				</div>
			</article>
			<article>
				<div class="pic"><img width="121" src="{{asset('img/orange-bg3.png')}}" alt=""></div>
				<div class="info">
					<h3>Knowledge Sharing</h3>
					<p>Sharing of academic knowledge and research findings by making theses available to a broader audience.</p>
				</div>
			</article>
			<article>
				<div class="pic"><img width="121" src="{{asset('img/orange-bg4.png')}}" alt=""></div>
				<div class="info">
					<h3>Support for Research Endeavors</h3>
					<p>ThesesVault provides invaluable support for research endeavors by offering access to a wealth of academic resources, and inform their own research projects and inquiries.</p>
				</div>
			</article>
		</div>
		<!-- / container -->
	</section>

	<section class="sections" id="sections">
		<div class="container">
			<h2>Library Sections and Rooms</h2>
			<article>
				<div class="pic"><img src="{{asset('img/special_collection_section.png')}}" alt="" ></div>
				<div class="info">
					<h4>Special Collection Section</h4>
					<p class="date">Third floor</p>
					<p> </p>
				</div>
			</article>
			<article>
				<div class="pic"><img src="{{asset('img/reference_section.png')}}" alt="" ></div>
				<div class="info">
					<h4>Reference Section</h4>
					<p class="date">Third floor</p>
					<p></p>
				</div>
			</article>
			<article>
				<div class="pic"><img src="{{asset('img/discussion_room.png')}}" alt="" ></div>
				<div class="info">
					<h4>Discussion Room</h4>
					<p class="date">Third floor</p>
					<p></p>
				</div>
			</article>
			<article>
			<div class="pic"><img src="{{asset('img/silent_room.png')}}" alt="" ></div>
				<div class="info">
					<h4>Silent Room</h4>
					<p class="date">Third floor</p>
					<p></p>
				</div>
			</article>
		</div>
		<!-- / container -->
	</section>

	<section class="programs" id="programs">
		<div class="container">
			<h2>Offer Programs</h2>
			<article>
				<div class="program-logo">
					<img src="{{asset('img/cah-prog.png')}}" alt="">
				</div>
				<div class="info">
					<p>BA Communication,<br> BA Philippine Studies,<br> BA Political Science,<br> BS Psychology,<br> BS Social Work</p>
				</div>
			</article>
			<article>
				<div class="program-logo">
					<img src="{{asset('img/ccje-prog.png')}}" alt="">
				</div>
				<div class="info">
					<p><br><br>BS Criminology. <br></p>
				</div>
			</article>
			<article>
				<div class="program-logo">
					<img src="{{asset('img/chmt-prog.png')}}" alt="">
				</div>
				<div class="info">
					<p><br>BS Hospitality Management,<br>BS Tourism Management</p>
				</div>
			</article>
			<article>
				<div class="program-logo">
					<img src="{{asset('img/cnhs-prog.png')}}" alt="">
				</div>
				<div class="info">
					<p><br>BS Nursing,<br> Diploma in Midwifery</p>
				</div>
			</article>
			<article>
				<div class="program-logo">
					<img src="{{asset('img/ceat-prog.png')}}" alt="">
				</div>
				<div class="info">
					<p>BS Civil Engineering,<br> BS Mechanical Engineering,<br> BS Petroleum Engineering, <br>BS Electrical Engineering,<br> BS Architecture</p>
				</div>
			</article>
			<article>
				<div class="program-logo">
					<img src="{{asset('img/cte-prog.png')}}" alt="">
				</div>
				<div class="info">
					<p><br>B Elementary Education,<br> B Physical Education, <br> B Secondary Education</p>
				</div>
			</article>
			<article>
				<div class="program-logo">
					<img src="{{asset('img/cs-prog.png')}}" alt="">
				</div>
				<div class="info">
					<p>BS Information Technology, <br> BS Computer Science, <br> BS Medical Biology, <br>BS Environmental Science, <br>BS Marine Biology</p>
				</div>
			</article>
			<article>
				<div class="program-logo">
					<img src="{{asset('img/cba-prog.png')}}" alt="">
				</div>
				<div class="info">
					<p>BS Accountancy,<br> BS Business Administration,<br> BS Entrepreneurship,<br> BS Management Accounting,<br> BS Public Administration</p>
				</div>
			</article>
		</div>
		<!-- / container -->
	</section>
	<br>
		<br>
			<br><br>
		<br>
			<br>
	<div class="container">
		<a href="#fancy" class="info-request">
			<span class="holder">
				<span class="title">Send Message</span>
				<span class="text">Do you have some questions? Fill the form and get an answer!</span>
			</span>
			<span class="arrow"></span>
		</a>
	</div>

	<footer id="footer">
		<div class="container">
			<section>
				<article class="col-1">
					<div class="" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
						<h3>Main Campus</h3>
							<iframe
								width="100%"
								height="190"
								frameborder="0"
								scrolling="no"
								marginheight="0"
								marginwidth="0"
								src="https://www.google.com/maps/embed/v1/place?q=Palawan+State+University&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
								allowfullscreen="">
							</iframe>
					</div>
				</article>
				<article class="col-1">
					<h3>Contact</h3>
					<ul>
						<li class="address"><a href="#">Tiniguiban Heights<br>Puerto Princesa City</a></li>
						<li class="mail"><a href="mailto:library@psu.palawan.edu.ph">library@psu.palawan.edu.ph</a></li>
						<li class="phone last"><a href="#">09508884905</a></li>
					</ul>
				</article>
				<!--<article class="col-2">-->
				<!--	<h3>Other Services</h3>-->
				<!--	<ul>-->
				<!--		<li><a href="#"></a></li>-->
				<!--		<li><a href="#">Nam libero tempore cum soluta</a></li>-->
				<!--		<li><a href="#">Totam rem aperiam eaque </a></li>-->
				<!--		<li><a href="#">Ipsa quae ab illo inventore veritatis </a></li>-->
				<!--		<li class="last"><a href="#">Architecto beatae vitae dicta sunt </a></li>-->
				<!--	</ul>-->
				<!--</article>-->
				<article class="col-3">
					<h3>Social media</h3>
					<p>Follow us on: </p>
					<ul>
						<li class="facebook"><a href="https://www.facebook.com/psulibrarypalawan">Facebook</a></li>
					</ul>
				</article>
			</section>
			<p class="copy">Copyright 2024 PalSu ThesesVault | All rights reserved.</p>
		</div>
		<!-- / container -->
	</footer>
	<!-- / footer -->

	<div id="fancy">
		<h2>Send Message</h2>
		<form  action="{{ route('landing-page.store') }}" method="POST">
		    @csrf
			<div class="left">
				<fieldset class="mail"><input name="email" placeholder="Email address..." type="email"></fieldset>
				<fieldset class="name"><input name="fullName" placeholder="Name..." type="text"></fieldset>
			</div>
			<div class="right">
				<fieldset class="question"><textarea name="content" placeholder="Question..."></textarea></fieldset>
			</div>
			<div class="btn-holder">
				<button class="btn blue" type="submit">Send request</button>
			</div>
		</form>
	</div>

	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script>window.jQuery || document.write("<script src='{{asset('js/jquery-1.11.1.min.js')}}'>\x3C/script>")</script>
	<script src="{{asset('js/landing_plugins.js')}}"></script>
	<script src="{{asset('js/landing_main.js')}}"></script>
    <script src="{{ asset('js/owl-carousel.js') }}"></script>

    
</body>
</html>
