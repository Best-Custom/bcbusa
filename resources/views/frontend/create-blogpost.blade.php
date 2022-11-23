@include('include.header')
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-section section">
			<div class="container">
				<div class="breadcrumb-area">
					<ul class="breadcrumb-ul">
					  <li><a href="index.html">Home</a></li>
					  <li class="active-breadcrumb">Create New Product</li>
					</ul>
				</div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->	
	
		<!--  Sent Feedback Section -->
	<form action="{{url('create-blogpost')}}" method="POST" enctype="multipart/form-data">
			@csrf
		<section class="section give-feedback-section">
			<div class="container">
				<div class="row">
					@if(session()->has('message'))
						<div class="alert alert-success">
							{{ session()->get('message') }}
						</div>
					@endif
					<div class="sent-feedback-box">
							<div class="form-group">
							  <label>Blog Post Title:</label>
							  <input type="text" class="form-control" placeholder="Product Title" name="blog_title">
							</div>
							<div class="form-group mt1 mb1">
							  <label>Enter Same slug as running site:</label>
							  <input type="text" class="form-control unique_slug" placeholder="Enter Slug" name="blog_slug">
							<div class="form-helper shw_alrt"></div>
							</div>
							<div class="form-group">
								<label>Title Image:</label>
								<input type="file" class="form-control" placeholder="Select Image" name="blog_title_image">
							</div>
							<div class="form-group">
								<label>Add Tags:</label>
								<input type="text" class="form-control" id="blog_tags" placeholder="Tags seprate with (,)" name="blog_tags">
							</div>
							<div class="form-group">
								<label>Detail Description:</label>
								<textarea name="blog_detail_description" class="form-control" cols="30" rows="5"></textarea>
							</div>
					</div>
				<button type="submit" class="btn btn-success mb2 ml2">Submit</button>
				</div>
			</div>
		</section>	
	</form>	
		<!--  End Sent Feedback Section -->	

@include('include.footer')
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'blog_detail_description' );
	$(document).ready(function(){
		$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});
		$(".shw_alrt").hide();
		$(document).on("change keyup input",".unique_slug", function(){
		  	// console.log("ok");
			var table_name = "blog_post_creates";
			var column_name = "blog_slug";
			var input_value = $(this).val();

		    $.ajax({
	        url: "/check_unique_slug",
	        type:"POST",
	        data:{
	          "table_name":table_name,
	          "column_name":column_name,
	          "slug_value": input_value,
	          "fetch_slug_value":"fetch"
	        },
	        success:function(response){
	          if(response == 1) {
	          	$(".unique_slug").css('border','1px solid #c32424');
				$(".shw_alrt").text("Not available !");
				$(".shw_alrt").show();

	          }else{
	          	$(".shw_alrt").text("Available !");
				$(".shw_alrt").show();
	          	$(".unique_slug").css('border','1px solid #24b91a');
	          }
	        },
	        error: function(error) {
	         console.log(error);
	        }
	       });
		});
	});
</script>