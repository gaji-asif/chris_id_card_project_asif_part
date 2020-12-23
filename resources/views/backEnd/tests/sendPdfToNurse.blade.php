{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'send_pdf_to_nurse',
'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
@if($payment_status == 0)
Payment Not Received Yet.
@else
<style type="text/css">
	.selected_wrapper, .custom_wrapper{
		display: none;
	}
</style>
<input type="hidden" name="sent_resent" value="sent">
<input type="hidden" name="prescribe_id" value="{{$prescribe_id}}">

<div class="form-group row">
	<label class="col-lg-6 col-form-label">Send To Option<span class="required" style="color: red;">  </span></label>

	<div class="col-lg-12 mt-2">
		<select class="form-control" name="send_option" id="send_email_to_nurse" style="border:1px solid;">
			<option>Select</option>
			<option value="manually">Manually Sent</option>
			<option value="selected">Send to TDL or Ashlee</option>
			<option value="custom">Send to Custom Email</option>
		</select>
		
	</div>
</div>

<div class="form-group row selected_wrapper">
	<label class="col-lg-6 col-form-label">Send To<span class="required" style="color: red;">  </span></label>
	<div class="col-lg-12 mt-2">
		<div class="radio radio-inline">
			<label class="mr-4">
				<input type="radio" name="send_to"  value="enquiries@ashleehealthcare.co.uk" class="timing" checked>
				enquiries@ashleehealthcare.co.uk
			</label>
			
		</div>
	</div>
	<div class="col-lg-12 mt-2">
		<div class="radio radio-inline">
			<label class="mr-4">
				<input type="radio" name="send_to"  value="patientreception@tdlpathology.com" class="timing">
				patientreception@tdlpathology.com
			</label>
			
		</div>
	</div>
</div>

<div class="form-group row custom_wrapper">
	<label class="col-lg-6 col-form-label">Send To<span class="required" style="color: red;">  </span></label>
	<div class="col-lg-12 mt-2">
	<input type="email" class="form-control" name="custom_email" id="custom_email">
</div>
	
</div>

<div class="alert alert-warning mt-4" style="margin-top: 10px; color: #000000; background-color: #ffe100;" role="alert">
	<strong>After Click OK, Please be patience. It may take 5-10 sec.</strong> 
</div>
@endif

@if($payment_status == 1)
<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2">OK</button></a>
@endif
<button type="button" class="btn btn-secondary btn-default pull-right ml-2" data-dismiss="modal">Cancel</button>
<script type="text/javascript">
	$( "#send_email_to_nurse" ).change(function(e) {
		e.preventDefault();
		if($(this).val() == 'manually'){
			$('.selected_wrapper').hide();
			$('.custom_wrapper').hide();
			$("#custom_email").prop('required',false);
		}

		if($(this).val() == 'selected'){
			$('.selected_wrapper').show();
			$('.custom_wrapper').hide();
			$("#custom_email").prop('required',false);
		}
		
		if($(this).val() == 'custom'){
			$('.selected_wrapper').hide();
			$('.custom_wrapper').show();
			
			if( !$('#custom_email').val() ) {
				// alert("please enter your field");
				$("#custom_email").val('');
				$("#custom_email").focus();
				$("#custom_email").prop('required',true);
			}
		}


	});
</script>
{{ Form::close()}}


