@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
	.pcoded-inner-content{
		background-color: #000000;
	}

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
		float: left;
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
	.title{
		padding: 22px;
		background-color: #E6E03E;
		color: #000000;
		font-weight: bold;
		font-size: 15px;
	}

	.box_title{
		padding: 100px;
		background-color: #E6E03E;
		color: #000000;
		font-weight: bold;
		font-size: 15px;
		margin-right: 1%;
		width: 32% !important;
		float: left;
		line-height: 34px;
	}

	.box_titles{
		padding: 22px;
		background-color: #E6E03E;
		color: #000000;
		font-weight: bold;
		font-size: 15px;
		margin-right: 1%;
		width: 32% !important;
		float: left;
		line-height: 34px;
	}
	.form-row{
		margin-bottom: -9px !important;
	}
	.control-label{
		color: #000000;
	}

	@media only screen and (max-width: 600px) {
		.box_title{
			width: 100% !important;
			margin-bottom: 20px !important;
		}
		.box_titles{
			width: 100% !important;
			margin-bottom: 20px !important;
		}
	}
</style>
<!-- <link rel="stylesheet" media="all" href="//cdn.shopify.com/app/services/10162143283/assets/76428607539/checkout_stylesheet/v2-ltr-edge-48f46cbea05db6ade65a5931696b495c-2212" /> -->

<div class="container">
	<div class="row">

		<div class="col-lg-3"></div>
		<div class="col-lg-6 title text-center">Welcome to the most exclusive graduate club in the World</div>
		<div class="col-lg-3"></div>

	</div>


	<div class="row mt-5">
		<div class="box_title text-center">I have a First Class Honours Degree</div>
		<div class="box_title text-center">I have a  masters Degree with Distinction</div>
		<div class="box_title text-center">I graduated from a prestigious Institute (listed below)</div>
	</div>


	<div class="row mt-5">
		<div class="box_titles text-center" style="padding-top: 15%;">
			<!-- Free 6 months Membership($50) -->

			Full Membership $50 <br>
			6 Month Free Trial Membership
		</div>
		<div class="box_titles text-center">

			@if ((Session::has('success-message')))
			<div class="alert alert-success col-md-12" style="line-height: 1.5;">{{
			Session::get('success-message') }}</div>
			@endif @if ((Session::has('fail-message')))
			<div class="alert alert-danger col-md-12" style="line-height: 1.5;">{{
			Session::get('fail-message') }}</div>
			@endif

			@if (Session::has('success'))
			<div class="alert alert-success text-center">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
				<p>{{ Session::get('success') }}</p>
			</div>
			@endif
			
			<script src='https://js.stripe.com/v2/' type='text/javascript'></script>
			<form accept-charset="UTF-8" action="{{route('stripe.post')}}" class="require-validation pt-3"
			data-cc-on-file="false"
			data-stripe-publishable-key="pk_test_QXkB6Jjve2Q0BDE5PRiKEG0K004PyqAuPu"
			id="payment-form" method="post">
			{{ csrf_field() }}
			<div class='form-row'>
				<!-- <div class='col-xs-12 col-lg-12 form-group required'>
					<label class='control-label'>Name on Card</label> <input
					class='form-control' size='4' type='text'>
				</div> -->
				
					<div class="col-lg-12">
						<div class="row">

							<div class='col-xs-12 col-lg-6 form-group required'>
								<label class='control-label'>First Name</label> <input
								class='form-control first_name' size='4' type='text'>
							</div>




							<div class='col-xs-12 col-lg-6 form-group required'>
								<label class='control-label'>Surname</label> <input
								class='form-control sur_name' size='4' type='text'>

							</div>
						</div>
				

				</div>
			</div>

				<input type="hidden" name="first_name" id="first_name">
				<input type="hidden" name="sur_name" id="sur_name">
				<input type="hidden" name="email" id="email">
				<input type="hidden" name="payment" value="50">



				<div class='form-row'>

					<div class='col-xs-12 col-lg-12 form-group required'>
						<label class='control-label'>Email</label> <input
						class='form-control email' size='4' type='text'>
					</div>
				</div>

				<div class='form-row'>
					<div class='col-xs-12 col-lg-12 form-group required'>
						<label class='control-label'>Card Number</label> <input
						autocomplete='off' class='form-control card-number' size='20'
						type='text'>
					</div>
				</div>
				<div class='form-row'>
					<div class='col-xs-4 col-lg-4 form-group cvc required'>
						<label class='control-label'>CVC</label> <input
						autocomplete='off' class='form-control card-cvc'
						placeholder='ex. 311' size='4' type='text'>
					</div>
					<div class='col-xs-4 col-lg-4 form-group expiration required'>
						<label class='control-label'>Expiration</label> <input
						class='form-control card-expiry-month' placeholder='MM' size='2'
						type='text'>
					</div>
					<div class='col-xs-4 col-lg-4 form-group expiration required'>
						<label class='control-label'> Year</label> <input
						class='form-control card-expiry-year' placeholder='YYYY'
						size='4' type='text'>
					</div>
				</div>
				<div class='form-row'>

				</div>
				<div class='form-row pt-4'>
					<div class='col-md-12 form-group'>
						<button style="color: #000000; font-weight: bold;" class='form-control btn-warning submit-button'
						type='submit' style="margin-top: 10px;">Pay »</button>
					</div>
				</div>
				<div class='form-row'>
					<div class='col-md-12 error form-group hide'>
						<div class='alert-danger alert'>Please correct the errors and try
						again.</div>
					</div>
				</div>
			</form>


		</div>
		<div class="box_titles text-center">
			<label style="margin-top: 30%;" for="cars">Choose a University:</label>

			<select name="university" id="university" class="form-control">
				<option value="">Select a University</option>
				<option value="Harvard_University">Harvard University</option>
				<option value="Oxford_University">Oxford University</option>
				<option value="Cambridge_University">Cambridge University</option>
				<option value="Princeton_University">Princeton University</option>
				<option value="Stanford_University">Stanford University</option>
				<option value="London_Business_School">London Business School</option>
				<option value="Colombia_Business_School">Colombia Business School</option>

			</select>
		</div>
	</div>
