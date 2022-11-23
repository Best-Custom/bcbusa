@include('frontend.include.header')
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-section section">
			<div class="container">
        <div class="breadcrumb-area">
          <ul class="breadcrumb-ul">
            <li><a href="/">Home</a></li>
            <li class="active-breadcrumb">Request For A Free Call</li>
          </ul>
        </div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->	
      <section class="section give-feedback-section">
        <div class="container">
          <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                      <form action="{{ url('/request-for-a-call')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group ">
                          <label>Your Name (required)</label>
                          <input type="text" class="form-control" placeholder="Enter Your Name" name="yourname" required>
                        </div>
                        <div class="form-group">
                          <label>Your Email (required)</label>
                          <input type="email" class="form-control" placeholder="Enter Your Email" name="email" required>
                        </div>
                        <div class="form-group">
                          <label>Your Phone (required)</label>
                          <input type="text" class="form-control" placeholder="Enter Your phone" name="phone" required>
                        </div>
                        <button type="submit" class="btn btn-primary"> Submit </button>
                      </form>
                  </div>
                  <div class="col-md-2"></div>
              </div>
          </div>
      </section>  
<!-- Google form recaptcha -->
<script src='https://www.google.com/recaptcha/api.js'></script>           
@include('frontend.include.footer')