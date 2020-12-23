<div>
	<strong>Consultation ID :</strong> <?php echo $inputs['consultation_id'];?><br>
	<strong>Codes :</strong> 
	[
	@foreach($allCartstests as $value)
		{{$value->code}},
	@endforeach
	]
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