</div>
</div>



<script src="https://code.jquery.com/jquery-1.12.3.min.js"
integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
crossorigin="anonymous"></script>
<script
src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
crossorigin="anonymous"></script>
<script>
	$(function() {
		$('form.require-validation').bind('submit', function(e) {
			var $form         = $(e.target).closest('form'),
			inputSelector = ['input[type=email]', 'input[type=password]',
			'input[type=text]', 'input[type=file]',
			'textarea'].join(', '),
			$inputs       = $form.find('.required').find(inputSelector),
			$errorMessage = $form.find('div.error'),
			valid         = true;

			$errorMessage.addClass('hide');
			$('.has-error').removeClass('has-error');
			$inputs.each(function(i, el) {
				var $input = $(el);
				if ($input.val() === '') {
					$input.parent().addClass('has-error');
					$errorMessage.removeClass('hide');
			        e.preventDefault(); // cancel on first error
			    }
			});
		});
	});

	$(function() {
		var $form = $("#payment-form");

		$form.on('submit', function(e) {
			if (!$form.data('cc-on-file')) {
				e.preventDefault();
				var first_name = $('.first_name').val();
				var sur_name = $('.sur_name').val();
				var email = $('.email').val();

				$("#first_name"). val(first_name);
				$("#sur_name"). val(sur_name);
				$("#email"). val(email);

				
				Stripe.setPublishableKey($form.data('stripe-publishable-key'));
				Stripe.createToken({
					number: $('.card-number').val(),
					cvc: $('.card-cvc').val(),
					exp_month: $('.card-expiry-month').val(),
					exp_year: $('.card-expiry-year').val()
				}, stripeResponseHandler);
			}
		});

		function stripeResponseHandler(status, response) {
			if (response.error) {
				$('.error')
				.removeClass('hide')
				.find('.alert')
				.text(response.error.message);
			} else {
			      // token contains id, last4, and card type
			      var token = response['id'];
			      // insert the token into the form so it gets submitted to the server
			      $form.find('input[type=text]').empty();
			      $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
			      $form.get(0).submit();
			  }
			}
		})
	</script>
	@endsection