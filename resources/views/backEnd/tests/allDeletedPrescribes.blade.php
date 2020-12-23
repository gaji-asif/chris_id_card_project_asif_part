@extends('backEnd.master_dashboard')
@section('mainContentDashboard')
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
@media (min-width: 576px) {
  .modal-big { max-width: none; }
}

.modal-big {
  width: 98%;
  height: 92%;
  padding: 0;
  height: 1600px;
}

.modal-content {
  height: 99%;
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
	<div class="card-header">
		<h5>All Disabled Tests ({{count($requestedTests)}})</h5>
		<!-- <a href="{{ route('create') }}" style="float: right; padding: 8px;" class="btn btn-success"> Add Tests </a> -->
	</div>
	<div class="card-block">
		<table id="basic-btn" class="table table-striped table-bordered nowrap" style="table-layout: fixed; width: 100%">
			<thead>
				<tr> <th>Date</th>
					<th>Consultation ID</th>
					<th>Urgency</th>
					<th>Test Codes</th>
					<th>Price</th>
					<th>Enter Phase 2 <br>Details</th>
					<th>Sent Payment <br>Request</th>
					<th>Payment <br>Received?</th>
					<th>Generate Pdf <br>Request Form</th>
					<th style="width: 160px;">Send Pdf <br>Request Form</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@php $i = 1 @endphp
				@foreach($requestedTests as $test)
				<tr>
					<td>{{date('d-M-Y', strtotime($test->created_at))}}</td>
					<td>{{$test->consultation_id}}</td>
					<td>@if($test->urgency == 'Urgent')
						<div class="btn btn-danger btn-sm">urgency</div>
						@else
						<div class="btn btn-success btn-sm">routine</div>
					@endif</td>

					@php
					$tests_details = App\ErpPatientTest::alltestsByPatientId($test->id);
					@endphp

					<td>
						@foreach($tests_details as $tests_detail)
						 {{$tests_detail->code}}, 
						@endforeach
					</td>
					@php
					$total_prices = App\ErpPatientTest::totalPricesByPatientId($test->id);
					@endphp
					<td>£{{(int)$total_prices+35}}</td>
					@php
					$tests_details = App\ErpPatientTest::alltestsByPatientId($test->id);
					@endphp
					<td align="center">
						@if($test->enter_status == 0)
						<a class="modalLink" title="Enter Phase 2 Details" data-modal-size="modal-lg" href="{{route('send_to_patient', $test->id)}}">
							<button type="button" class="btn btn-danger action-icon">Enter</button>
						</a>
						@else
						<button type="button" class="btn btn-success action-icon">Entered</button>
						@endif
					</td>
					
					<td>
						@if($test->payment_request_status == 0)
						<a class="modalLink" title="Payment Request Email" data-modal-size="modal-lg" href="{{route('payment_request_confirmation_view', ['prescribe_id' => $test->id, 'enter_status' => $test->enter_status])}}">
							<button type="button" class="btn btn-info action-icon">Payment <br>Request Email</button>
						</a>
						@else
						<button type="button" class="btn btn-success action-icon">Sent</button>
						@endif
					</td>
					<td align="center">
						<a class="" title="Patient Details" data-modal-size="modal-lg" href="#">
							@if($test->payment_status == 0)
							<button type="button" class="btn btn-danger action-icon">No</button>
							@else
							<button type="button" class="btn btn-success action-icon">Yes</button>
							@endif
						</a>
					</td>
					<td>
						<a class="modalLink modal-big" title="Pdf Request Form" data-modal-size="@if($test->enter_status == 0) modal-md @else modal-big @endif" href="{{route('view_pdf_request_form', $test->id)}}">
							<button type="button" class="btn btn-primary action-icon">View</button>
						</a>
					</td>
					<td>
						
						@if($test->sent_nurse_status == 0)
							<a class="modalLink" title="Send pdf" data-modal-size="modal-lg" href="{{route('send_pdf_to_nurse_view', ['prescribe_id' => $test->id, 'payment_status' => $test->payment_status])}}">
							<button type="button" class="btn btn-basic action-icon">Sent pdf <br>request form Email</button>
						</a>
							@else
							<button type="button" class="btn btn-success action-icon">Sent</button>
							@endif
					</td>
					
					<td>
						<a class="modalLink" title="Delete" data-modal-size="modal-lg" href="{{route('delete_prescribtion', $test->id)}}">
							<button type="button" class="btn btn-danger action-icon">Delete</button>
						</a>
					<!-- @if($test->sent_status == 0)
						<a class="modalLink" title="Patient Details" data-modal-size="modal-lg" href="{{route('send_to_patient', $test->id)}}">
							<button type="button" class="btn btn-danger action-icon">Send to Patient</button>
						</a>
						@endif
						@if($test->sent_status == 1)
						<a>
							<button type="button" class="btn btn-success action-icon">Sent</button>
						</a>
						<a href="{{url('view_presb_patient/'.$test->id)}}">
							<button type="button" class="btn btn-primary action-icon">View Pdf</button>
						</a>
						@endif -->
					</td> 

				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


@endSection