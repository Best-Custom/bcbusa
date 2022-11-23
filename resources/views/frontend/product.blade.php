@include('frontend.include.header')
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-section section">
			<div class="container">
				<div class="breadcrumb-area">
					<ul class="breadcrumb-ul">
					  <li><a href="/">Home</a></li>
					  <li><a href="/products/">Products</a></li>
					  <li class="active-breadcrumb">{{ str_replace("-"," ",last(request()->segments())) }}</li>
					</ul>
				</div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->	
		<!-- Shop Page One Section -->
		@if(!empty($detail_single_product))
		<section class="section_1 shop-page-one single-shop-page">
			<div class="container">
				<div class="row">
						<div class="col-md-9 col-sm-12">
							<div class="all-shop-elements row">
								<div class="single-product-details row">
									<div class="custom-width-5">
									<center><h1 class="show_small_devices">{{$detail_single_product->prod_title}}</h1></center>
										<div id="slider" class="flexslider">
										  <ul class="slides">
											@if ($detail_single_product->prod_multiple_image != "")
											@foreach(explode('|', $detail_single_product->prod_multiple_image) as $img_name) 
												<li>
												<img src="{{asset('frontend-assets/assets/categories_products/'.$img_name)}}" alt="custom {{str_replace('-', ' ', explode('.',$img_name)[0])}}" title="custom {{str_replace('-', ' ', explode('.',$img_name)[0])}}" height="400px"/>
												<span class="overlay-thumbnail"></span>
												</li>
											@endforeach
											@endif
										  </ul>
										</div>
										<div id="flex_carousel" class="flexslider">
										  <ul class="slides">
											@if ($detail_single_product->prod_multiple_image != "")
											@foreach(explode('|', $detail_single_product->prod_multiple_image) as $img_name) 
												<li>
												<img src="{{asset('frontend-assets/assets/categories_products/'.$img_name)}}" alt="custom {{str_replace('-', ' ', explode('.',$img_name)[0])}}" title="custom {{str_replace('-', ' ', explode('.',$img_name)[0])}}" />
												<span class="overlay-thumbnail"></span>
												</li>
											@endforeach
											@endif
										  </ul>
										</div>										
									</div>
									<div class="custom-width-5">
										<div class="about-product">
											<div class="product-heading">
												<h1 class="product-name">{{$detail_single_product->prod_title}}</h1>
											</div>
											<div class="product-description">
												{!!$detail_single_product->prod_short_description!!}
											</div>
											<div class="product-cat-tag-share">
												<ul>
													<li>
														<h3>Category:</h3>
														<div class="tag">
														@foreach ( explode(',', $detail_single_product->cate_id) as $products_cateee)
															<span>{{
																DB::table('prod_categories')->select('cat_title')->where('id', '=', $products_cateee)->value('cat_title')
															}}</span>
														@endforeach
														</div>
													</li>
												</ul>
											</div>
											<!-- mobile form -->
											<div class="sidebar row shoping-page-sidebar form_show_small_device">
												<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="product_quote_mb">
												@csrf
												<div class="form-group">
												<div class="col-sm-12">
													<center>
													<h3 style="color: white;">GET A FREE QUOTE</h3>
													</center>
												</div>
												</div><br>
												<div class="form-group">
											      <div class="col-sm-12">
											        <select class="form-control" id="product_name_mb">
											        	<option>Product Name</option>
											        	@foreach (DB::table('prod_products_detail')->get() as $products_detail)
											        	<option value="{{$products_detail->prod_title}}" @if(last(request()->segments())==$products_detail->prod_slug){{"selected"}}@endif >{{$products_detail->prod_title}}</option>
														@endforeach
											        </select>
											      </div>
											    </div>
											    <div class="form-group">
											      <div class="col-sm-12">
											        <input type="number" class="form-control" placeholder="Length" id="length_mb" required>
											      </div>
											    </div>
											    <div class="form-group">
											      <div class="col-sm-12">
											        <input type="number" class="form-control" placeholder="Width" id="width_mb" required>
											      </div>
											    </div>
											    <div class="form-group">
											      <div class="col-sm-12">
											        <input type="number" class="form-control" placeholder="Depth" id="depth_mb" required>
											      </div>
											    </div>
												<div class="form-group">
											      <div class="col-sm-12">
											        <select class="form-control" id="measurement_unit_mb" required>
											        	<option value="" hidden>Select unit</option>
											        	<option value="cm">cm</option>
											        	<option value="inch">inch</option>
											        	<option value="mm">mm</option>
											        </select>
											      </div>
											    </div>
												<div class="form-group">
											      <div class="col-sm-12">
											        <input type="number" class="form-control" placeholder="Quantity" id="qty_mb" required>
											      </div>
											    </div>
											    <div class="form-group">
											      <div class="col-sm-12">
											        <input type="text" class="form-control" placeholder="Your Name" id="your_name_mb" required>
											      </div>
											    </div>
											    <div class="form-group">
											      <div class="col-sm-12">
											        <input type="email" class="form-control" placeholder="Enter email" id="your_email_mb" required>
											      </div>
											    </div>
											    <div class="form-group">
											      <div class="col-sm-12">          
											        <input type="text" class="form-control" placeholder="Contact Number" id="contact_number_mb" required>
											      </div>
											    </div>
											    <div class="form-group">
											      <div class="col-sm-12"> 
											      <textarea class="form-control" placeholder="Your Specification" id="specifications_mb"></textarea>  
											      </div>
											    </div>
											    <div class="form-group">        
											      <div class="col-sm-12">
											      	<center>
											        <button type="submit" class="btn btn-custom-yellow">Send</button>
											      	</center>
											      </div>
											    </div>
											</form>
											</div>
											<!-- end mobile form -->
										</div>
									</div>
									<script type="application/ld+json">
									{
									  "@context": "https://schema.org/", 
									  "@type": "BreadcrumbList", 
									  "itemListElement": [{
									    "@type": "ListItem", 
									    "position": 1, 
									    "name": "Home",
									    "item": "https://bestcustomboxes.com"  
									  },{
									    "@type": "ListItem", 
									    "position": 2, 
									    "name": "Products",
									    "item": "https://bestcustomboxes.com/product/"  
									  },{
									    "@type": "ListItem", 
									    "position": 3, 
									    "name": "{{$detail_single_product->prod_title}}",
									    "item": "{{url('/product/'.$detail_single_product->prod_slug)}}"  
									  }]
									}
									</script>
									<script type="application/ld+json">
									{
									  "@context": "https://schema.org/", 
									  "@type": "Product", 
									  "name": "{{$detail_single_product->prod_title}}",
									  "image": "{{asset('frontend-assets/assets/categories_products/'.$detail_single_product->prod_title_image)}}",
									  "description": "{!!$detail_single_product->prod_short_description!!}",
									  "brand": {
									    "@type": "Brand",
									    "name": "BCB USA"
									  },
									  
									}
									</script>
								</div>
								<div class="product-review">
									<div class="review-tab-heading">
									  <ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
										<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Specifications</a></li>
									  </ul>										
									</div>
									<div class="review-tab-box">
									  <div class="tab-content">
											<div role="tabpanel" class="tab-pane active" id="home">
												<div class="description-box">
													{!!$detail_single_product->prod_detail_description!!}
												</div>
											</div>
											<div role="tabpanel" class="tab-pane" id="profile">
												<div class="customar-review">
													<table class="table">
														<thead>
														<tr>
															<th style="background-color: #112955; color:white; width: 30%">Specs Name</th>
															<th>Specs Detail</th>
														</tr>
														</thead>
														<tbody>
														@foreach (DB::table('prod_perm_specifications')->where('prod_id', '=', $detail_single_product->id)->get() as $detail_specifications)
															<tr>
															<td style="background-color: #112955; color:white;">{{$detail_specifications->specs_name}}</td>
															<td>{{$detail_specifications->specs_des}}</td>
															</tr>
														@endforeach
														</tbody>
													</table>										
												</div>
											</div>
									  </div>										
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="sidebar row shoping-page-sidebar form_hide_small_device">
								<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="ProductQuote">
									@csrf
									<div class="form-group">
									<div class="col-sm-12">
										<center>
										<h3 style="color: white;">GET A FREE QUOTE</h3>
										</center>
									</div>
									</div><br>
									<div class="form-group">
								      <div class="col-sm-12">
								        <select class="form-control" name="product_name" id="product_name">
								        	<option>Product Name</option>
								        	@foreach (DB::table('prod_products_detail')->get() as $products_detail)
								        	<option value="{{$products_detail->prod_title}}" @if(last(request()->segments())==$products_detail->prod_slug){{"selected"}}@endif >{{$products_detail->prod_title}}</option>
											@endforeach
								        </select>
								      </div>
								    </div>
								    <div class="form-group">
								      <div class="col-sm-12">
								        <input type="number" class="form-control" placeholder="Length" name="length" id="length" required>
								      </div>
								    </div>
								    <div class="form-group">
								      <div class="col-sm-12">
								        <input type="number" class="form-control" placeholder="Width" name="width" id="width" required>
								      </div>
								    </div>
								    <div class="form-group">
								      <div class="col-sm-12">
								        <input type="number" class="form-control" placeholder="Depth" name="depth" id="depth" required>
								      </div>
								    </div>
									<div class="form-group">
								      <div class="col-sm-12">
								        <select class="form-control" id="measurement_unit" required>
								        	<option value="" hidden>Select unit</option>
								        	<option value="cm">cm</option>
								        	<option value="inch">inch</option>
								        	<option value="mm">mm</option>
								        </select>
								      </div>
								    </div>
									<div class="form-group">
								      <div class="col-sm-12">
								        <input type="number" class="form-control" placeholder="Quantity" name="qty" id="qty" required>
								      </div>
								    </div>
								    <div class="form-group">
								      <div class="col-sm-12">
								        <input type="text" class="form-control" placeholder="Your Name" name="your_name" id="your_name" required>
								      </div>
								    </div>
								    <div class="form-group">
								      <div class="col-sm-12">
								        <input type="email" class="form-control" placeholder="Enter email" name="your_email" id="your_email" required>
								      </div>
								    </div>
								    <div class="form-group">
								      <div class="col-sm-12">          
								        <input type="text" class="form-control" placeholder="Contact Number" name="contact_number" id="contact_number" required>
								      </div>
								    </div>
								    <div class="form-group">
								      <div class="col-sm-12"> 
								      <textarea class="form-control" placeholder="Your Specification" name="specifications" id="specifications"></textarea>  
								      </div>
								    </div>
								    <div class="form-group">        
								      <div class="col-sm-12">
								      	<center>
								        <button type="submit" class="btn btn-custom-yellow">Send</button>
								      	</center>
								      </div>
								    </div>
								</form>
							</div>
						</div>
					</div>
					@if (!empty($faq_list))
					<div class="single-services-content">
						<h3>Frequently Asked Questions</h3>
						<div class="panel-group sidebar-panel" id="accordion" role="tablist" aria-multiselectable="true">
						@php($count=0)
						@foreach($faq_list as $ques => $answ)
						<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="heading{{$count}}">
								<h4 class="panel-title">
									<a class="@if($count !== 0) collapsed @endif" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$count}}" aria-expanded="@if($count==0) true @else false @endif" aria-controls="collapse{{$count}}">
									{{$ques}}
									<span class="plus-minus-icon">
										<span class="plus-stick"></span>
										<span class="minus-stick"></span>
									</span>											  
									</a>
								</h4>
								</div>
								<div id="collapse{{$count}}" class="panel-collapse collapse @if($count==0) in @endif" role="tabpanel" aria-labelledby="heading{{$count}}" aria-expanded="@if($count==0) true @else false @endif">
								<div class="panel-body">
								{{$answ}} 
								</div>
								</div>
							</div>
							@php($count++)
							@endforeach
						</div>
					</div>
					@endif
					@if (!empty($testimonial_list["name"][0]))
					<section class="section testimonial-section-two">
					<div class="container">
						<div class="row mb3">
							<h3 class="h_resize">Our Clients Review</h3>
						</div> 
						<div class="row">
							<div class="testimonial-parents swiper-container-horizontal" id="testmimonial-big" style="cursor: grab;">
								<div class="swiper-wrapper" style="transform: translate3d(-3200px, 0px, 0px); transition-duration: 0ms;">
									<div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" style="width: 370px; margin-right: 30px;"></div>
									@for($i=0; $i < count($testimonial_list["name"]); $i++)
									@if($i%2 == 0)
									<div class="swiper-slide swiper-slide-duplicate-next" data-swiper-slide-index="0" style="width: 370px; margin-right: 30px;">						
										<div class="testimonial-box">
											<div class="single-testimonial">
												<div class="testimonial-content">
													<div class="testimonial-inner">
														<p>{{$testimonial_list["message"][$i]}}</p>
													</div>								
												</div>
											</div>
											<div class="testimonial-author">
												<div class="testimonial-author-pic">
													<img src="#" alt="">
												</div>
												<div class="testimonial-author-info">
													<h3>{{$testimonial_list["name"][$i]}}</h3>
													<span>{{$testimonial_list["designation"][$i]}}</span>
												</div>
											</div>							
										</div>
									</div>
									@else
									<div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="4" style="width: 370px; margin-right: 30px;">						
										<div class="testimonial-box">
											<div class="single-testimonial">
												<div class="testimonial-content">
													<div class="testimonial-inner">
														<p>{{$testimonial_list["message"][$i]}}</p>
													</div>								
												</div>
											</div>
											<div class="testimonial-author">
												<div class="testimonial-author-pic">
													<img src="#" alt="">
												</div>
												<div class="testimonial-author-info">
													<h3>{{$testimonial_list["name"][$i]}}</h3>
													<span>{{$testimonial_list["designation"][$i]}}</span>
												</div>
											</div>							
										</div>
									</div>
									@endif
									@endfor
								</div>
							</div>
						</div>
					  </div>
					</section>
					@endif
					@if (!empty($relevent_prod))
					<section class="section testimonial-section-two">
						<div class="container"> 
							<div class="row">
								<div class="releted-product-box">
									<h3 class="box-title">Related Product</h3>
									<div class="related-product-items row">
									@foreach($relevent_prod as $result)
									<div class="col-sm-3 col-xs-12">
										<div class="single-product">
											<div class="product-image">
												<a href="/product/{{$result->prod_slug}}/"><img src="{{asset('/frontend-assets/assets/categories_products_old/'.$result->prod_title_image )}}" /></a>
											</div>
											<div class="add-chart-icon">
												<a href="/product/{{$result->prod_slug}}/"><i class="fa fa-eye"></i><span class="add-chart-text">Detail</span></a>
											</div>
											<div class="product-info">
												<h3><a href="/product/{{$result->prod_slug}}/">{{$result->prod_title}}</a></h3>
											</div>
										</div>									
									</div>
									@endforeach								
									</div>
								</div>
							</div>
						</div>
					</section>
					@endif
				</div>
			</div>
		</section>
		<!-- End Shop Page One Section -->	
		@endif	
