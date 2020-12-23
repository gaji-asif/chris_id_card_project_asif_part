<div>
	Dear <strong><?php echo $inputs['forename'].' '.$inputs['surname']?>,</strong><br><br>
	
	You recently saw a Medicspot doctor who recommended some further tests to be carried out for your healthcare need. As we have not yet received payment for the blood test, we are unable to organise this.<br><br>

	You can see what tests the doctor requested and also make payment by clicking on the “Make Payment” button below. <br><br>

	<strong><a href="{{route('make-payment',$inputs['patient_id'])}}" style="padding: 10px; background-color: #11c15b; border-radius: 5px;">Make Payment</a></strong><br><br>

	The home-service team will then contact you within a couple of days to organise a suitable time for your test. <br><br>

	Please do not hesitate to contact me by replying directly to this email.<br><br> 


	<strong>Kind Regards,</strong><br>

	<strong>Medicspot</strong>
	
</div>