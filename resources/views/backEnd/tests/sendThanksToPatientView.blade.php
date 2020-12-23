{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'send_thanks_to_patient',
'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
@if($payment_status == 0)
Payment Not Received Yet.
@else
<input type="hidden" name="prescribe_id" value="{{$prescribe_id}}">
After Click ok, this patient will get a thanks Email Message.

<div class="alert alert-warning mt-4" style="margin-top: 10px; color: #000000; background-color: #ffe100;" role="alert">
	<strong>After Click OK, Please be patience. It may take 2-3 sec.</strong> 
</div>
@endif

@if($payment_status == 1)
<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2">OK</button></a>
@endif
<button type="button" class="btn btn-secondary btn-default pull-right ml-2" data-dismiss="modal">Cancel</button>

{{ Form::close()}}


