@include('dashboard.include.header')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard-assets/assets/css/custom.css') }}">
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
                    <div id="form_grid_layouts" class="col-lg-12">
                        <div class="seperator-header">
                            <h4 class="">Edit Product Details</h4>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                            @if(session()->has('message'))
                            <div class="row mb-4">
                                <div class="col-lg-12 col-md-12 col-md-12">
                                <div class="alert alert-success mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Data update successfully!</strong></button>
                                </div>
                                </div>
                            </div>
                            @endif
                                <form action="{{url('update-exist-product')}}" method="POST" enctype="multipart/form-data" id="UpdateForm">
                                    @csrf
                                    <div class="row mb-4 row-border">
                                        <div class="col-lg-3 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput">Product Id</label>
                                                <input type="text" class="form-control" name="prod_id" id="prod_id" value="{{ $stocks = $product_details->id  }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput">Category of product</label>
                                                <select name="cate_id[]" class="form-control tagging" multiple="multiple" required>
                                                @foreach ($categories_detail as $categories_details)
                                                    @foreach(explode(',', $product_details->cate_id) as $cate_id)
                                                <option value="{{ $categories_details->id }}" 
                                                    @if($categories_details->id == $cate_id) selected @endif>{{ $categories_details->cat_title }}</option>
                                                    @endforeach
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput">Product Title</label>
                                                <input name="prod_title" type="text" class="form-control" value="{{$product_details->prod_title}}" id="formGroupExampleInput" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput">Enter Same slug as old site</label>
                                                <input name="prod_slug" type="text" class="form-control" value="{{$product_details->prod_slug}}" id="formGroupExampleInput" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 row-border">
                                        <div class="col-lg-2 col-md-12 col-md-12"><h6>Title Image</h6><span class="btn btn-secondary btn-sm mb-4 mr-2 replace_title_image">REPLACE</span></div>
                                        <div class="col-lg-10 col-md-12 col-md-12">
                                        <input accept="image/*" name="prod_title_image" type='file' id="imgInp"/>
                                            <img id="blah" src="{{ asset('frontend-assets/assets/categories_products/'.$product_details->prod_title_image ) }}" alt="" width="200px">
                                        </div>
                                    </div>
                                    <div class="row mb-4 row-border">
                                        <div class="col-lg-3 col-md-12 col-md-12"><h6>Product Detail Images</h6><span class="btn btn-secondary btn-sm mb-4 mr-2 add_new_multi_images">ADD NEW</span></div>
                                        <div class="col-lg-9 col-md-12 col-md-12">
                                            <input type="file" id="gallery-photo-add" multiple>
                                            <div class="row gallery">
                                                @if(!empty($product_details->prod_multiple_image))
                                                @foreach(explode('|', $product_details->prod_multiple_image) as $key=>$multiple_image)
                                                <div class="col-lg-3 mb-4 coll_img_class" id="coll_img_id_{{$key}}">
                                                    <span class="close_img" id="{{$key}}"><i class="far fa-times-circle"></i></span>
                                                    <img class="multiple_img coll_img_class_{{$key}}" src="{{ asset('frontend-assets/assets/categories_products/'.$multiple_image ) }}">
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 row-border">
                                        <div class="col">
                                        <div class="form-group mb-4">
                                            <label for="formGroupExampleInput">Short Description</label>
                                            <textarea style="height:200px;" name="prod_short_description" class="form-control">{!! $product_details->prod_short_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 row-border">
                                        <div class="col">
                                        <div class="form-group mb-4">
                                            <label for="formGroupExampleInput">Detail Description</label>
                                            <textarea class="form-control" id="prod_detail_description" name="prod_detail_description">{!! $product_details->prod_detail_description !!}</textarea>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5 row-border">
                                        <div class="col">
                                            <h6>Product Specifications</h6><span id="add_new_one" class="btn btn-secondary btn-sm mb-4 mr-2">ADD NEW</span>
                                        </div>
                                    </div>
                                    <div class="row row-border">
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Specification Name" id="specs_name">
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Specification Description" id="specs_des">
                                            <input type="hidden" id="prod_specs_id" value="" >
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <button id="add_specs" class="btn btn-secondary btn-lg mb-4 mr-2">ADD NEW</button>
                                            <button id="update_specs" class="btn btn-secondary btn-lg mb-4 mr-2" disable>UPDATE</button>
                                        </div>
                                    </div>
                                    <div class="row mb-4 row-border">
                                        <div class="col-lg-12 col-md-12 col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-4" id="custom_style_table">
                                                <thead>
                                                    <tr>
                                                        <th width="40%">Specification Name</th>
                                                        <th width="40%">Specification Description</th>
                                                        <th width="20%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if(!empty($product_specifications))
                                                    @foreach ($product_specifications as $detail_specifications)
                                                    <tr>
                                                        <td>{{$detail_specifications->specs_name}}</td>
                                                        <td>{{$detail_specifications->specs_des}}</td>
                                                        <td>
                                                            <span id="editspecs_{{$detail_specifications->id}}" class="btn btn-secondary btn-sm mb-4 mr-2 editspecs">Edit</span>
                                                            <span id="deletespecs_{{$detail_specifications->id}}" class="btn btn-secondary btn-sm mb-4 mr-2 deletespecs">Delete</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan="2" text-align: "center";>
                                                            No Record Found
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="time" value="Submit Complete Product" class="btn btn-primary btn-lg mb-4 mr-2">
                                </form>
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
        <p class="">Copyright © 2020 <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>
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
CKEDITOR.replace( 'prod_detail_description' );
</script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
		});
    	$(document).on("click", "#add_specs", function(e){
            console.clear();
            e.preventDefault();
            var prod_id = $('#prod_id').val();
            var specs_name = $('#specs_name').val();
            var specs_des = $('#specs_des').val();
            var url = "{{ url('addnew-perm-specification') }}";
            $.ajax({
            url:url,
            method:'POST',
            data:{
                    'prod_id':prod_id, 
                    'specs_name':specs_name,
                    'specs_des':specs_des
                    },
            success:function(response){
                if(response.success){
                    $("#custom_style_table").load(window.location.href + " #custom_style_table");
                    $('#specs_name').val('');
                    $('#specs_des').val('');
                }else{
                    alert("Error")
                }
            },
            error:function(error){
                console.log(error)
            }
            });
	  });
      $(document).on("click", "#update_specs", function(e){
            // console.clear();
            e.preventDefault();
            var specs_id = $('#prod_specs_id').val();
            var prod_id = $('#prod_id').val();
            var specs_name = $('#specs_name').val();
            var specs_des = $('#specs_des').val();
            var url = "{{ url('update-perm-specification') }}";
            $.ajax({
            url:url,
            method:'POST',
            data:{
                    'specs_id':specs_id, 
                    'prod_id':prod_id, 
                    'specs_name':specs_name,
                    'specs_des':specs_des
                    },
            success:function(response){
                    if(response.success){
                        $("#custom_style_table").load(window.location.href + " #custom_style_table");
                        $('#specs_name').val('');
                        $('#specs_des').val('');
                    }else{
                        alert("Error")
                    }
            },
            error:function(error){
                console.log(error)
            }
            });
	  });
      $(document).on("click", ".deletespecs", function(){
            var specs_id = $(this).attr("id").split("_").pop();
            var url = "{{ url('delete-product-specs') }}";
            $.ajax({
            url:url,
            method:'POST',
            data:{
                    'specs_id':specs_id
                    },
            success:function(response){
                if(response.success){
                    $("#custom_style_table").load(window.location.href + " #custom_style_table");
                }else{
                    alert("Error")
                }
            },
            error:function(error){
                console.log(error)
            }
            });
      });
      $(document).on("click", ".editspecs", function(){
            var specs_name = $(this).parents("tr").children("td:first").text();
            var specs_des = $(this).closest("tr").find("td:eq(1)").text();
            $('#specs_name').val(specs_name);
            $('#specs_des').val(specs_des);
            $('#prod_specs_id').val($(this).attr('id').split("_").pop());
            $('#add_specs').hide();
            $('#update_specs').show();
            $('#add_new_one').show();
      });
      $(document).on("click", "#add_new_one", function(){
            $('#add_new_one').hide();
            $('#update_specs').hide();
            $('#specs_name').val('');
            $('#specs_des').val('');
            $('#add_specs').show();  
      });
            $('#add_new_one').hide();
            $('#update_specs').hide();
        // title image code 
            $('#imgInp').hide();
            $('#gallery-photo-add').hide();
        $(document).on("click", ".replace_title_image", function(){
            $('#imgInp').click();
        });
        
        // multiple images delete
        $(document).on("click", ".close_img", function(){
            console.clear();
            var img_id = $(this).attr('id');
            var prod_id = $('#prod_id').val();
            if($('.multiple_img').hasClass('coll_img_class_'+$(this).attr('id'))){
                var img_src = $('.coll_img_class_'+$(this).attr('id')).attr('src').split('/').pop();
                var url = "{{ url('delete-multi-img') }}";
                $.ajax({
                type:'POST',
                url: url,
                data:{
                    'prod_id':prod_id, 
                    'img_src':img_src
                    },
                success:function(data){
                    if(data.success){
                        $('#coll_img_id_'+img_id).remove();
                    }else{
                        alert("Error")
                    }
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
                });
            }else{
                $('#coll_img_id_'+img_id).remove();
            }
        });
        $(document).on("click", ".add_new_multi_images", function(){
            $('#gallery-photo-add').click();
        });

    // product detail multiple images

    var myFiles = [];

    $(document).on("change","#gallery-photo-add", function(e) {
        var img_id = parseInt($('.gallery').find('.coll_img_class:last').attr('id').split('_').pop())+1;
        var files = e.target.files, file;
        for (var i = 0; i < files.length; i++) {
            file = files[i];
            myFiles.push(file);
            $('<div class="col-lg-3 mb-4 coll_img_class" id="coll_img_id_'+img_id+'"><span class="close_img remove" id="'+img_id+'"><i class="far fa-times-circle"></i></span><img src="'+URL.createObjectURL(file)+'" class="multiple_img"></div>').appendTo('div.gallery').find(".remove").click(removeFile.bind(null, file));
        }
    });

    // now override the default form submission
    function removeFile(file, evt) {
        myFiles.splice(myFiles.indexOf(file), 1);
    }

    // complete form submit
    $(document).on("submit", "#UpdateForm", function(e){
		console.clear();
		e.preventDefault();
        var formData = new FormData(this);
        for (var i = 0; i < myFiles.length; i++) {
            formData.append('prod_multiple_image[]', myFiles[i]);
        }      
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                // console.log(data);
                if(data.success){
                    location.reload(true);
                }else{
                    alert("Error")
                }
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
        });
        // end form submit
        
    });
    // title image preview
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>
</body>
</html>
