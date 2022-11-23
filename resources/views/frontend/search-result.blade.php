@include('frontend.include.header')
		<!-- Breadcrumb Section -->
		<section class="breadcrumb-section section">
			<div class="container">
				<div class="breadcrumb-area">
					<ul class="breadcrumb-ul">
					  <li><a href="/">Home</a></li>
					  <li class="active-breadcrumb">Search Result</li>
					</ul>
				</div>
			</div>
		</section>
		<!-- End Breadcrumb Section -->	
        <section class="section give-feedback-section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="project-info">
							<ul>
								@if(!empty($products_list))
								@foreach ($products_list as $item)
								<li>
									<h4>{{$item->prod_title}}</h4>
									<p>{!! Str::limit($item->prod_short_description, 200) !!}</p>
									<a href="/product/{{$item->prod_slug}}" target="_blank" class="search-button" >View Full Detail</a>
								</li>
								@endforeach
								@endif
								@if(!empty($categories_list))
								@foreach ($categories_list as $item_1)
								<li>
									<h4>{{$item_1->cat_title}}</h4>
									<p>You can get full details of boxes under {{$item_1->cat_title}} category by clicking bellow button.</p>
									<a href="/product-category/{{$item_1->cat_slug}}" target="_blank" class="search-button" >View Full Detail</a>
								</li>
								@endforeach
								@endif
								@if(!empty($blogs_list))
								@foreach ($blogs_list as $item_2)
								<li>
									<h4>{{$item_2->blog_title}}</h4>
									<p>{!! Str::limit($item_2->blog_des, 200) !!}</p>
									<a href="/blog/{{$item_2->blog_slug}}" target="_blank" class="search-button" >View Full Detail</a>
								</li>
								@endforeach
								@endif
								@if(empty($products_list) && empty($categories_list) && empty($blogs_list))
								<li>
									<h4>No related data available.</h4>
								</li>
								@endif
							</ul>
						</div>
					</div>
                </div>
            </div>
        </section>
@include('frontend.include.footer')