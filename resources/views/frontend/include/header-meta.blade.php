@if(Request::url() == "https://staging.bestcustomboxes.com/about-us")
        <title>{{"About Us | Best Custom Boxes"}}</title>
        <link rel="canonical" href="{{'https://bestcustomboxes.com/'}}" />
        <meta name="description" content="{{'Best Custom Boxes offers high quality boxes with free design support and shipping. Custom boxes for your desired product at wholesale prices.'}}">
        <meta property="og:locale" content="en_GB" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{'About Us | Best Custom Boxes'}}" />
        <meta property="og:description" content="{{'Best Custom Boxes offers high quality boxes with free design support and shipping. Custom boxes for your desired product at wholesale prices.'}}" />
        <meta property="og:url" content="{{'https://bestcustomboxes.com/about-us'}}" />
        <meta property="og:site_name" content="BCB USA" />
        <meta property="article:publisher" content="https://en-gb.facebook.com/BestCustomBoxes/" />
        <meta property="article:modified_time" content="2022-03-04T16:50:25+00:00" />
        <meta property="og:image" content="{{asset('/frontend-assets/assets/images/retox.png')}}" />
        <meta property="og:image:width" content="2401" />
        <meta property="og:image:height" content="2401" />
        <meta property="og:image:type" content="image/png" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@bestcustomboxe1" />
        <meta name="twitter:creator" content="@bestcustomboxe1" />
        <meta name="twitter:label1" content="Estimated reading time" />
        <meta name="twitter:data1" content="4 minutes" />
@else
@foreach (DB::table('meta_title_and_description')->get() as $meta_details)
@if(Request::url()."/" == $meta_details->page_slug)
        <title>{{$meta_details->page_meta}}</title>
        <link rel="canonical" href="{{$meta_details->page_slug}}" />
        <meta name="description" content="{{$meta_details->page_description}}">
        <meta property="og:locale" content="en_GB" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{$meta_details->page_meta}}" />
        <meta property="og:description" content="{{$meta_details->page_description}}" />
        <meta property="og:url" content="{{$meta_details->page_slug}}" />
        <meta property="og:site_name" content="BCB USA" />
        <meta property="article:publisher" content="https://en-gb.facebook.com/BestCustomBoxes/" />
        <meta property="article:modified_time" content="2022-03-04T16:50:25+00:00" />
        <meta property="og:image" content="{{asset('/frontend-assets/assets/images/retox.png')}}" />
        <meta property="og:image:width" content="2401" />
        <meta property="og:image:height" content="2401" />
        <meta property="og:image:type" content="image/png" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@bestcustomboxe1" />
        <meta name="twitter:creator" content="@bestcustomboxe1" />
        <meta name="twitter:label1" content="Estimated reading time" />
        <meta name="twitter:data1" content="4 minutes" />
@endif
@endforeach
@endif