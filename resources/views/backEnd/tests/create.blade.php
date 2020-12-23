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
		<h5>Upload Excel</h5>
		<a href="{{ url('test') }}" style="float: right; padding: 8px;" class="btn btn-success"> All Tests </a>
	</div>
	<div class="card-block">
		{{ Form::open(['class' => '', 'files' => true, 'url' => 'store_excel', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
		<div class="form-group col-md-3">
									<label for="patient_id">Upload: <span class="required"> (*) </span></label>
									<input type="file" class="form-control  {{ $errors->has('patient_id') ? ' is-invalid' : '' }}"  name="file" />
									@if ($errors->has('patient_id'))
									<span class="invalid-feedback" role="alert" >
										<span class="messages"><strong>{{ $errors->first('patient_id') }}</strong></span>
									</span>
									@endif
								</div>

		<div class="form-group row mt-5">
			<div class="col-sm-12 text-center">
				<a class="btn btn-danger m-b-0" href="{{url('patient')}}">Cancel</a>
				<button type="submit" class="btn btn-primary m-b-0">Save</button>
			</div>
		</div>
		{{ Form::close()}}
	</div>
</div>

@endSection