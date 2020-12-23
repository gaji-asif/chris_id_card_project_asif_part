<style type="text/css">
	.hide{
		display: none;
	}
</style>

<script>
  $( function() {
    $( ".datepicker" ).datepicker();
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
		<p class="text-muted m-b-0">£{{(int)$total_price+35}}</p>
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

{{ Form::open(['class' => '', 'files' => true, 'url' => 'store_payment_data_man', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
<div class="row" style="padding: 20px;">
	
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-6">
				<?php $amount = (int)$total_price+35; ?>
				<div class="form-group row">
					<label class="col-lg-6 col-form-label">Amount<span class="required" style="color: red;"> </span></label>
					<div class="col-lg-12">
						<input type="text" class="form-control" name="amount" required="required" value="{{$amount}}" readonly>
						<input type="hidden" class="form-control" value="{{$prescribe_id}}" name="prescribe_id" >
					</div>
				</div>
				
			
				

			</div>
		
			<div class="col-lg-6">
				<div class="form-group timing_wrap">
					<label for="enter_date">Receive Date:</label>
					<input type="" class="form-control datepicker {{ $errors->has('enter_date') ? ' is-invalid' : '' }}" value="{{ old('enter_date') }}" name="receive_date"/>
					@if ($errors->has('enter_date'))
					<span class="invalid-feedback" role="alert" >
						<span class="messages"><strong>{{ $errors->first('enter_date') }}</strong></span>
					</span>
					@endif
				</div>
			</div>

		</div>
		<div class="row text-right">
					<button type="submit" class="btn btn-success text-right pull-right">Receive</button>  
				</div>
	</div>
</div>

{{ Form::close()}}