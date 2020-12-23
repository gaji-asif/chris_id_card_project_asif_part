@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
.right_margin{
	margin-right: 30px;
	color: #000000;
}
.strong_class{
	font-weight: 500;
	font-size: 16px;
}
.card-block{
	background-color: #f3f3f3;
	
}
.media{
	background-color: #FFFFFF;
	padding: 20px;
	padding-top: 40px;
}
</style>
@if(session()->has('message-success'))
<div class="alert alert-danger mb-3 background-danger" role="alert" style="font-size: 24px;">
	{{ session()->get('message-success') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@elseif(session()->has('message-danger'))
<div class="alert alert-danger">
	{{ session()->get('message-danger') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<h5>Test Summary</h5>
				<!-- <a style="float: right; margin: 0 auto; margin-top: -25px;">  -->

					<!-- </a> -->
					<a href="{{ url('test') }}" style="float: right; padding: 11px; margin-right: 25px;  margin-top: -10px;" class="btn btn-success"> Add More Tests </a>

				</div>
				<div class="card-block">

					<div class="row">
						<div class="col-lg-2"></div>
						<div class="card col-lg-8">
							<div class="card-block" style="background-color: #FFFFFF;">
								<div class="row align-items-center">
									<div class="col-8">
										<h4 class="text-c-green">Codes</h4>
										<h6 class="text-muted m-b-0">
											@if(session('cart'))
												 @foreach(session('cart') as $id => $details)
												 {{$details['code']}},
												 @endforeach
										    @endif
										</h6>
									</div>

								</div>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
				</div>

				<div class="card-block" style="margin-top: -50px;">

					<div class="row">
						<div class="col-lg-2"></div>
						<div class="card col-lg-8">
							<div class="card-block" style="background-color: #FFFFFF;">
								<div class="row align-items-center">
									<div class="col-8">
										<h4 class="text-c-green">Total Price</h4>
										<h6 class="text-muted m-b-0">
											<?php
											 	 $price = $total_price;
												 $nurse_price = 35;
												 
											?>
											<?php 
											if($price < 1){
												echo "£0";
											}
											else{
									  echo "£".$total_price." + £35 = "?>£<?php echo $price+$nurse_price;

												echo "£".$total_price;
											}
											
											?>
										</h6>
									</div>

								</div>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
				</div>
				<div class="card-block" style="margin-top: -50px;">

					<div class="row">
						<div class="col-lg-2"></div>
						<div class="card col-lg-8">
							<div class="card-block" style="background-color: #FFFFFF;">
								<div class="row align-items-center">
									<div class="col-8">
										<h4 class="text-c-green">Name of Blood Tests</h4>
										<h6 class="text-muted m-b-0" style="line-height: 2">
											@if(session('cart'))
												 @foreach(session('cart') as $id => $details)
												 {{$details['test_name']}},
												 @endforeach
										    @endif
										</h6>
									</div>

								</div>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
				</div>
				<div class="card-block" style="margin-top: -50px;">

					<div class="row">
						<div class="col-lg-2"></div>
						<div class="card col-lg-8">
							<div class="card-block" style="background-color: #FFFFFF;">
								<div class="row align-items-center">
									<div class="col-8">
										<h4 class="text-c-green">Special Instruction</h4>
										<h6 class="text-muted m-b-0" style="line-height: 2">
											@if(session('cart'))
												 @foreach(session('cart') as $id => $details)
												 @if(!empty($details['special_instruction']))
												 {{$details['special_instruction']}},
												 @endif
												 @endforeach
										    @endif
										</h6>
									</div>

								</div>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
				</div>
				<div class="card-block" style="margin-top: -50px;">
					<div class="row pull-right" style="margin-right: 16%;">
						<a href="{{route('remove_all_tests')}}"><button class="btn btn-danger" id="remove_all_tests">Remove all Tests</button></a>
						</div>
					</div>
				</div>
			</div>

		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">
					<h5>Request Tests</h5>
				</div>
				<div class="card-block">
						{{ Form::open(['class' => '', 'files' => true, 'url' => 'checkout_patient', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
						<div class="row" style="padding: 20px;">
							<div class="col-lg-12">
								<h3 class="mt-1 mb-4">Patient Information</h3>
								<div class="form-group row">
									<label class="col-lg-6 col-form-label">Consultation ID<span class="required" style="color: red;"> (* Required) </span></label>
									<div class="col-lg-12">
										<input type="text" class="form-control" name="consultation_id" required="required">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Urgency<span class="required" style="color: red;"> (* Required) </span></label>
									<div class="col-lg-4 mt-2">
										<div class="radio radio-inline">
											<label class="mr-4">
												<input type="radio" name="urgency" value="Routine" checked="checked">
												Routine
											</label>
											<label>
												<input type="radio" name="urgency" value="Urgent">
												Urgent
											</label>
										</div>
									</div>
									<div class="col-lg-5" style="border:3px solid gray; padding: 5px;">You must inform the operations team if this is an urgent request.</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Fasting</label>
									<div class="col-lg-4 mt-2">
										<div class="radio radio-inline">
											<label class="mr-4">
												<input type="radio" name="fasting" value="yes" >
												Yes
											</label>
											<label>
												<input type="radio" name="fasting" value="no" checked="checked">
												No
											</label>
										</div>
									</div>
									
								</div>
								<!-- <div class="form-group row" style="margin-top: -20px;">
									<label class="col-lg-3 col-form-label">Fasting ?</label>
									<div class="col-lg-9 mt-2" style="margin-left: -55px;">
										<div class="radio radio-inline">
											<label class="mr-4">
												<input type="checkbox" name="fasting" value="yes" >
												
											</label>
											
										</div>
									</div>
								</div> -->
								<div class="form-group">
									<label for="gp_details"> Clinical details:</label>
									<textarea class="form-control"  name="clinical_details" placeholder="ie antibiotics, recent travel history"></textarea>
								</div>
								<div class="form-group">
									<label for="gp_details"> Additional Instructions:</label>
									<textarea class="form-control" name="aditional_instructions" placeholder="ie sample before 10am"></textarea>
								</div>
								<button type="submit" class="btn btn-success">Request Bloods</button>  
								
							</div>
						</div>
						{{ Form::close()}}
					</div>
				</div>
			</div>
		</div>



		@endSection