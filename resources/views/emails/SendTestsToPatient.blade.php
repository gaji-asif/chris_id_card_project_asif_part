<div>
	Dear <strong><?php echo $inputs['forename'].' '.$inputs['surname']?>,</strong><br><br>
	
	The Medicspot doctor has recommended that you have some blood/pathology tests performed. These tests are: <br><br>

	<font style="font-size: 16px;">[
	@foreach($allCartstests as $value)
		{{$value->test_name}},
	@endforeach
	]
   </font>
	<br><br>
	The total cost of the blood tests will be <strong><font style="font-size: 16px;">£<?php echo $total_price;?></strong></font><br><br>

	<strong><a href="{{route('make-payment',$inputs['patient_id'])}}" style="padding: 10px; background-color: #11c15b; border-radius: 5px;">Make Payment</a></strong><br><br>

	Please click on the ‘Make Payment’ link to make payment.<br><br>

After you have made payment, a nurse will contact you to arrange a suitable time to come to your home or work to take the sample. This usually happens within 1-3 days but can depend on the availability of nurses in your area. <br><br>

One of our doctors will then check the results the day we get them from the laboratory and they will inform you of any further action that may be required.<br><br> 

If you would like to attend our walk-in centre in Central London or Edinburgh for your blood test then please let us know. You will get your results quicker this way - even sometimes the same day. <br><br>

<font style="color: #000000;">You can reply directly to this email if you have any questions. </font> <br><br>
                                                  
<strong>Kind Regards,</strong><br>

<strong>Medicspot</strong>
	
</div>