{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'payment_request_email/'.$prescribe_id,
'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
@if($enter_status == 0)
Please Enter Phase 2 Details First.
@else
Are you Sure want to sent Email For Request Payment ?
@endif
<input type="hidden" name="sent_resent" value="sent">
@if($enter_status == 1)
<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2">OK</button></a>
@endif
<button type="button" class="btn btn-secondary btn-default pull-right ml-2" data-dismiss="modal">Cancel</button>
{{ Form::close()}}
