@extends('backEnd.master')
@section('mainContent')
<div class="row">

	<div class="col-xl-3 col-md-6">
		<div class="card">
			<div class="card-block">
				<a href="{{ url('test') }}">
				<div class="row align-items-center m-l-0">
					<div class="col-auto">
						<i class="fa fa-book f-30 text-c-purple"></i>
					</div>
					<div class="col-auto">
						<h6 class="text-muted m-b-10">Total Tests</h6>
						<h2 class="m-b-0">{{count($Patient)}}</h2>
					</div>
				</div>
			</a>
			</div>
		</div>
	</div>


</div>

@endsection