@include('dashboard.include.header')
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    @include('dashboard.include.leftsidebar')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
<div class="layout-px-spacing">    
    <div class="row layout-top-spacing">
        @if(session()->has('message'))
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
            <div class="alert alert-success mb-4" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>{{session()->get('message')}}</strong></div>
            </div>
        </div>
        @endif
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <a href="/view-sitemap-details" class="btn btn-info btn-sm mb-4 mr-2" target="_blank"><Var>VIEW SITEMAP</Var></a>
                <a href="/replace-sitemap-file" class="btn btn-warning btn-sm mb-4 mr-2">UPDATE SITEMAP</a>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4 mt-4">
                <table id="style-3" class="table style-3  table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>loc</th>
                                <th>lastmod</th>
                                <th>changefreq</th>
                                <th>priority</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($sitemap_detail))
                        <?php $uno = 1; ?>
                        @foreach ($sitemap_detail as $listitem)
                                <tr>
                                    <td>{{$uno}}</td>
                                    <td>{{ $listitem->loc }}</td>
                                    <td>{{ $listitem->lastmod }}</td>
                                    <td>{{ $listitem->changefreq }}</td>
                                    <td>{{ $listitem->priority }}</td>
                                    <td>{!! $listitem->status == 0 ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>' !!}</td>
                                    <td class="text-center">
                                    @if(Session::get('adminsession.user_role') == 0)
                                    <a href="/edit-sitemap-url/{{$listitem->id}}" class="btn btn-secondary btn-sm mb-4 mr-2">EDIT</a>
                                    <a href="/delete-sitemap-url/{{$listitem->id}}" class="btn btn-danger btn-sm mb-4 mr-2">DELETE</a>
                                    @endif
                                    </td>
                                </tr>
                        <?php $uno++; ?>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-wrapper">
    <div class="footer-section f-section-1">
        <p class="">Copyright © 2022 <a target="_blank" href="/">BCB</a>, All rights reserved.</p>
    </div>
    <div class="footer-section f-section-2">
        <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
    </div>
</div>
</div>
<!--  END CONTENT AREA  -->
</div>
<!-- END MAIN CONTAINER -->
@include('dashboard.include.footer')
</body>
</html>