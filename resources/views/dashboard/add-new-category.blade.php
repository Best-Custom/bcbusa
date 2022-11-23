@include('dashboard.include.header')
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    @include('dashboard.include.leftsidebar')
<div id="content" class="main-content">
<div class="layout-px-spacing">    
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
            <div class="row">
            <div id="tabsAlignments" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4 class="justify-tab">Manage Category</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area justify-tab">
                        <div class="tab-content" id="justifyTabContent">
                            <div class="tab-pane fade show active" id="justify-home" role="tabpanel" aria-labelledby="justify-home-tab">
                        <div class="col-lg-12 col-12 layout-spacing">
                            <div class="widget-content widget-content-area">
                            @if(session()->has('message'))
                            <div class="row mb-4">
                                <div class="col-lg-12 col-md-12 col-md-12">
                                <div class="alert alert-success mb-4" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>{{session()->get('message')}}</strong></div>
                                </div>
                            </div>
                            @endif
                                <form action="{{url('post-category-form')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-4">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-4">
                                                <label for="loc">Catgory Title</label>
                                                <input type="text" name="cat_title" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-4">
                                                <label for="lastmod">Category Slug</label>
                                                <input  type="text" name="cat_slug" class="form-control unique_slug" required>
                                                <div class="form-helper shw_alrt"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="custom-file-container" data-upload-id="cat_images">
                                            <label>Upload (Title Image) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" name="cat_image" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-4">
                                            <label for="formGroupExampleInput">Description (Optional)</label>
                                            <textarea style="height:250px;" name="description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-md-12 col-md-12">
                                        <button class="btn btn-secondary btn-lg submiit_details">SUBMIT DETAILS</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                            <!-- END FIRST SECTION -->
                    </div>
                    </div>
                </div>
            </div>
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
</div>
<!-- END MAIN CONTAINER -->
@include('dashboard.include.footer')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('form *').prop('autocomplete', 'off');
    $(".shw_alrt").hide();
    $(document).on("keyup",".unique_slug", function(){
        var table_name = "prod_categories";
        var column_name = "cat_slug";
        var input_value = $(this).val();

        $.ajax({
        url: "{{ url('check_unique_slug') }}",
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
//First upload
var firstUpload = new FileUploadWithPreview('cat_images');
CKEDITOR.replace( 'description' );
</script>
</body>
</html>