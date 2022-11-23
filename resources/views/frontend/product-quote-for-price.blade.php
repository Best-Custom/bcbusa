@include('frontend.include.header')
	<!-- Breadcrumb Section -->
	<section class="breadcrumb-section section">
		<div class="container">
			<div class="breadcrumb-area">
				<ul class="breadcrumb-ul">
					<li><a href="/">Home</a></li>
					<li class="active-breadcrumb">Get an instant quote</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- End Breadcrumb Section -->	
	<!--  Sent Feedback Section -->
	<form id="qoute_form" action="{{url('/product-quote-for-price')}}" method="POST" enctype="multipart/form-data">
			@csrf
		<section class="section give-feedback-section">
			<div class="container form-container">
					<div class="row">
						<div class="col"><h1>GET AN INSTANT QUOTE</h1></div>
					</div>
					<div class="row mt3">
						<div class="col-md-6">
							<input type="text" class="form-input" placeholder="Your Name" name="your_name" required>
						</div>
						<div class="col-md-6 mob-mar">
							<input type="text" class="form-input" placeholder="Your Email" name="your_email" required>
						</div>
					</div>
					<div class="row mt3">
						<div class="col-md-6">
							<input type="text" class="form-input" placeholder="Your Phone" name="your_phone" required>
						</div>
						<div class="col-md-6 mob-mar">
							<input type="text" class="form-input" placeholder="Subject" name="subject" required>
						</div>
					</div>
					<div class="row mt3">
						<div class="col-md-12">
							<table class="mytable" >
								<tr>
									<th colspan="4">CHOOSE A BOX STYLE FROM STYLE CHART DESIGN</th>
								</tr>
								<tr>
									<td><input type="radio" class="check_box" name="checkBx" value="Regular Cardboard Boxes"></td>
									<td>Regular Cardboard Boxes</td>
									<td><input type="number" name="style_no[]" class="form-input" placeholder="Style no."></td>
									<td>
										<img src="/frontend-assets/assets/images/size_icon.webp" class="size_chart" id="1" data-toggle="tooltip" title="View style no!"/>
									</td>
								</tr>
								<tr>
									<td><input type="radio" class="check_box" name="checkBx" value="Rigid Boxes"></td>
									<td>Rigid Boxes</td>
									<td><input type="number" name="style_no[]" class="form-input" placeholder="Style no."></td>
									<td>
										<img src="/frontend-assets/assets/images/size_icon.webp" class="size_chart" id="0" data-toggle="tooltip" title="View style no!"/>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row mt3">
						<div class="col-md-12">
							<table id="mytable" class="mytable" >
								<tr>
									<th colspan="8"> BOX DETAILS (Add more then one style)</th>
								</tr>
								<tr>
									<td><input type="number" name="length[]" class="form-input" placeholder="Length(inch)" required></td>
									<td><input type="number" name="width[]" class="form-input" placeholder="Width(inch)" required></td>
									<td><input type="number" name="height[]" class="form-input" placeholder="Height(inch)" required></td>
									<td>
									<select name="dimention[]" class="form-input" required>
									<option value="" disabled selected hidden>Choose Unit</option>
										<option value="inch">inch</option>
										<option value="cm">cm</option>
										<option value="mm">mm</option>
									</select>
									</td>
									<td><input type="number" name="quantity[]" class="form-input" placeholder="Quantity" required></td>
									<td>
									<select name="colours[]" class="form-input" required>
									<option value="" disabled selected hidden>Choose Type</option>
										<option value="Plain">Plain</option>
										<option value="Printed">Printed</option>
									</select>
									</td>
									<td><input type="file" name="upload_file_image[]" class="choose"></td>
									<td><span class="one_row_plus"><i class="fa fa-plus-square"></i></span></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row mt3">
						<div class="col-md-12">
						<textarea name="your_message" class="form-control" cols="30" rows="5" placeholder="Message..."></textarea>
						</div>
					</div>
					<div class="row mt2">
						<div class="col-md-12">
						<input type="submit" class="btn btn-success" name="send_email">
						</div>
					</div>
			</div>
		</section>	
	</form>
	<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" data-dismiss="modal">
			<div class="modal-content"  >              
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<img src="" class="imagepreview" style="width: 100%;" >
			</div> 
			</div>
		</div>
	</div>	
	<!--  End Sent Feedback Section -->	
@include('frontend.include.footer')
<!-- Google form recaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	// create row
	$(document).on('click', '.one_row_plus', function(){
		var row = $('#mytable tr:last');
		row.clone().insertBefore('#mytable tr:last');
		row.find('input').val('');
		new_row = row.find('td:last').find('.one_row_plus');
		new_row.addClass('one_row_minus').removeClass('one_row_plus');
		new_row.html('<i class="fa fa-minus-square"></i>');
	});
	// remove row
	$(document).on('click', '.one_row_minus', function(){
		$(this).closest('tr').remove();
	});
	$('.size_chart').on('click', function() {
		var id_s = parseInt($(this).attr('id'));
		if(id_s == 0){
			$('.imagepreview').attr('src', '/frontend-assets/assets/images/rigid-box-style-chart.jpg');
			$('#imagemodal').modal('show');   
		}else{
			$('.imagepreview').attr('src', '/frontend-assets/assets/images/box-style-chart.jpg');
			$('#imagemodal').modal('show');  
		}
	});
});
</script>