<style type="text/css">
	.hide{
		display: none;
	}
</style>
<script>
  $( function() {
   $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
</script>
<div class="row text-center b-t-default" style="border-bottom: 1px solid #d6d6d6; padding-bottom: 15px;">
	<div class="col-2 b-r-default m-t-15">
		<h5>Codes</h5>
		<p class="text-muted m-b-0">
			@if(count($tests_details)>0)
			@foreach($tests_details as $tests_detail)
			{{$tests_detail->code}}, 
			@endforeach
			@endif
		</p>
	</div>
	<div class="col-3 b-r-default m-t-15">
		<h5>Blood Tests</h5>
		<p class="text-muted m-b-0">
			@if(count($tests_details)>0)
			@foreach($tests_details as $tests_detail)
			{{$tests_detail->test_name}}, 
			@endforeach
			@endif
		</p>
	</div>
	<div class="col-2 m-t-15 b-r-default">
		<h5>Total Price</h5>
		<!-- <p class="text-muted m-b-0">£{{(int)$total_price+35}}</p> -->
		<p class="text-muted m-b-0">
			@php
			$total_prices_by_secratry = App\ErpSecretaryToPatient::totalPricesBySecratry($prescribtionDetails->id);
			@endphp
			@if((int)$total_prices_by_secratry > 0)
					£{{(int)$total_prices_by_secratry}}
					@else
					£{{(int)$total_price}}
					@endif
		</p>
	</div>
	<div class="col-2 m-t-15 b-r-default">
		<h5>Consultation ID</h5>
		<p class="text-muted m-b-0">{{$prescribtionDetails->consultation_id}}</p>
	</div>
	<div class="col-3 m-t-15 b-r-default">
		<h5>Special <br>Instruction</h5>
		<p class="text-muted m-b-0">
			
			@foreach($tests_details as $tests_detail)
			@if(!empty($tests_detail->special_instruction))
			{{$tests_detail->special_instruction}}, 
			@endif
			@endforeach
			
		</p>
	</div>
	
</div>

{{ Form::open(['class' => '', 'files' => true, 'url' => 'store_patient_data', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
<div class="row" style="padding: 20px;">
	
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group row">
					<label class="col-lg-6 col-form-label">Urgency</label>
					<div class="col-lg-12 mt-2">
						<div class="radio radio-inline">
							<label class="mr-4">
								<input type="radio" name="urgency" value="Routine" @if ($prescribtionDetails->urgency == 'Routine') checked @endif>
								Routine
							</label>
							<label>
								<input type="radio" name="urgency" value="Urgent" @if ($prescribtionDetails->urgency == 'Urgent') checked @endif>
								Urgent
							</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-6 col-form-label">Fasting</label>
					<div class="col-lg-12 mt-2">
						<div class="radio radio-inline">
							<label class="mr-4">
								<input type="radio" name="fasting" value="yes" @if ($prescribtionDetails->fasting == 'yes') checked @endif>
								Yes
							</label>
							<label>
								<input type="radio" name="fasting" value="no" @if ($prescribtionDetails->fasting == 'no') checked @endif>
								No
							</label>
						</div>
					</div>
				</div>
			<div class="form-group">
				<label for="gp_details"> Clinical details:</label>
				<textarea class="form-control"  name="clinical_details">@if(!empty($prescribtionDetails->clinical_details)){{$prescribtionDetails->clinical_details}}@endif
				</textarea>
			</div>
				<div class="form-group">
					<label for="gp_details"> Additional Instructions:</label>
					<textarea class="form-control" name="aditional_instructions">@if(!empty($prescribtionDetails->aditional_instructions)){{$prescribtionDetails->aditional_instructions}}
						@endif
					</textarea>
				</div>

				<div class="form-group">
					<label for="gp_details"> Total Price:</label>
					<input type="text" class="form-control" id="total_price" name="total_price" value="{{(int)$total_price}}">
				</div>

				<div class="form-group row">
					<label class="col-lg-6 col-form-label">Add Nurse Fee<span class="required" style="color: red;">  </span></label>
					<div class="col-lg-12 mt-2">
						<div class="radio radio-inline">
							<label class="mr-4">
								<input type="radio" name="nurse_fee"  class="yes_nurse_value">
								Yes
							</label>
							<label>
								<input type="radio" name="nurse_fee"  class="no_nurse_value"  checked="checked">
								No
							</label>
						</div>
					</div>
				</div>

			</div>
			<div class="col-lg-6">
				<div class="form-group row">
					<label class="col-lg-6 col-form-label">ForeName<span class="required" style="color: red;"> (* Required) </span><span class="required" style="color: red;"> </span></label>
					<div class="col-lg-12">
						<input type="text" class="form-control" name="forename" required="required">
						<input type="hidden" class="form-control" value="{{$prescribe_id}}" name="prescribe_id" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-6 col-form-label">Surname<span class="required" style="color: red;"> (* Required) </span><span class="required" style="color: red;"> </span></label>
					<div class="col-lg-12">
						<input type="text" class="form-control" name="surname" required="required">
						<input type="hidden" class="form-control" value="{{$prescribe_id}}" name="prescribe_id" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-6 col-form-label">Gender<span class="required" style="color: red;"> (* Required) </span></label>
					<div class="col-lg-12 mt-2">
						<div class="radio radio-inline">
							<label class="mr-4">
								<input type="radio" name="gender" value="male" checked="checked">
								Male
							</label>
							<label>
								<input type="radio" name="gender" value="female">
								Female
							</label>
						</div>
					</div>
				</div>
				<div class="form-group date">
					<label for="date_of_birth">Date of birth: <span class="required"> </span></label>
					<input type="text" class="form-control" name="date_of_birth"/>
				
				</div>
				<div class="form-group row">
					<label class="col-lg-6 col-form-label">Email<span class="required" style="color: red;"> (Required *) </span></label>
					<div class="col-lg-12">
						<input type="email" class="form-control" name="email" required="required">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-6 col-form-label">Mobile</label>
					<div class="col-lg-12">
						<input type="text" class="form-control" name="mobile">
					</div>
				</div>
				
				<div class="form-group">
					<label for="gp_details"> Address:</label>
					<textarea class="form-control"  name="address" placeholder="address"></textarea>
				</div>
				<div class="form-group row">
					<label class="col-lg-6 col-form-label">Timing<span class="required" style="color: red;">  </span></label>
					<div class="col-lg-12 mt-2">
						<div class="radio radio-inline">
							<label class="mr-4">
								<input type="radio" name="timing_radio"  value="asap" class="timing" checked>
								ASAP
							</label>
							<label>
								<input type="radio" name="timing_radio"  value="date" class="timing">
								Enter Date
							</label>
						</div>
					</div>
				</div>
				<div class="form-group hide timing_wrap">
					<label for="enter_date">Enter Date: <span class="required"> (*) </span></label>
					<!-- <input type="date" class="form-control" name="timing"/> -->
					<input type="text" class="form-control" name="timing"/>
					
				</div>
				

				<!-- <div class="form-group">
					<label for="gp_details" class="mr-2"> Request For Payment:</label>
					<input type="checkbox" value="1" name="request_payment">
				</div> -->
				<div class="row text-right">
					<button type="submit" class="btn btn-success text-right pull-right">Send</button>  
				</div>
			</div>


		</div>
	</div>
</div>
<script type="text/javascript">
	$(".timing").click(function(){
  // alert($(this).val());
  if($(this).val() == 'asap'){
  	$(".timing_wrap").hide();
  }
  else{
  	$(".timing_wrap").show();
  }
});


$(".yes_nurse_value").click(function(){
   var total_price = $('#total_price').val();
   $("#total_price").val(Number(total_price)+Number(35));

 });


$(".no_nurse_value").click(function(){
   var total_price = $('#total_price').val();
   $("#total_price").val(Number(total_price)-Number(35));

 });
</script>
{{ Form::close()}}