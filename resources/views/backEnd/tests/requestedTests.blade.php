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
		<h5>All Requested Tests ({{count($requestedTests)}})</h5>
		<!-- <a href="{{ route('create') }}" style="float: right; padding: 8px;" class="btn btn-success"> Add Tests </a> -->
	</div>
	<div class="card-block">
		<table id="basic-btn" class="table table-striped table-bordered nowrap  table-fit" style="table-layout: fixed; width: 100%">
			<thead>
				<tr>
				    <th width="4%">#SL</th> 
			    	<th>Date</th>
					<th width="16%"></th>
					<!-- <th>Urgency</th>
					<th>Test Codes</th>
					<th width="5%">Price</th> -->
					<th>Enter Patient <br>Details</th>
					<th width="12%">Send Payment <br>Request</th>
					<th>Take <br>Payment</th>
					<th>Payment <br>Received?</th>
					<th>Thanks Email <br>Send</th>
					<th>Generate Pdf <br>Request Form</th>
					<th style="width: 160px;">Send Pdf <br>Request Form</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@php $i = 1 @endphp
				@foreach($requestedTests as $test)
				<tr>
				  <!--  <td>{{$i++}}</td> -->
				    <td>{{$test->id}}</td>
					<td>{{date('d-m-Y', strtotime($test->created_at))}}</td>
					<td>
						<strong>Consultation ID:</strong> {{$test->consultation_id}}<br>
						<strong>Urgency:</strong> 
						@if($test->urgency == 'Urgent')
						<div class="btn btn-danger btn-sm">urgency</div>
						@else
						<div class="btn btn-success btn-sm">routine</div>
					@endif
					<br>
					@php
					$tests_details = App\ErpPatientTest::alltestsByPatientId($test->id);
					@endphp
					<strong>Test Codes:</strong>
					@foreach($tests_details as $tests_detail)
						 {{$tests_detail->code}}, 
						@endforeach
						<br>
						@php
					$total_prices = App\ErpPatientTest::totalPricesByPatientId($test->id);
					$total_prices_by_secratry = App\ErpSecretaryToPatient::totalPricesBySecratry($test->id);
					
					
					@endphp


					<strong>Total Price:</strong>
					<!-- £{{(int)$total_prices+35}}<br> -->
					@if((int)$total_prices_by_secratry > 0)
					£{{(int)$total_prices_by_secratry}}
					@else
					£{{(int)$total_prices}}
					@endif

					
					<br>
					<strong>Payment Request Url:</strong><br>
					<?php echo URL::to('/make-payment/'.$test->id);?>
					</td>
					<!-- <td>@if($test->urgency == 'Urgent')
						<div class="btn btn-danger btn-sm">urgency</div>
						@else
						<div class="btn btn-success btn-sm">routine</div>
					@endif</td> -->

					<!-- @php
					$tests_details = App\ErpPatientTest::alltestsByPatientId($test->id);
					@endphp -->

					<!-- <td>
						@foreach($tests_details as $tests_detail)
						 {{$tests_detail->code}}, 
						@endforeach
					</td> -->
					<!-- @php
					$total_prices = App\ErpPatientTest::totalPricesByPatientId($test->id);
					@endphp
					<td>£{{(int)$total_prices+35}}</td> -->
					@php
					$tests_details = App\ErpPatientTest::alltestsByPatientId($test->id);
					@endphp
					<td align="center">
						@if($test->enter_status == 0)
						<a style="padding: 6px 17px; border-radius: 4px;" class="modalLink btn-danger" title="Enter Phase 2 Details" data-modal-size="modal-lg" href="{{route('send_to_patient', $test->id)}}">Enter</a>
						@else
						<a><button type="button" class="btn btn-success action-icon">Entered</button></a><br>
						<a style="padding: 6px 17px; border-radius: 4px;" class="modalLink btn btn-danger mt-2" title="Eidt Phase 2 Details" data-modal-size="modal-lg" href="{{route('edit_phase_two_details', $test->id)}}">Edit</a>
						@endif
					</td>
					
					<td align="center">
						@if($test->payment_request_status == 0)
						<a class="modalLink btn  btn-info" title="Payment Request Email" data-modal-size="modal-lg" href="{{route('payment_request_confirmation_view', ['prescribe_id' => $test->id, 'enter_status' => $test->enter_status])}}">
							Payment <br>Request Email
						</a>
						@else
						<button type="button" class="btn btn-success action-icon">Sent</button>
						@if($test->payment_req_resent_status == 0)
						<a style="padding: 6px 17px; border-radius: 4px;" class="modalLink btn-info" title="Payment Request ReSent" data-modal-size="modal-lg" href="{{route('payment_request_confirmation_re_view', ['prescribe_id' => $test->id, 'enter_status' => $test->enter_status])}}">
							Resend
						</a>
						@endif
						@endif
						<br>
						@if($test->payment_req_resent_status == 1)
						<button style="margin-top: 5px;" type="button" class="btn btn-primary action-icon">Already Resend</button>
						@endif

					</td>
					<td align="center">
					
							@if($test->payment_status == 0)
							<a href="{{route('payment_receive_manually', $test->id)}}" class="modalLink" title="Take Payment Manually" data-modal-size="modal-lg"><button type="button" class="btn btn-warning action-icon">Receive</button></a>
							@else
							<button type="button" class="btn btn-success action-icon">Received</button>
							@endif
						
					</td>
					<td align="center">
						
							@if($test->payment_status == 0)
							<button type="button" class="btn btn-danger action-icon">No</button>
							@else
							<button type="button" class="btn btn-success action-icon">Yes</button>
							@endif
						
					</td>

					<td align="center">
						
							@if($test->	thanks_email_status == 0)
							<a class="modalLink" title="thanks Email to Patient" data-modal-size="modal-lg" href="{{route('send_thanks_to_patient_view', ['prescribe_id' => $test->id, 'payment_status' => $test->payment_status])}}">
							<button type="button" class="btn btn-basic action-icon">Sent</button>
						</a>
							@else
							<button type="button" class="btn btn-success action-icon">Already<br> Sent</button>
							@endif
						
					</td>
					<td>
						<a class="modalLink modal-big mb-2" style="margin-bottom: 5px;" title="Pdf Request Form" data-modal-size="modal-big" href="{{route('view_pdf_request_form', $test->id)}}">
							<button type="button" style="margin-bottom: 5px;" class="btn btn-primary action-icon">View</button><br>

						</a>
						<a title="Pdf Request Form" href="{{url('download_pdf_request_form', $test->id)}}">
							<button type="button" class="btn btn-primary action-icon">Download</button><br>
							
						</a>
					</td>
					<td>
						
						@if($test->sent_nurse_status == 0)
							<a class="modalLink" title="Send pdf" data-modal-size="modal-lg" href="{{route('send_pdf_to_nurse_view', ['prescribe_id' => $test->id, 'payment_status' => $test->payment_status])}}">
							<button type="button" class="btn btn-basic action-icon">Sent pdf form</button>
						</a>
							@else
							<button type="button" class="btn btn-success action-icon">Sent</button>
							@if($test->sent_nurse_resent_status == 0)
							<a class="modalLink" title="Re Send pdf" data-modal-size="modal-lg" href="{{route('resend_pdf_to_nurse_view', ['prescribe_id' => $test->id, 'payment_status' => $test->payment_status])}}">
							<button type="button" class="btn btn-basic action-icon">Resend</button>
						    </a>
						    @endif
							@endif
							<br>
							@if($test->sent_nurse_resent_status == 1)
							<button type="button" class="btn btn-primary action-icon" style="margin-top:5px;">Already Resend</button>
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
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$('#basic-btn').dataTable( {
  "pageLength": 50
} );
</script>
@endSection