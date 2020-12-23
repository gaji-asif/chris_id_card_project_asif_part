@extends('backEnd.master')
@section('mainContent')

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

{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'role_permission_store', 'method' => 'POST']) }}
<input type="hidden" name="role_id" value="{{$role->id}}">

<div class="card">
	<div class="card-header">
		<h5>Assign Permission To - {{$role->role_name}}</h5>
	</div>
	<div class="card-block">
		<table class="table">
			<thead>
				<tr style="border-top: none !important;">
					<th>Module Name</th>
					<th>Module Link Name</th>
					<th>Permission</th>
				</tr>
			</thead>
			<tbody>
				@foreach($modules as $module)
				@php $i=0; @endphp
				@php $module_links = $module->moduleLink; @endphp
				@foreach($module_links as $module_link)
				@php $i++; @endphp
				<tr>
					<td>@if($i == 1)
						{{$module->name}}
						@endif
					</td>
					<td>{{$module_link->name}}</td>
					<td>
						<div class="">
							<input type="checkbox" id="permissions{{$module_link->id}}" class="common-checkbox" name="permissions[]" value="{{$module_link->id}}" {{in_array($module_link->id, $already_assigned)? 'checked':''}}>
							<label for="permissions{{$module_link->id}}"></label>
						</div>
					</td>
				</tr>
				@endforeach
				@endforeach
				<tr>
					<td></td>
					<td></td>
					<td>
						<div class="col-lg-12 mt-20 text-right">
							<button type="submit" class="primary-btn fix-gr-bg">
								<span class="ti-check"></span>
								Save
							</button>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
{{ Form::close() }}
@endSection