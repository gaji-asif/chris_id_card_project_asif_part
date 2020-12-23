<div>
	Dear <strong>$inputs['forename'].' '. $inputs['surname'],</strong><br><br>
	Your Medicspot doctor has recommended that you have some blood tests performed. These blood tests are:<br>

	[
	@foreach($allCartstests as $value)
		{{$value->test_name}},
	@endforeach
	]
	<br>
	The total cost of the blood tests will be <strong>£<?php echo $total_price;?></strong><br><br>

	<a>Make Payment</a><br>

	Please click on the ‘make payment’ link to make payment.<br><br>

	After you have made payment, a nurse will contact you to arrange a suitable time to come to your home or work to take the blood test.<br><br>

	Our doctors will then check the blood result and they will inform you of any further action that may be required. This whole process normally takes a couple of days.<br><br>

	You can reply directly to this email if you have any questions. <br><br>

	<strong>Kind Regards,</strong>



	<strong>Consultation ID :</strong> <?php echo $inputs['consultation_id'];?><br>
	<strong>Tests :</strong> 
	
	<br>
	<strong>Urgency :</strong> <?php if($inputs['urgency'] == 'Routine'){
		echo "Routine";
	}
	else{
		echo "Urgent";
	}?><br><strong>Fasting : </strong>
	 <?php if($inputs['fasting_value'] == 'yes'){
		echo "Yes";
	}
	else{
		echo "No";
	}?><br>

	<strong>Total Price:</strong>
	£<?php echo $total_price;?><br>
	<strong>Clinical Details :</strong> <?php echo $inputs['clinical_details'];?><br>
	<strong>Aditional Instructions :</strong> <?php echo $inputs['aditional_instructions'];?><br>
	<strong>Special Instructions :</strong> 
	[
	@foreach($allCartstests as $value)
		{{$value->special_instruction}},
	@endforeach
	]
</div>
<br><br>
<?php if($inputs['request_payment'] == '1'){?>
<strong>You are requested to Pay the Payment. You can login to our System with below email and password for paying the Payment.</strong><br><br>
<strong>User : </strong><?php echo $inputs['patients_email'];?><br>
<strong>Password : </strong> 123456 <br>
<?php } ?>