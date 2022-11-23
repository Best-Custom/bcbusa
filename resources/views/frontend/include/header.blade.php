<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('frontend.include.header-meta')
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="DStIwLNovotNVbm9D_FkdMQrVLtV2j9TFtUZlh7My_E" />
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend-assets/assets/images/favicon_image.png')}}" />
        @include('frontend.include.header-asset')
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-52MT47J');</script>
        <!-- End Google Tag Manager -->
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-52MT47J"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->  
        <header>
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="header-top-right">
                            <ul>
                                <li>
                                    <img src="{{asset('frontend-assets/assets/images/flag-usa.webp')}}" alt="USA Flag" width="30px" height="30px"/>
                                    <div class="header-top-contact">
                                        <h4>info@bestcustomboxes.com</h4>
                                        <h5>1800 434 9599</h5>
                                    </div>
                                </li>
                                <li>
                                    <img src="{{asset('frontend-assets/assets/images/flag-canada.webp')}}" alt="Canada Flag" width="30px" height="30px"/>
                                    <div class="header-top-contact">
                                        <h4>info@bestcustomboxes.com</h4>
                                        <h5>1800 434 9599</h5>
                                    </div>
                                </li>
                                <li>
                                    <img src="{{asset('frontend-assets/assets/images/flag-uk.webp')}}" alt="UK Flag" width="30px" height="30px"/>
                                    <div class="header-top-contact">
                                        <h4>info@bestcustomboxes.co.uk</h4>
                                        <h5>0800 368 9377</h5>
                                    </div>
                                </li>
                                <li>
                                    <img src="{{asset('frontend-assets/assets/images/flag-pak.webp')}}" alt="PAK Flag" width="30px" height="30px"/>
                                    <div class="header-top-contact">
                                        <h4>info@bestcustomboxes.com</h4>
                                        <h5>92 321 509 0118</h5>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mainmenu-area" id="sohag">
                <div class="container">
                    <div class="row">
                        <a href="/" class="xct"><img src="{{asset('frontend-assets/assets/images/logo-2.webp')}}" alt="logo" /></a>
                        <div class="nav-menu">
                        <nav class="navbar navbar-default">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar-one bar-stick"></span>
                                <span class="icon-bar-two bar-stick"></span>
                                <span class="icon-bar-three bar-stick"></span>
                              </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                              <ul class="nav navbar-nav">
                                <li><a href="/why-bcb/"><span>Why BCB</span></a></li>               
                                <li>
                                  <a href="/about-us/"><span>About Us</span></a>
                                </li>                               
                                <li>
                                  <a href="/categories/"><span>Categories</span></a>
                                </li>
                                <li>
                                  <a href="/products/"><span>Products</span></a>
                                </li>               
                                <li>
                                  <a href="/blogs/"><span>Blog</span></a>
                                </li>
                                <li><a href="/contact/"><span>Contact</span></a></li>
                                <li style="padding-top: 30px;">
                                <span class="quote-btn">
                                  <a href="/product-quote-for-price/"><span>GET A FREE QUOTE</span></a>
                                </span>
                                </li>               
                              </ul>
                            </div>
                        </nav>
                        </div>
                        <div class="mainmenu-right">
                            <div class="search-box">
                                <i class="fa fa-search first_click" aria-hidden="true"></i>
                                <i class="fa fa-times second_click" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="search-box-text">
                            <form action="{{ route('search') }}" method="POST">
                            @csrf
                                <input type="text" name="search" id="all-search" placeholder="Search Here"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header Section -->
		<!-- call to action button -->
		<a href="/product-quote-for-price/"><div class="get_quote_panel">
			<p>Get A Quote</p>
		</div></a>
		<a href="/request-for-call/"><div class="req_a_call_panel">
			<p>Request A Call BAck</p>
		</div></a>