@include('frontend.include.header')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Best Custom Boxes USA",
  "image": "https://bestcustomboxes.com/frontend-assets/assets/images/bcb-uk-org.jpg",
  "@id": "",
  "url": "https://bestcustomboxes.com",
  "telephone": "800 434 9599",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "535 ocean parkway, Brooklyn",
    "addressLocality": "New York",
    "postalCode": "11218",
    "addressCountry": "US"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 40.6353439,
    "longitude": -73.9753818
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday"
    ],
    "opens": "09:00",
    "closes": "18:00"
  },
  "sameAs": [
    "https://www.facebook.com/BestCustomBoxesUSA/",
    "https://twitter.com/bestcustomboxe1",
    "https://www.instagram.com/bestcustomboxes.usa/",
    "https://www.pinterest.com/bestcustomboxesUSA/",
    "https://www.linkedin.com/company/best-custom-boxes",
    "https://bestcustomboxes.com"
  ] 
}
</script>
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-section section">
			<div class="container">
				<div class="breadcrumb-area">
					<ul class="breadcrumb-ul">
					 <li><a href="/">Home</a></li>
					  <li class="active-breadcrumb">Contact</li>
					</ul>
				</div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->	
		<!--  Sent Feedback Section -->
		<section class="section give-feedback-section">
			<div class="container">
				<div class="row">
					<div class="section-heading">
						<h1 class="section-title">HAVE ANY QUESTIONS</h1>
						<p class="section-content">Best Custom Boxes is the finest brand in the market for packaging. We offer the best packaging solutions. The representation of the product is very vital and it determines the success of the product. We at Best Custom Boxes are there to make your product a success.</p>
					</div>
				</div>
				<div class="row">
					<div class="sent-feedback-box">
						<form class="comment-form" action="{{url('/contact-form-email')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-sm-4 col-xs-12">
									<input type="text" name="fullname" placeholder="Full Name" class="input" required/>
								</div>		
								<div class="col-sm-4 col-xs-12">
									<input type="email" name="email" placeholder="Email Address" class="input" required/>
								</div>			
								<div class="col-sm-4 col-xs-12">
									<input type="text" name="subject" placeholder="Subject" class="input" required/>
								</div>
							</div>
							<textarea name="message_text" id="comment-reply" rows="7" placeholder="Type Here Message" required></textarea>
							<div class="submit-button-div">
								<span class="button"><input type="submit" value="Send Message" class="submit-button"/></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>		
		<!--  End Sent Feedback Section -->	
		<!-- Contact Info Section -->
		<section class="section contact-page-info">
			<div class="container">
				<div class="row">
					<div class="section-heading">
						<h2 class="section-title">CORPORATE HEADQUARTER</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="f-widget">
							<h2>OFFICE (USA)</h2>
							<div class="contact-info">
								<ul>
									<li><i class="fa fa-map-marker" aria-hidden="true"></i><span> 535 ocean parkway, Brooklyn, New York, 11218. (USA).</span></li>
									<li><i class="fa fa-phone" aria-hidden="true"></i><span> 1800 434 9599</span></li>
									<li><i class="fa fa-clock-o" aria-hidden="true"></i><span> Mon - Fri 9:00am - 6:00pm Est</span></li>
									<li><i class="fa fa-envelope-o" aria-hidden="true"></i><span> info@bestcustomboxes.com</span></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="f-widget">
							<h2>OFFICE (CANADA)</h2>
							<div class="contact-info">
								<ul>
									<li><i class="fa fa-map-marker" aria-hidden="true"></i><span> 2 Robert Speck Parkway Suite 750 Mississauga Ontario L4Z 1H8 Canada.</span></li>
									<li><i class="fa fa-phone" aria-hidden="true"></i><span> 1800 434 9599</span></li>
									<li><i class="fa fa-clock-o" aria-hidden="true"></i><span> Mon - Fri 9:00am - 6:00pm Est</span></li>
									<li><i class="fa fa-envelope-o" aria-hidden="true"></i><span> info@bestcustomboxes.com</span></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="f-widget">
							<h2>OFFICE (U.K)</h2>
							<div class="contact-info">
								<ul>
									<li><i class="fa fa-map-marker" aria-hidden="true"></i><span> Balaclava industrial estate, Unit#4 Fishponds, Bristol. BS16 3LJ U.K.</span></li>
									<li><i class="fa fa-phone" aria-hidden="true"></i><span> 0800 368 9377</span></li>
									<li><i class="fa fa-clock-o" aria-hidden="true"></i><span> Mon - Fri 9:00am - 6:00pm GMT</span></li>
									<li><i class="fa fa-envelope-o" aria-hidden="true"></i><span> info@bestcustomboxes.co.uk</span></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="f-widget">
							<h2>OFFICE (PAK)</h2>
							<div class="contact-info">
								<ul>
									<li><i class="fa fa-map-marker" aria-hidden="true"></i><span> 12-AA, Commercial Market, Phase 4, DHA, Lahore, Pakistan.</span></li>
									<li><i class="fa fa-phone" aria-hidden="true"></i><span> 92 321 509 0118</span></li>
									<li><i class="fa fa-clock-o" aria-hidden="true"></i><span> Mon - Fri 9:00am - 6:00pm GMT+5</span></li>
									<li><i class="fa fa-envelope-o" aria-hidden="true"></i><span> info@bestcustomboxes.com</span></li>
								</ul>
							</div>
						</div>
					</div>								
				</div>
			</div>
		</section>
		<!--  End Contact Info Section -->
		<!--  Google Map Section -->
		<section>
			<div class="container-fluid">
				<div class="row">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12112.394147672583!2d-73.97379579196742!3d40.627708849565835!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4740a107c1286685!2sBest%20Custom%20Boxes!5e0!3m2!1sen!2suk!4v1655906240393!5m2!1sen!2suk" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				</div>
			</div>
		</section>
		<!--  End Google Map Section -->	
		<!-- Newsletter Section -->
		<section class="newletter-section">
			<div class="container">
				<div class="row">
					<div class="newsletter-section-box">
						<h2>Join Our Newsletter</h2>
						<div class="input-box">
							<form action="email">
								<input type="email" name="email" placeholder="Enter your e-mail here" />
								<input type="submit" value="Subscrive Now" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Newsletter Section -->
		<!-- Google form recaptcha -->
		<script src='https://www.google.com/recaptcha/api.js'></script>
@include('frontend.include.footer')