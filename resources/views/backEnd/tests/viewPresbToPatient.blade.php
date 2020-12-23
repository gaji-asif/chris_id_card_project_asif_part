<!DOCTYPE html>
<html>
<head>
	<title>Patient Test Details</title>
<style type="text/css">
	td {
    border: 1px solid #000000;
}
</style>
</head>
<body>
	<div>
		<div>
			<div style="clear: both;">
				<img src="{{ url('public/images/logo_reports.png') }}" width="" style="text-align: right !important;">
			</div>
			<br><br>
			<span style="float: left; margin-right: 20px;"><strong>Patient Name :</strong> {{$result['patient_name']}}</span>
			<span style="float: left; margin-right: 20px;"><strong>Mobile :</strong> {{$result['mobile'] }}</span>
			<span style="float: left;"><strong>Date of Birth :</strong> {{$result['date_of_birth']}}</span>
			<br>
			<h3>Doctors Prescribtion</h3>
			<p style="clear: both;"><strong>Consultation ID:</strong>{{$prescribtionsData['consultation_id']}}</p>
			<p style="clear: both;"><strong>Urgency:</strong>{{$prescribtionsData['urgency']}}</p>
			<p style="clear: both;"><strong>Fasting:</strong>{{$prescribtionsData['fasting']}}</p>
			<p style="clear: both;"><strong>Clinical Details:</strong>{{$prescribtionsData['clinical_details']}}</p>
			<p style="clear: both;"><strong>Additional Instructions:</strong>{{$prescribtionsData['aditional_instructions']}}</p>

			<br>
			<p style="clear: both;"><strong>Tests Given</strong></p>
		

		<table id="exportTable" class="table table-hover">
        <thead>
            <tr style="border:1px solid #000000;">
                <th style="width: 20%;">Test Name</th>
				<th style="width: 10%;">Code</th>
				<th style="width: 10%;">Price</th>
				<th style="width: 50%;">Special Instruction</th>
            </tr>
        </thead>
        <tbody>
           @foreach($tests as $test)
				<tr>
					<td>{{$test->test_name}}</td>
					<td>{{$test->code}}</td>
					<td>{{$test->price}}</td>
					<td>{{$test->special_instruction}}</td>

				</tr>
				@endforeach
        </tbody>
    </table>
	</div>
</body>
</html>



