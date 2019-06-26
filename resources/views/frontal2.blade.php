<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('includes.frontal_head')
    <style>
    	.canvas-modal-label{text-align: left; float: left;}
    	/*.canvasjs-chart-tooltip{margin-bottom: 10px; text-align: center;}*/
    	.chart_container_class{background-color: #f1f1f1;}
    </style>
    <script src="{{ asset('public/js/jQuery_v3_3_1.js')}}"></script>
    <script src="{{ asset('public/js/chart.js/moment.js')}}"></script>
    <script src="{{ asset('public/js/chart.js/moment-precise-range.js')}}"></script>
    <script src="{{ asset('public/js/contextmenu/dist/jquery.contextMenu.js')}}"></script>
    <script src="{{ asset('public/js/contextmenu/dist/jquery.ui.position.min.js')}}"></script>
    <link href="{{ asset('public/js/contextmenu/dist/jquery.contextMenu.min.css') }}" rel="stylesheet">
<script>
$(document).ready(function(){
  $("#desktop").click(function(){
  	$(this).addClass('active-tab');
  	$("#mobile").removeClass('active-tab');
    $(".desktop-info").show();
	$(".Mobile-info").hide();
  });
  $("#mobile").click(function(){
    $(".desktop-info").hide();
	$(".Mobile-info").show();
	$(this).addClass('active-tab');
	$("#desktop").removeClass('active-tab');
  });
  $(".desktop-options").click(function(){
    $(".menu-desktop").slideToggle();
  });
  $(".desktop-options").click(function(){
    $(".menu-mobile").slideToggle();
  });
});
</script>
</head>
<body>
    
    @include('includes.frontal_header2')
    <div class="super_container-home">
    @yield('content')
            
    </div>
   
    <footer class="footer">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-4">

					<!-- Footer Intro -->
					<div class="footer_intro">

						<!-- Logo -->
						<div class="logo footer_logo">
							<a href="#"><img src="{{ asset('public/front/images/logo.svg') }}" alt="logo"/></a>
						</div>

						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vitae enim enim. Sed nec dignissim purus.</p>
						
						<!-- Social -->
						<div class="footer_social">
							<ul>
								<li><a href="#"><i class="fab fa-pinterest"></i></a></li>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fab fa-behance"></i></a></li>
								<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
							</ul>
						</div>
						
						<!-- Copyright -->
						<div class="footer_cr">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</div>

					</div>

				</div>
				
				<!-- Footer Services -->
				<div class="col-lg-2">

					<div class="footer_col">
						<div class="footer_col_title">Services</div>
						<ul>
							<li><a href="#">Social media</a></li>
							<li><a href="#">Management</a></li>
							<li><a href="#">Branding</a></li>
						</ul>
					</div>
					
					<div class="footer_col">
						<div class="footer_col_title">Aditionals</div>
						<ul>
							<li><a href="#">Social media</a></li>
							<li><a href="#">Management</a></li>
							<li><a href="#">Branding</a></li>
						</ul>
					</div>

				</div>

				<!-- Footer Menu -->
				<div class="col-lg-2">

					<div class="footer_col">
						<div class="footer_col_title">Menu</div>
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">About us</a></li>
							<li><a href="#">Services</a></li>
							<li><a href="#">Portfolio</a></li>
							<li><a href="#">Blog</a></li>
							<li><a href="#">Contact</a></li>
							<li><a href="#">Testimonials</a></li>
						</ul>
					</div>

				</div>

				<!-- Footer About -->
				<div class="col-lg-2">

					<div class="footer_col">
						<div class="footer_col_title">About us</div>
						<ul>
							<li><a href="#">The team</a></li>
							<li><a href="#">History</a></li>
							<li><a href="#">Company</a></li>
							<li><a href="#">Support</a></li>
						</ul>
					</div>

				</div>

				<!-- Footer Community -->
				<div class="col-lg-2">

					<div class="footer_col">
						<div class="footer_col_title">Community</div>
						<ul>
							<li><a href="#">Blog</a></li>
							<li><a href="#">Forums</a></li>
							<li><a href="#">Q&A</a></li>
							<li><a href="#">Purposes</a></li>
						</ul>
					</div>

				</div>

			</div>

			<div class="row">
				<div class="col">
					<!-- Copyright -->
					<div class="footer_cr_2">2019 All rights reserved</div>
				</div>
			</div>
		</div>
	</footer>

</div>

<script src="{{ asset('public/front/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('public/front/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('public/front/plugins/slick-1.8.0/slick.js') }}"></script>
<script src="{{ asset('public/front/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('public/front/plugins/scrollTo/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('public/front/js/custom.js') }}"></script>
	
</body>
</html>
