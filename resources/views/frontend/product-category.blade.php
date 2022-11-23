@include('frontend.include.header')
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-section section">
			<div class="container">
				<div class="breadcrumb-area">
					<ul class="breadcrumb-ul">
					  <li><a href="/">Home</a></li>
					  <li><a href="/categories/">Product Category</a></li>
					  <li class="active-breadcrumb">{{ str_replace("-"," ",last(request()->segments())) }}</li>
					</ul>
				</div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->		
		<!-- Shop Page One Section -->
		<section class="section shop-page-one">
			<div class="container">
				<!-- product row -->
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="all-shop-elements row">
                        <h1>Custom {{ str_replace("-"," ",last(request()->segments())) }}</h1><br>
							<div class="shoping-items row" id="data-wrapper">	
							@foreach ($detail_products as $details_of_product)
								<div class="col-sm-3 col-xs-12">
									<div class="single-product">
										<div class="product-image">
											<a href="{{url('/product/'.$details_of_product->prod_slug.'/')}}">
												<img src="{{asset('/frontend-assets/assets/categories_products_old/'.$details_of_product->prod_title_image)}}" alt="custom {{str_replace('-', ' ', explode('.',$details_of_product->prod_title_image)[0])}}" title="custom {{str_replace('-', ' ', explode('.',$details_of_product->prod_title_image)[0])}}" />
											</a>
										</div>
										<div class="add-chart-icon">
											<a href="{{url('/product/'.$details_of_product->prod_slug.'/')}}" class=""><i class="fa fa-eye"></i><span class="add-chart-text">Detail</span></a>
										</div>
										<div class="product-info">
											<h3><a href="{{url('/product/'.$details_of_product->prod_slug.'/')}}"> {{ $details_of_product->prod_title }}</a></h3>
										</div>
									</div>									
								</div>
							@endforeach							
 							<!-- dynamic content here -->																	
							</div>
							<!-- end row -->
							<div class="all-shop-elements row" style="text-align: center;">
							<span class="button" id="more-data">VIEW MORE</span>
								<!-- Data Loader -->
								<div class="auto-load text-center">
									<svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
										x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
										<path fill="#000"
											d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
											<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
												from="0 50 50" to="360 50 50" repeatCount="indefinite" />
										</path>
									</svg>
								</div>
								<div class="record-not-found text-center"></div>
							</div>
							<!-- end row -->
							</div>
						</div>
					</div>
				</div>
				<!-- category content row -->
				<div class="row mt5 category-details">
					<div class="container">
						<div class="col-md-12 col-sm-12">
							{!! $category_detail !!}
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Shop Page One Section -->	
		<script>
			
			$(document).ready(function(){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				
				var page = 0;
				$('.auto-load').hide();
				$(document).on("click", "#more-data", function(){
					var current_category = $(location).attr("href").split('/').slice(-2, -1)[0];
					page++;
					$.ajax({
						url: "{{ url('more-product-category') }}",
						type:"POST",
						data:{
							"current_category":current_category,
							"page":page
						},
						beforeSend: function(){
							$('.auto-load').show();
						},
						complete: function(){
							$('.auto-load').hide();
						},
						success:function(response){
							if (response.length == 0) {
								$('.record-not-found').html("We don't have more data to display. ").css("text-align", "center");
								$("#more-data").hide();
							}else{
								$("#data-wrapper").append(response);
							}
						},
						error: function(error) {
							console.log(error);
						}
					});
				});
			});
        </script>
@include('frontend.include.footer')