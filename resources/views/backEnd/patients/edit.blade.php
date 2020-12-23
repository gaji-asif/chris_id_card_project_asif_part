@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
p{
	font-size: 15px;
}
.required {
	color: red;
}
</style>
<div class="card">
	<div class="card-header">
		<h5>Edit Patient</h5>
		<a href="{{ url('patient') }}" style="float: right; padding: 8px;" class="btn btn-success"> All Patients </a>
	</div>
	<div class="card-block">
		{{ Form::open(['class' => '', 'files' => true, 'url' => 'patient/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}

		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a aria-controls="home" aria-selected="true" class="nav-link active" data-toggle="tab" href="#create_new_patient" id="create_new_patient_tab" role="tab">Patient Demographics</a>
					</li>
					<li class="nav-item">
						<a aria-controls="profile" aria-selected="false" class="nav-link" data-toggle="tab" href="#support_plan" id="support_plan_tab" role="tab">Support Plan</a>
					</li>
					<li class="nav-item">
						<a aria-controls="contact" aria-selected="false" class="nav-link" data-toggle="tab" href="#behaviour" id="behaviour_tab" role="tab">Behaviour</a>
					</li>
					<li class="nav-item">
						<a aria-controls="contact" aria-selected="false" class="nav-link" data-toggle="tab" href="#communication" id="communication_tab" role="tab">Communication</a>
					</li>
					<li class="nav-item">
						<a aria-controls="contact" aria-selected="false" class="nav-link" data-toggle="tab" href="#daily_living_skills" id="daily_living_skills_tab" role="tab">Daily Living Skills</a>
					</li>
					<li class="nav-item">
						<a aria-controls="contact" aria-selected="false" class="nav-link" data-toggle="tab" href="#education" id="education_tab" role="tab">Education</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div aria-labelledby="create_new_patient_tab" class="tab-pane fade show active" id="create_new_patient" role="tabpanel">
						<div class="row">
							<div class="col-md-12 pull-right">
								<a  href="{{url('patient_demog/'.$editData->id)}}" class="btn btn-success pull-right mt-4"> Download Demographics </a>
							</div>
							
						</div>
						<div class="col-md-12 pt-4">
							<div class="row">

								<div class="form-group col-md-3">
									<label for="patient_id">Patient ID: <span class="required"> (*) </span></label>
									<input type="text" class="form-control  {{ $errors->has('patient_id') ? ' is-invalid' : '' }}" value="{{$editData->patient_id}}" name="patient_id" />
									@if ($errors->has('patient_id'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('patient_id') }}</strong></span>
									</span>
									@endif
								</div>

								<div class="form-group col-md-3">
									<label for="title">Title:</label>
									<input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $editData->title }}" name="title"/>
									@if ($errors->has('title'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('title') }}</strong></span>
									</span>
									@endif
								</div>

								<div class="form-group col-md-6">
									<label for="first_name">First Name: <span class="required"> (*) </span></label>
									<input type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ $editData->first_name }}" name="first_name"/>
									@if ($errors->has('first_name'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('first_name') }}</strong></span>
									</span>
									@endif
								</div>

							</div>

							<div class="row">
								<div class="form-group col-md-6">
									<label for="middle_name">Middle Name: <span class="required"> (*) </span></label>
									<input type="text" class="form-control {{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{ $editData->last_name }}" name="middle_name"/>
									@if ($errors->has('middle_name'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('middle_name') }}</strong></span>
									</span>
									@endif
								</div>
								<div class="form-group col-md-6">
									<label for="sur_name">Surname: <span class="required"> (*) </span></label>
									<input type="text" class="form-control {{ $errors->has('sur_name') ? ' is-invalid' : '' }}" value="{{ $editData->sur_name }}" name="sur_name"/>
									@if ($errors->has('sur_name'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('sur_name') }}</strong></span>
									</span>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-3">
									<label for="mobile">Mobile:</label>
									<input type="text" class="form-control {{ $errors->has('mobile') ? ' is-invalid' : '' }}" value="{{ $editData->mobile }}" name="mobile"/>
									@if ($errors->has('mobile'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('mobile') }}</strong></span>
									</span>
									@endif
								</div>

								<div class="form-group col-md-3">
									<label for="nhs_no">NHS No:</label>
									<input type="text" class="form-control {{ $errors->has('nhs_no') ? ' is-invalid' : '' }}" value="{{ $editData->nhs_no }}" name="nhs_no"/>
									@if ($errors->has('nhs_no'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('nhs_no') }}</strong></span>
									</span>
									@endif
								</div>

								<div class="form-group col-md-3">
									<label for="date_of_birth">Date of birth: <span class="required"> (*) </span></label>
									<input type="" class="form-control datepicker {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" @if(isset($editData->date_of_birth)) 
									value="{{ date('d-m-Y', strtotime($editData->date_of_birth)) }}"
									@endif name="date_of_birth"/>
									@if ($errors->has('date_of_birth'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('date_of_birth') }}</strong></span>
									</span>
									@endif
								</div>

								<div class="form-group col-md-3">
									<label for="date_of_death">Date of Death:</label>
									<input type="" class="form-control datepicker {{ $errors->has('date_of_death') ? ' is-invalid' : '' }}" @if(isset($editData->date_of_death)) 
									value="{{ date('d-m-Y', strtotime($editData->date_of_death)) }}"
									@endif name="date_of_death"/>
									@if ($errors->has('date_of_death'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('date_of_death') }}</strong></span>
									</span>
									@endif
								</div>
							</div>


							<div class="row">
								<div class="form-group col-md-3">
									<label for="next_of_kin">Next to kin:</label>
									<input type="text" class="form-control {{ $errors->has('next_of_kin') ? ' is-invalid' : '' }}" value="{{ $editData->next_of_kin }}" name="next_of_kin"/>
									@if ($errors->has('next_of_kin'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('next_of_kin') }}</strong></span>
									</span>
									@endif
								</div>
								<div class="form-group col-md-3">
									<label for="post_code">PostCode:</label>
									<input type="text" class="form-control {{ $errors->has('post_code') ? ' is-invalid' : '' }}" value="{{ $editData->post_code }}" name="post_code"/>
									@if ($errors->has('post_code'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('post_code') }}</strong></span>
									</span>
									@endif
								</div>
								<div class="form-group col-md-6">
									<label for="address"> Address:</label>
									<textarea class="form-control"  name="address">{{$editData->address}}</textarea>
								</div>
							</div>

							<div class="row">


								<div class="form-group col-md-6">
									<label for="gp_details"> GP details:</label>
									<textarea class="form-control" name="gp_details">{{$editData->gp_details}}</textarea>
								</div>
							</div>
						</div>
					</div>
					<div aria-labelledby="support_plan_tab" class="tab-pane fade" id="support_plan" role="tabpanel">
						<div class="row">
							<div class="col-md-12 pull-right">
								<a  href="{{url('support_plan/'.$editData->id)}}" class="btn btn-success pull-right mt-4"> Download Support plan </a>
							</div>
							
						</div>
						<div class="col-md-12 pt-4">
							@if(isset($editData))
							@php 
							$editDatas = explode(',' ,$editData->support_plan);
							@endphp
							@endif 
							@if(isset($support_plans))
							@foreach($support_plans as $support_plan)
							<div class="checkbox">
								<label><input type="checkbox" name="support_plan[]" value="{{$support_plan->id}}"
									@foreach($editDatas as $value)
									@if($support_plan->id == $value)
									checked
									@endif
									@endforeach
									> {{$support_plan->plan_name}}</label>
								</div>
								@endforeach
								@endif
							</div>
						</div>
						<div aria-labelledby="behaviour_tab" class="tab-pane fade" id="behaviour" role="tabpanel">

							<div class="col-md-12 pt-4">

								<a  href="{{url('generatePDF/'.$editData->id)}}" class="btn btn-success pull-right"> Download as Pdf </a>
								<br>

								<script type="text/javascript" src="http://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
								<label><strong>Behaviour Details:</strong></label>
								<textarea  id="editor" name="behaviour" rows="50" cols="80">
									{{$editData->behaviour}}
								</textarea>
								<script>
									CKEDITOR.replace('editor');
								</script>
							</div> 
							
							<div class="col-md-12 pt-4">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="position">Position:</label>
										<input type="text" class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ $editData->position }}" name="position"/>
										@if ($errors->has('position'))
										<span class="invalid-feedback" role="alert" >
											<span class="messages"><strong>{{ $errors->first('position') }}</strong></span>
										</span>
										@endif
									</div> 
									<div class="form-group col-md-4">
										<label for="position">Signature:</label> 
										<input class="primary-input form-control" type="file" id="placeholderStaffsName" placeholder="" name="signature">
									</div> 
									<div class="form-group col-md-3">
										<label for="behabiour_date">Date:</label>
										<input type="" class="form-control datepicker {{ $errors->has('behabiour_date') ? ' is-invalid' : '' }}" @if(isset($editData->behabiour_date)) 
										value="{{ date('d-m-Y', strtotime($editData->behabiour_date)) }}"
										@endif name="behabiour_date"/>
										@if ($errors->has('behabiour_date'))
										<span class="invalid-feedback" role="alert" >
											<span class="messages"><strong>{{ $errors->first('behabiour_date') }}</strong></span>
										</span>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div aria-labelledby="communication_tab" class="tab-pane fade" id="communication" role="tabpanel">

							<div class="col-md-12 pt-4">

								<!-- <a  href="{{url('generatePDF/'.$editData->id)}}" class="btn btn-success pull-right"> Download as Pdf </a>
								<br> -->
								<label><strong>Communication Details:</strong></label>
								<textarea class="ckeditor" id="" name="communication" rows="50" cols="80">
									{{$editData->communication}}
								</textarea>
								<script>
									CKEDITOR.replace('editor1');
								</script>
							</div> 
							
							<!-- <div class="col-md-12 pt-4">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="position">Position:</label>
										<input type="text" class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ $editData->position }}" name="position"/>
										@if ($errors->has('position'))
										<span class="invalid-feedback" role="alert" >
											<span class="messages"><strong>{{ $errors->first('position') }}</strong></span>
										</span>
										@endif
									</div> 
									<div class="form-group col-md-4">
										<label for="position">Signature:</label> 
										<input class="primary-input form-control" type="file" id="placeholderStaffsName" placeholder="" name="signature">
									</div> 
									<div class="form-group col-md-3">
										<label for="behabiour_date">Date:</label>
										<input type="" class="form-control datepicker {{ $errors->has('behabiour_date') ? ' is-invalid' : '' }}" @if(isset($editData->behabiour_date)) 
										value="{{ date('d-m-Y', strtotime($editData->behabiour_date)) }}"
										@endif name="behabiour_date"/>
										@if ($errors->has('behabiour_date'))
										<span class="invalid-feedback" role="alert" >
											<span class="messages"><strong>{{ $errors->first('behabiour_date') }}</strong></span>
										</span>
										@endif
									</div>
								</div>
							</div> -->
						</div>

						<div aria-labelledby="daily_living_skills" class="tab-pane fade" id="daily_living_skills" role="tabpanel">

							<div class="col-md-12 pt-4">

								<!-- <a  href="{{url('generatePDF/'.$editData->id)}}" class="btn btn-success pull-right"> Download as Pdf </a>
								<br> -->

								
								<label><strong>Daily Living Skills Details:</strong></label>
								<textarea  class="ckeditor" id="" name="daily_living_skills" rows="50" cols="80">
									{{$editData->daily_living_skills}}
								</textarea>
								<script>
									CKEDITOR.replace('editor');
								</script>
							</div> 
							
							<!-- <div class="col-md-12 pt-4">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="position">Position:</label>
										<input type="text" class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ $editData->position }}" name="position"/>
										@if ($errors->has('position'))
										<span class="invalid-feedback" role="alert" >
											<span class="messages"><strong>{{ $errors->first('position') }}</strong></span>
										</span>
										@endif
									</div> 
									<div class="form-group col-md-4">
										<label for="position">Signature:</label> 
										<input class="primary-input form-control" type="file" id="placeholderStaffsName" placeholder="" name="signature">
									</div> 
									<div class="form-group col-md-3">
										<label for="behabiour_date">Date:</label>
										<input type="" class="form-control datepicker {{ $errors->has('behabiour_date') ? ' is-invalid' : '' }}" @if(isset($editData->behabiour_date)) 
										value="{{ date('d-m-Y', strtotime($editData->behabiour_date)) }}"
										@endif name="behabiour_date"/>
										@if ($errors->has('behabiour_date'))
										<span class="invalid-feedback" role="alert" >
											<span class="messages"><strong>{{ $errors->first('behabiour_date') }}</strong></span>
										</span>
										@endif
									</div>
								</div>
							</div> -->
						</div>

						<div aria-labelledby="education_tab" class="tab-pane fade" id="education" role="tabpanel">

							<div class="col-md-12 pt-4">

								<!-- <a  href="{{url('generatePDF/'.$editData->id)}}" class="btn btn-success pull-right"> Download as Pdf </a>
								<br> -->
								<label><strong>Edication Details:</strong></label>
								<textarea class="ckeditor" id="" name="education" rows="50" cols="80">
									{{$editData->education}}
								</textarea>
								<script>
									CKEDITOR.replace('editor');
								</script>
							</div> 
							
							<!-- <div class="col-md-12 pt-4">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="position">Position:</label>
										<input type="text" class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ $editData->position }}" name="position"/>
										@if ($errors->has('position'))
										<span class="invalid-feedback" role="alert" >
											<span class="messages"><strong>{{ $errors->first('position') }}</strong></span>
										</span>
										@endif
									</div> 
									<div class="form-group col-md-4">
										<label for="position">Signature:</label> 
										<input class="primary-input form-control" type="file" id="placeholderStaffsName" placeholder="" name="signature">
									</div> 
									<div class="form-group col-md-3">
										<label for="behabiour_date">Date:</label>
										<input type="" class="form-control datepicker {{ $errors->has('behabiour_date') ? ' is-invalid' : '' }}" @if(isset($editData->behabiour_date)) 
										value="{{ date('d-m-Y', strtotime($editData->behabiour_date)) }}"
										@endif name="behabiour_date"/>
										@if ($errors->has('behabiour_date'))
										<span class="invalid-feedback" role="alert" >
											<span class="messages"><strong>{{ $errors->first('behabiour_date') }}</strong></span>
										</span>
										@endif
									</div>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			</div>

			<div class="form-group row mt-5">
				<div class="col-sm-12 text-center">
					<a class="btn btn-danger m-b-0" href="{{url('patient')}}">Cancel</a>
					<button type="submit" class="btn btn-primary m-b-0">Update</button>
					<a  href="{{url('full_patients_details/'.$editData->id)}}" class="btn btn-success"> Download Patient Details </a>
				</div>
			</div>
			{{ Form::close()}}
		</div>
	</div>

	@endSection
