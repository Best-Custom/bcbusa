@include('frontend.include.header')
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-section section">
			<div class="container">
				<div class="breadcrumb-area">
					<ul class="breadcrumb-ul">
					  <li><a href="/">Home</a></li>
					  <li class="active-breadcrumb">Blogs</li>
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
						<div class="blog-style-two" id="data-wrapper">
                            <!-- dynamic content here -->
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
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
                    </div>
                </div>
			</div>
		</section>
        <script>
            
            var ENDPOINT = "{{ url('/') }}";
            var page = 1;
            infinteLoadMore(page);
            // var scrollLoad = true;
            // $(window).scroll(function () {
            // // if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            // if (scrollLoad && ($(document).height() - $(window).height())-$(window).scrollTop()<=500){
            //     page++;
            //     infinteLoadMore(page);
            // }
            // });
            function infinteLoadMore(page) {
                $.ajax({
                        url: ENDPOINT + "blogs?page=" + page,
                        datatype: "html",
                        type: "get",
                        beforeSend: function () {
                            $('.auto-load').show();
                        }
                    })
                    .done(function (response) {
                        if (response.length == 0) {
                            $('.auto-load').html("We don't have more data to display");
                            $("#more-data").hide();
                            return;
                        }
                        $('.auto-load').hide();
                        $("#data-wrapper").append(response);
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
@include('frontend.include.footer')