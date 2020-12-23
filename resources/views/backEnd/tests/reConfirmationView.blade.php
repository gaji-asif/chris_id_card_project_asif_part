{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'payment_request_email/'.$prescribe_id,
'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

<!-- <?php
$total_prices = 0;
$total_prices_by_secratry = App\ErpSecretaryToPatient::totalPricesBySecratry($prescribe_id);

if((int)$total_prices_by_secratry > 0){
	$total_prices = (int)$total_prices_by_secratry;
}
else{
	$total_prices = (int)$total_price;
}
?> -->


<!-- <div class="form-group">
	<label for="gp_details"> Total Price:</label>
	<input type="text" class="form-control" id="total_price" name="total_price" value="{{$total_prices}}">
</div>

<div class="form-group row">
	<label class="col-lg-6 col-form-label">Add Nurse Fee<span class="required" style="color: red;">  </span></label>
	<div class="col-lg-12 mt-2">
		<div class="radio radio-inline">
			<label class="mr-4">
				<input type="radio" name="nurse_fee"  class="yes_nurse_value">
				Yes
			</label>
			<label>
				<input type="radio" name="nurse_fee"  class="no_nurse_value"  checked="checked">
				No
			</label>
		</div>
	</div>
</div>	 -->

Are you Sure want to Resent Email For Request Payment ?

<input type="hidden" name="sent_resent" value="resent">

<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2">OK</button></a>
<button type="button" class="btn btn-secondary btn-default pull-right ml-2" data-dismiss="modal">Cancel</button>

<script type="text/javascript">
	$(".yes_nurse_value").click(function(){
		var total_price = $('#total_price').val();
		$("#total_price").val(Number(total_price)+Number(35));

	});


	$(".no_nurse_value").click(function(){
		var total_price = $('#total_price').val();
		$("#total_price").val(Number(total_price)-Number(35));

	});
</script>
{{ Form::close()}}
