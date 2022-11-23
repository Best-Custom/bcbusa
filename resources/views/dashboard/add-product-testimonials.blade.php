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
                                <h4 class="justify-tab">Manage Testimonials</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area justify-tab">
                        
                        <ul class="nav nav-tabs  mb-3 mt-3 nav-fill" id="justifyTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="justify-home-tab" data-toggle="tab" href="#justify-home" role="tab" aria-controls="justify-home" aria-selected="true">ADD NEW TESTIMONIALS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="justify-profile-tab" data-toggle="tab" href="#justify-profile" role="tab" aria-controls="justify-profile" aria-selected="false">LIST OF TESTIMONIALS</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="justifyTabContent">
                            <div class="tab-pane fade show active" id="justify-home" role="tabpanel" aria-labelledby="justify-home-tab">
                                
                        <div class="col-lg-12 col-12 layout-spacing">
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
                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-md-12 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput">Assign testimonials to products</label>
                                                <select name="prod_id[]" id="selected_prod_id" class="form-control tagging" multiple="multiple">
                                                @if(!empty($product_list))
                                                @foreach ($product_list as $list)
                                                    <option value="{{$list->id}}">{{$list->prod_title}}</option>
                                                @endforeach
                                                @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-md-12 col-md-12">
                                            <table class="table table-bordered mb-4" id="faq_table">
                                            <thead>
                                                <tr>
                                                    <th>Person Name</th>
                                                    <th>Designation</th>
                                                    <th>Message</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="create_row_1">
                                                    <td><input name="name" type="text" class="form-control faq_question"></td>
                                                    <td><input name="designation" type="text" class="form-control faq_answer"></td>
                                                    <td><textarea name="message" id="" cols="30" rows="2"></textarea></td>
                                                    <td><span class="btn btn-danger btn-sm btn-block remove_row" id="row_1">REMOVE</span>
                                                    <span class="btn btn-secondary btn-sm btn-block add_one_more" id="row_1">ADD MORE</span></td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-md-12 col-md-12">
                                        <span class="btn btn-secondary btn-lg submiit_details">SUBMIT DETAILS</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                            <!-- END FIRST SECTION -->
                        <div class="tab-pane fade" id="justify-profile" role="tabpanel" aria-labelledby="justify-profile-tab">
                            <div class="row layout-top-spacing">
                                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                    <div class="widget-content widget-content-area br-6" style="padding:50px;">
                                        <p class="">Select Product And Find Relevent FAQs</p>
                                        <div class="input-group mb-4">
                                        <select class="form-control  basic" id="prod_testim">
                                        <option></option>
                                            @if(!empty($product_list))
                                                @foreach ($product_list as $list)
                                                    <option value="{{$list->id}}">{{$list->prod_title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                    <div class="widget-content widget-content-area br-6">
                                        <div class="table-responsive mb-4 mt-4">
                                        <table id="style-3" class="table style-3  table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Message</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="testimlist">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".remove_row").hide();
    $(document).on("click", ".add_one_more", function(e){
    console.clear();
    var row_id = $(this).attr("id").split("_").pop();
    var new_id = parseInt(row_id)+1;
    var thisRow = $(this).closest('tr');
    $(thisRow).clone().insertAfter(thisRow);
    var lastRow = $('#faq_table tr:last');
    lastRow.removeClass("create_row_"+row_id).addClass("create_row_"+new_id);
    lastRow.find('input[type=text]').val('');
    lastRow.find('textarea').val('');
    lastRow.find('.add_one_more').attr("id", "row_"+new_id);
    lastRow.find('.remove_row').attr("id", "row_"+new_id);
    thisRow.find('.remove_row').show();
    thisRow.find('.add_one_more').hide();
    lastRow.find('.add_one_more').show();
    });
    $(document).on("click", ".remove_row", function(e){
        $(this).closest('tr').remove();
    });
    // submit form
    $(document).on("click", ".submiit_details", function(e){
        console.clear();
        var errors = 0;
        var selected_prod_id = $("#selected_prod_id").val().toString();
        if(selected_prod_id.length !== 0){
            var values = [];
            var name = [];
            var designation = [];
            var message = [];
            $('#faq_table > tbody  > tr').each(function() {
                var name_inp = $(this).find('td:eq(0)').find(':input').val();
                var designation_inp = $(this).find('td:eq(1)').find(':input').val();
                var message_inp = $(this).find('td:eq(2)').find('textarea').val();
                if(name_inp.length == 0 || designation_inp.length == 0 ||  message_inp.length == 0 ){
                    errors++;
                    alert("Please Check All Fileds");
                }else{
                    name.push(name_inp);
                    designation.push(designation_inp);
                    message.push(message_inp);
                }
            });
        }else{
            errors++;
            alert("Please Check All Fileds");
        }
        // if no error form submit
        if(errors == 0){
            $.ajax({
                url:'{{url("/storeprodtestimonials")}}',
                type:'POST',
                data:{
                        'prod_id':selected_prod_id, 
                        'name':name.join('|'),
                        'designation':designation.join('|'),
                        'message':message.join('|')
                        },
                success:function(response){
                    if(response.success){
                        location.reload(true);
                    }else{
                        alert("Error")
                    }
                },
                error:function(error){
                    console.log(error)
                }
            });
        }
    });

    $(document).on("change", "#prod_testim", function(e){
		console.clear();
        var prod_id = $(this).val();
        $.ajax({
                url:'{{url("/fetchtestimlist")}}',
                type:'POST',
                data:{
                        'prod_id':prod_id, 
                    },
                success:function(response){
                    $("#testimlist").html("");
                    $("#testimlist").append(response);
                },
                error:function(error){
                    console.log(error)
                }
        });
    });
});
</script>
</body>
</html>