@include('frontend.include.header')
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-section section">
			<div class="container">
				<div class="breadcrumb-area">
					<h1 class="breadcrumb-title">Our Blog Post</h1>
					<ul class="breadcrumb-ul">
					  <li><a href="/">Home</a></li>
					  <li class="active-breadcrumb">Blog</li>
					</ul>
				</div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->	
		<section class="section blog-page-two">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						@if(!empty($single_blog_detail))						
						<div class="single-blog-box single-full-blog">
								<div class="single-blog-box-img">
									<img src="{{asset('/frontend-assets/assets/blogpost_img/'.$single_blog_detail->blog_title_img)}}" alt="" />
								</div>
								<div class="blog-content mt1">
									<h1>{{ $single_blog_detail->blog_title }}</h1>
									<div class="post-meta">
										<span><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>{{ \Carbon\Carbon::parse($single_blog_detail->created_at)->format('d-m-Y H:i') }}</span>
										<span><i class="fa fa-eye" aria-hidden="true"></i>{{ rand ( 10 , 999 ); }}</span>
									</div>
									<div class="post-content">
										{!! $single_blog_detail->blog_des !!}
									</div>
								</div>
								<div class="tag-and-share-box">
									<div class="blog-tag">
										<h4><i class="flaticon-price-tag"></i>Tags :</h4>
										<div class="tag">
											@foreach(explode(',', $single_blog_detail->blog_tag) as $slug_info)
											<a href="#">{{ $slug_info }}</a>
											@endforeach
										</div>										
									</div>
									<div class="blog-share">
										<h4><i class="flaticon-share"></i>Share :</h4>
										{!! Share::page("https://bestcustomboxes.co.uk/blog/".$single_blog_detail->blog_slug, $single_blog_detail->blog_title)->facebook()->twitter()->whatsapp()->linkedin() !!}
									</div>
								</div>
							</div>
						@endif
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</section>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#social-links .fab').each(function(i){
				    $(this).removeClass('fab').addClass('fa');
				});
			});
		</script>
@include('frontend.include.footer')