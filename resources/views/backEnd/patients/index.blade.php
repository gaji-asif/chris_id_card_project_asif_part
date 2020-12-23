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


<div class="card">
	<div class="card-header">
		<h5>Patients Lists</h5>
		<a href="{{ route('create') }}" style="float: right; padding: 8px;" class="btn btn-success"> Add Patient </a>
	</div>
	<div class="card-block">
		<table id="basic-btn" class="table table-striped table-bordered nowrap">
			<thead>
				<tr>
					<th>Patient ID</th>
					<th>Title</th>
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Surname</th>
					<th>Date of Birth</th>
					<th>NHS NO</th>
					<th>Address</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@php $i = 1 @endphp
				@foreach($patients as $patient)
				<tr>
					<td>{{$patient->patient_id}}</td>
					<td>{{$patient->title}}</td>
					<td>{{$patient->first_name}}</td>
					<td>{{$patient->last_name}}</td>
					<td>{{$patient->sur_name}}</td>
					<td>{{date('d-M-Y', strtotime($patient->date_of_birth))}}</td>
					<td>{{$patient->nhs_no}}</td>
					<td>{{$patient->address}}</td>
					<td>
						
						<a href="{{ route('patient.edit',$patient->id) }}" title="edit"><button type="button" class="btn btn-info action-icon"><i class="fa fa-edit"></i></button></a>
						<a class="modalLink" title="Delete" data-modal-size="modal-md" href="{{url('deletePateientView', $patient->id)}}">
							<button type="button" class="btn btn-danger action-icon"><i class="fa fa-trash-o"></i></button>
						</a>
					</td>

				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endSection