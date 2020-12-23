@extends('backEnd.master')
@section('mainContent')
<div class="row">
	<div class="col-md-4">
	

		@if(session()->has('message-success'))
		<div class="alert alert-success mb-3 background-success" role="alert">
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
		@if(session()->has('message-success-delete'))
			<div class="alert alert-danger mb-3 background-danger" role="alert">
				{{ session()->get('message-success-delete') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@elseif(session()->has('message-danger-delete'))
			<div class="alert alert-danger">
				{{ session()->get('message-danger-delete') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endif

		<div class="card">
			<div class="card-header">
				<h5>Add New User</h5>
			</div>
			<div class="card-block">
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'user',
				'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
				                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

				                <div class="col-md-6">
				                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" autocomplete="off" >

				                    @if ($errors->has('first_name'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('first_name') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>
				            <div class="form-group row">
				                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

				                <div class="col-md-6">
				                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" autocomplete="off" >

				                    @if ($errors->has('last_name'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('last_name') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

				            <div class="form-group row">
				                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

				                <div class="col-md-6">
				                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete="off">

				                    @if ($errors->has('email'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('email') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

				            <div class="form-group row">
				                <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role ID') }}</label>
				                <div class="col-md-6">
					                <select class="js-example-basic-single col-sm-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" id="role_id">
									<option value="">Select Role ID</option>
									@if(isset($roles))
										@foreach($roles as $role)
											<option value="{{ $role->id }}" {{ old('role_id')== $role->id ? 'selected' : ''  }} >{{$role->role_name}}</option>
										@endforeach
									@endif
									</select>
									@if ($errors->has('role_id'))
									<span class="invalid-feedback invalid-select" role="alert">
										<strong>{{ $errors->first('role_id') }}</strong>
									</span>
									@endif
								</div>
				            </div>

				            <div class="form-group row">
				                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

				                <div class="col-md-6">
				                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

				                    @if ($errors->has('password'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('password') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>


				            <div class="form-group row">
				                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

				                <div class="col-md-6">
				                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
				                </div>
				            </div>
						</div>
					</div>
					<div class="form-group row mt-4">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-primary m-b-0">Add user</button>
						</div>
					</div>
				{{ Form::close()}}
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h5>Users</h5>
			</div>
			<div class="card-block">
				<div class="dt-responsive table-responsive">
				<table id="basic-btn" class="table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th>User id</th>
							<th>User Name</th>
							<th>Email</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($users))
							@php $i = 1 @endphp
							@foreach($users as $user)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>
									<a href="" title="view"><button type="button" class="btn btn-success action-icon"><i class="fa fa-eye"></i></button></a>
									<a href="{{ url('user/'.$user->id.'/edit') }}" title="edit">
										<button type="button" class="btn btn-info action-icon"><i class="fa fa-edit"></i></button>
									</a>
									<a class="modalLink" title="Delete" data-modal-size="modal-md" href="{{url('deleteUserView', $user->id)}}">
										<button type="button" class="btn btn-danger action-icon"><i class="fa fa-trash-o"></i></button>
									</a>
							    </td>
							</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>

@endSection