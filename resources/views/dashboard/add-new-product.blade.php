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
                            <h4 class="">Add New Product</h4>
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
                                    <strong>Data saved successfully!</strong></button>
                                </div>
                                </div>
                            </div>
                            @endif
                                <form action="{{url('add-new-product')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-4 row-border">
                                        <div class="col-lg-3 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput">Product Id</label>
                                                <input type="text" class="form-control" name="prod_id" id="prod_id" value="{{ $stocks = (DB::table('prod_products_detail')->orderBy('id', 'desc')->first()->id)+1; }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput">Category of product</label>
                                                <select name="cate_id[]" class="form-control tagging" multiple="multiple" required>
                                                @foreach ($categories_detail as $categories_details)
                                                <option value="{{ $categories_details->id }}">{{ $categories_details->cat_title }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput">Product Title</label>
                                                <input name="prod_title" type="text" class="form-control" id="formGroupExampleInput" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput">Enter Same slug as old site</label>
                                                <input name="prod_slug" type="text" class="form-control" id="formGroupExampleInput" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-6 col-md-6 col-md-12">
                                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                                <label>Upload (Title Image) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                <label class="custom-file-container__custom-file" >
                                                    <input name="prod_title_image" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" required>
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-md-12">
                                            <div class="custom-file-container" data-upload-id="mySecondImage">
                                                <label>Upload (Allow Multiple) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                <label class="custom-file-container__custom-file" >
                                                    <input name="prod_multiple_image[]" type="file" class="custom-file-container__custom-file__custom-file-input" multiple required>
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 row-border">
                                        <div class="col">
                                        <div class="form-group mb-4">
                                            <label for="formGroupExampleInput">Short Description</label>
                                            <textarea style="height:200px;" name="prod_short_description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 row-border">
                                        <div class="col">
                                        <div class="form-group mb-4">
                                            <label for="formGroupExampleInput">Detail Description</label>
                                            <textarea name="prod_detail_description" class="form-control"></textarea>
                                        </div>
                                        </div>
                                    </div>
                                    <h6>Product Specifications:</h6>
                                    <div class="row mb-4">
                                        <div class="col-lg-5 col-md-5 col-md-12">
                                            <input type="text" class="form-control" placeholder="Specification Name" id="specs_name">
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-md-12">
                                            <input type="text" class="form-control" placeholder="Specification Description" id="specs_des">
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-md-22">
                                            <button id="add_specs" class="btn btn-secondary btn-lg btn-block mb-4 mr-2">ADD</button>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-md-12 col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-4" id="custom_style_table">
                                                <thead>
                                                    <tr>
                                                        <th width="40%">Specification Name</th>
                                                        <th width="60%">Specification Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $detail_specs = \App\Http\Controllers\DashProductsDataController::GetProdSpecification($stocks);?>
                                                @if(!empty($detail_specs))
                                                    @foreach ($detail_specs as $detail_specifications)
                                                    <tr>
                                                        <td>{{$detail_specifications->specs_name}}</td>
                                                        <td>{{$detail_specifications->specs_des}}</td>
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
CKEDITOR.replace( 'prod_detail_description' );
</script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
		});
    	$("#add_specs").click(function(e){
		console.clear();
		e.preventDefault();
		var prod_id = $('#prod_id').val();
		var specs_name = $('#specs_name').val();
		var specs_des = $('#specs_des').val();
		var url = '{{ url('add_new_specification') }}';
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
    });
</script>
<script>
    //First upload
    var firstUpload = new FileUploadWithPreview('myFirstImage')
    //Second upload
    var secondUpload = new FileUploadWithPreview('mySecondImage')
</script>
