@include('frontend.include.header')
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-section section">
			<div class="container">
			<div class="row row-top">
					<div class="col-md-4 col-sm-12">
						<div class="breadcrumb-area">
							<ul class="breadcrumb-ul">
							<li><a href="/">Home</a></li>
							<li><a href="/products/">All Products</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-8 col-sm-12">
						<input type="text" class="form-control search_products" placeholder="Search Product ..."
						style="height:50px; border: 1px solid #112955;">
					</div>
			</div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->	
		<!-- Shop Page One Section -->
		<section class="section shop-page-one">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="all-shop-elements row">
							<div class="shoping-items row" id="data-wrapper">							
 								<!-- dynamic content here -->															
							</div>
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
		</section>
		<!-- End Shop Page One Section -->	
		<script>
            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            infinteLoadMore(page);

            function infinteLoadMore(page) {
                $.ajax({
                        url: ENDPOINT + "products?page=" + page,
                        datatype: "html",
                        type: "get",
                        beforeSend: function () {
                            $('.auto-load').show();
                        }
                    })
                    .done(function (response) {
                        if (response.length == 55) {
                            $('.auto-load').html("We don't have more data to display ").css("text-align", "center");
							$("#more-data").hide();
                            return;
                        }
                        $('.auto-load').hide();
                        $("#data-wrapper").append(response);
                        // console.log(response.length);
                    })
                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }
			$(document).ready(function(){
				$(document).on("click", "#more-data", function(){
					page++;
                	infinteLoadMore(page);
				});
			});
        </script>
		<script type="text/javascript">
		$(document).ready(function(){
			$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
			});
			$(document).on("keyup",".search_products", function(){
				var input_value = $(this).val();
				if(input_value.length > 2){
					$("#data-wrapper").empty();
					$("#more-data").hide();
					$.ajax({
						url: "{{ url('search_products_list') }}",
						type:"POST",
						data:{
							"input_value":input_value
						},
						beforeSend: function(){
							$('.auto-load').show();
						},
						complete: function(){
							$('.auto-load').hide();
						},
						success:function(response){
							// console.log(response.length);
							if (response.length == 0) {
								$("#data-wrapper").empty();
								$('.record-not-found').html("We don't have data to display. <a href='/products/'>Reset search</a> ").css("text-align", "center");
							}else{
								$('.record-not-found').empty();
								$("#data-wrapper").empty();
								$("#data-wrapper").append(response);
							}
						},
						error: function(error) {
							console.log(error);
						}
					});
				}
			});
		});
		</script>
@include('frontend.include.footer')
