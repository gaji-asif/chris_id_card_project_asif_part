@extends('backEnd.master')
@section('mainContent')
<div class="row">
	<div class="col-md-4">
	
		<div class="card">
			<div class="card-header">
				<h5>Edit Role</h5>
			</div>
			<div class="card-block">
				{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'role/'.$role->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-form-label">Role Name</label>
								<input type="text" class="form-control {{ $errors->has('role_name') ? ' is-invalid' : '' }}" name="role_name" id="name" placeholder="Add new role" value="{{ $role->role_name }}">

								@if ($errors->has('role_name'))
								<span class="invalid-feedback" role="alert">
									<span class="messages"><strong>{{ $errors->first('role_name') }}</strong></span>
								</span>
								@endif
							</div>
						</div>
					</div>
					<div class="form-group row mt-4">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-primary m-b-0">Update</button>
						</div>
					</div>
				{{ Form::close()}}
			</div>
		</div>
	</div>

</div>

@endSection