@include('frontend.include.footer')
<script type="text/javascript">
$(document).ready(function(){
	$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
	});

	$(document).on('submit', '#ProductQuote',function(e){
    e.preventDefault();
    let product_name = $('#product_name').val();
    let length = $('#length').val();
    let width = $('#width').val();
    let depth = $('#depth').val();
    let measurement_unit = $('#measurement_unit').val();
    let qty = $('#qty').val();
    let your_name = $('#your_name').val();
    let your_email = $('#your_email').val();
    let contact_number = $('#contact_number').val();
    let specifications = $('#specifications').val();
  	// $('#scc_alrt').text("");
    // $('#scc_alrt').show();
    // $('#ProductQuote').hide();
    $.ajax({
      url: "{{ route('product-quote-form') }}",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        product_name:product_name,
        length:length,
        width:width,
        depth:depth,
        measurement_unit:measurement_unit,
		qty:qty,
        your_name:your_name,
        your_email:your_email,
        contact_number:contact_number,
        specifications:specifications
      },
      beforeSend: function() {
        $(':input[type="submit"]').prop('disabled', true);    
      },
      success:function(data, textStatus, xhr){
        // console.log(data);
        if (xhr.status == 200) {
        	window.location.href = "/thank-you";
        }
      },
      error: function(response) {
        console.log(response);
      }
      });
      });

    // mobile form
	$(document).on('submit', '#product_quote_mb',function(e){
    e.preventDefault();
    let product_name_mb = $('#product_name_mb').val();
    let length_mb = $('#length_mb').val();
    let width_mb = $('#width_mb').val();
    let depth_mb = $('#depth_mb').val();
    let measurement_unit_mb = $('#measurement_unit_mb').val();
    let qty_mb = $('#qty_mb').val();
    let your_name_mb = $('#your_name_mb').val();
    let your_email_mb = $('#your_email_mb').val();
    let contact_number_mb = $('#contact_number_mb').val();
    let specifications_mb = $('#specifications_mb').val();
    $.ajax({
      url: "{{ route('product-quote-form') }}",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        product_name:product_name_mb,
        length:length_mb,
        width:width_mb,
        depth:depth_mb,
        measurement_unit:measurement_unit_mb,
		qty:qty_mb,
        your_name:your_name_mb,
        your_email:your_email_mb,
        contact_number:contact_number_mb,
        specifications:specifications_mb
      },
      beforeSend: function() {
        $(':input[type="submit"]').prop('disabled', true);    
      },
      success:function(data, textStatus, xhr){
        // console.log(data);
        if (xhr.status == 200) {
        	window.location.href = "/thank-you";
        }
      },
      error: function(data) {
        console.log(data);
      }
      });
      });
});

</script>