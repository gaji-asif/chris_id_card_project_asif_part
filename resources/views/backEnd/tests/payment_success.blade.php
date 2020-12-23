@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
.hide{
	display: none;
}
.control-label{
	font-size: 15px;
    line-height: 1em;
    margin-bottom: 0.6em;
    color: #004F71;
    font-family: 'Gilroy-SemiBold', sans-serif;
    font-weight: bold;
}
.total_need_pay{
	font-weight: bold;
	font-size: 22px;
}
.alert-success {
	background-color: #11c15b !important;
	color: #FFFFFF;
}
.btn-warning{
	background-color: #307FE2 !important;
	color: #FFFFFF !important;
	padding: 10px;
}
</style>
<link rel="stylesheet" media="all" href="//cdn.shopify.com/app/services/10162143283/assets/76428607539/checkout_stylesheet/v2-ltr-edge-48f46cbea05db6ade65a5931696b495c-2212" />

<div class="container">
<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<div class="alert alert-success" style="line-height: 1.5; border:1px solid #000; font-size: 18px; text-align: center;">Thank you for your payment which has been processed. One of our team will be in touch with you shortly to organise your blood tests !</div>
	</div>
	<div class="col-lg-1"></div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.3.min.js"
integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
crossorigin="anonymous"></script>
<script
src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
crossorigin="anonymous"></script>

	@endsection