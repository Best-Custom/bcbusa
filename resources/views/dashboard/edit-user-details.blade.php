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
                                <h4 class="justify-tab">Manage Users</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area justify-tab">
                        
                        

                        <div class="tab-content" id="justifyTabContent">
                            <div class="tab-pane fade show active" id="justify-home" role="tabpanel" aria-labelledby="justify-home-tab">
                                
                        <div class="col-lg-12 col-12 layout-spacing">
                            <div class="widget-content widget-content-area">
                            @if(session()->has('errors'))
                            <div class="row mb-4">
                                <div class="col-lg-12 col-md-12 col-md-12">
                                <div class="alert alert-danger mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>{{Session::get('errors')}}</strong></button>
                                </div>
                                </div>
                            </div>
                            @endif
                            @if(session()->has('success'))
                            <div class="row mb-4">
                                <div class="col-lg-12 col-md-12 col-md-12">
                                <div class="alert alert-success mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>{{Session::get('success')}}</strong></button>
                                </div>
                                </div>
                            </div>
                            @endif
                                <form action="{{url('update-user')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-4">
                                        <div class="col-lg-6 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput1">Assign Role</label>
                                                <select name="user_role" id="formGroupExampleInput1" class="form-control" required>
                                                    <option></option>
                                                    <option value="1" @if($user_details->user_role == 1) {{'selected'}} @endif>SEO MANAGER</option>
                                                    <option value="2" @if($user_details->user_role == 2) {{'selected'}} @endif>SEO EXPERT</option>
                                                    <option value="3" @if($user_details->user_role == 3) {{'selected'}} @endif>HR MANAGER</option>
                                                    <option value="4" @if($user_details->user_role == 4) {{'selected'}} @endif>REGULER USER</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput2">Status</label>
                                                <select name="status" for="formGroupExampleInput2" class="form-control" required>
                                                    <option></option>
                                                    <option value="0" @if($user_details->status == 0) {{'selected'}} @endif>ENABLE</option>
                                                    <option value="1" @if($user_details->status == 1) {{'selected'}} @endif>DISABLE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-6 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="formGroupExampleInput3">Full Name</label>
                                                <input type="text" name="name" class="form-control" id="exampleFormControlInput3" value="{{$user_details->name}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="foremail">Email</label>
                                                <input  type="email" name="email" class="form-control" id="foremail" value="{{$user_details->email}}" required>
                                                <div class="form-helper shw_alrt"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-6 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="foremail">Old Password</label>
                                                <div class="input-group pass_div_0">
                                                    <input type="password" name="old_password" class="form-control" id="ch_type_0" aria-label="notification" aria-describedby="show_passws_0" minlength="7">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text show_passws_0" id="show_passws_0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg></span>
                                                        <span class="input-group-text hide_passwd_0" id="hide_passwd_0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>
                                                    </div>
                                                </div>
                                                <div class="form-helper shw_pass_0"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="foremail">New Password</label>
                                                <div class="input-group pass_div_1">
                                                    <input type="password" name="new_password" class="form-control" id="ch_type_1"  aria-label="notification" aria-describedby="show_passws" minlength="7">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text show_passws_1" id="show_passws_1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg></span>
                                                        <span class="input-group-text hide_passwd_1" id="hide_passwd_1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>
                                                    </div>
                                                </div>
                                                <div class="form-helper shw_pass_1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-md-12 col-md-12">
                                            <input type="hidden" name="user_id" value="{{$user_details->id}}" >
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
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // email
    $(document).on("change keyup input","#foremail", function(){
        var input_value = $(this).val();
        $.ajax({
	        url: "{{ url('check-unique-email') }}",
	        type:"POST",
	        data:{
	          "input_value": input_value
	        },
	        success:function(response){
                console.log(response);
	          if(response == 1) {
	          	$("#foremail").css('border','3px solid #c32424');
				$(".shw_alrt").text("Not available !").css('color','#c32424');
				$(".shw_alrt").show();

	          }else{
	          	$(".shw_alrt").text("Available !").css('color','#24b91a');
				$(".shw_alrt").show();
	          	$("#foremail").css('border','3px solid #24b91a');
	          }
	        },
	        error: function(error) {
	         console.log(error);
	        }
	       });
    });
    // old password
    $('form *').prop('autocomplete', 'off');
    $('.hide_passwd_0').hide();
    $('.hide_passwd_1').hide();
    $(document).on('click', '.show_passws_0', function(){
        $('#ch_type_0').prop('type', 'text');
        $('.hide_passwd_0').show();
        $('.show_passws_0').hide();
    });
    $(document).on('click', '.hide_passwd_0', function(){
        $('#ch_type_0').prop('type', 'password');
        $('.hide_passwd_0').hide();
        $('.show_passws_0').show();
    });
    // new pssword
    $(document).on('click', '.show_passws_1', function(){
        $('#ch_type_1').prop('type', 'text');
        $('.hide_passwd_1').show();
        $('.show_passws_1').hide();
    });
    $(document).on('click', '.hide_passwd_1', function(){
        $('#ch_type_1').prop('type', 'password');
        $('.hide_passwd_1').hide();
        $('.show_passws_1').show();
    });
    // old password length
    $(document).on("keyup","#ch_type_0", function(){
        var input_value = $(this).val();
        console.log(input_value);
        if(input_value.length <= 6) {
	          	$(".pass_div_0").css('border','3px solid #c32424');
				$(".shw_pass_0").text("Password should more then 6 character !").css('color','#c32424');
				$(".shw_pass_0").show();

	          }else{
	          	$(".shw_pass_0").text("Perfect !").css('color','#24b91a');
				$(".shw_pass_0").show();
	          	$(".pass_div_0").css('border','3px solid #24b91a');
	          }
    });
    // new password length
    $(document).on("keyup","#ch_type_1", function(){
        var input_value = $(this).val();
        if(input_value.length <= 6) {
	          	$(".pass_div_1").css('border','3px solid #c32424');
				$(".shw_pass_1").text("Password should more then 6 character !").css('color','#c32424');
				$(".shw_pass_1").show();

	          }else{
	          	$(".shw_pass_1").text("Perfect !").css('color','#24b91a');
				$(".shw_pass_1").show();
	          	$(".pass_div_1").css('border','3px solid #24b91a');
	          }
    });
});
</script>
</body>
</html>