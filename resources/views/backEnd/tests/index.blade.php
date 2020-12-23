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
		<div class="alert alert-success mb-3 background-success" role="alert" style="font-size: 24px;">
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
	<div class="card">
	
		{{ Form::open(['class' => '', 'files' => true, 'url' => 'search_test', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
			<div class="row" style="margin-left: 30px; margin-top: 30px; margin-bottom: 30px; margin: 0 auto; padding: 40px; border:2px solid #FFFFE1;">
			
			<div class="col-lg-3"></div>
			<div class="form-group col-md-3">
				<label for="code"><strong>Search for and request bloods/tests</strong> <span class="required"> </span></label>
				<input type="text" class="form-control  {{ $errors->has('code') ? ' is-invalid' : '' }}" value="{{ old('code') }}" name="search_result" required="required" />
				@if ($errors->has('code'))
				<span class="invalid-feedback" role="alert" >
					<span class="messages"><strong>{{ $errors->first('code') }}</strong></span>
				</span>
				@endif
			</div>
			
			<div class="form-group col-md-3 mt-4">
				<button type="submit" class="btn btn-primary m-b-0">Search</button>
			</div>
		</div>
		{{ Form::close()}}
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-12 main-section">

			</div>
		</div>
	</div>
@endSection