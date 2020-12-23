<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use App\User;
use App\ErpDoctorsPrescribtion;
use Stripe;
use DB;
use App\ErpPatientTest;
use App\ErpSecretaryToPatient;
use App\Mail\ConfirmationPaymentNotification;
use Mail;
use App\Payment;


class ErpPatientMakePaymentController extends Controller
{
    // public function paymentStripe($prescribe_id)
    public function index()
    {


    // $total_prices = DB::select(DB::raw("SELECT SUM(price) as SUM_PRICE FROM erp_patient_tests WHERE patient_id = $prescribe_id"))[0];
    // $total_price = $total_prices->SUM_PRICE;
    // $tests_details = ErpPatientTest::where('patient_id', $prescribe_id)->get();
    return view('backEnd.tests.makePayment');
    } 

    public function stripePost(Request $request){
        $amount = $request->payment;
        Stripe\Stripe::setApiKey('sk_test_CdAzjUeRIF13nsMSm2m3nk1b0046F2lEfg');
        Stripe\Charge::create ([
                "amount" => $amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from Our Website." 
        ]);
  
        Session::flash('success', 'Payment successful!');

          $payments = new Payment();
          $payments->amount = $request->payment;
          $payments->first_name = $request->first_name;
          $payments->sur_name = $request->sur_name;
          $payments->email = $request->email;
          
          $payments->university = $request->university;
          $result = $payments->save();
          
        return back();
    }

    public function stripePost1(Request $request)
    {
    


        // $patient_details = ErpSecretaryToPatient::where('prescribe_id',$request->prescribe_id)->first();

     //      $mailData = array(
     //         //'consultation_id'     => $doctors_pres->consultation_id,
     //         //'clinical_details'     => $doctors_pres->clinical_details,
     //         //'urgency'           => $doctors_pres->urgency,
     //         //'fasting_value'           => $doctors_pres->fasting,
     //         //'aditional_instructions'       => $doctors_pres->aditional_instructions,
     //        'prescribe_id' => $request->prescribe_id,
     //         'patients_email' => $patient_details->email,
     //         'forename' => $patient_details->forename,
     //         'surname' => $patient_details->surname,
          // );

           //$prescrb_tests = ErpPatientTest::where('patient_id', $request->prescribe_id);

           // $mailSent = Mail::to('tests@medicspot.co.uk')
           // ->send(new ConfirmationPaymentNotification($mailData));

    // $doctors_pres = ErpDoctorsPrescribtion::find($request->prescribe_id);
    $amount = $request->payment;

    \Stripe\Stripe::setApiKey ( 'sk_test_CdAzjUeRIF13nsMSm2m3nk1b0046F2lEfg' );
	try {
		\Stripe\Charge::create ( array (
				"amount" => $amount * 100,
				// "currency" => "GBP",
                "currency" => "GBP",
				"source" => $request->stripeToken, // obtained with Stripe.js
				"description" => "From website"
		) );
		
		// Session::flash ( 'success-message', 'Thank you for your payment which has been processed. One of our team will be in touch with you shortly to organise your blood tests !' );

		
     	// $doctors_pres->payment_status = 1;
     	// $result = $doctors_pres->update();

          // $payments = new Payment();
          // $payments->amount = $request->payment;
          // $payments->first_name = $request->first_name;
          // $result = $payments->save();


     	return Redirect::back ();
        // return redirect('/payment-success')->with('message-successss', 'Send successfully.');
	} catch ( \Exception $e ) {
		//Session::flash ( 'fail-message', "Error! Please Try again." );
		return Redirect::back ();
	}

	}


    public function paymentSuccess(){
        
        return view('backEnd.tests.payment_success');
    }


	public function paymentReceivedManView($prescribe_id){
		$prescribtionDetails = ErpDoctorsPrescribtion::where('id', $prescribe_id)->first();
        $tests_details = ErpPatientTest::where('patient_id', $prescribe_id)->get();
		$total_prices = DB::select(DB::raw("SELECT SUM(price) as SUM_PRICE FROM erp_patient_tests WHERE patient_id = $prescribe_id"))[0];
    	$total_price = $total_prices->SUM_PRICE;
    	return view('backEnd.tests.paymentReceivedManView', compact('prescribe_id','prescribtionDetails','tests_details', 'total_price'));
	}

	public function storePaymentDataMan(Request $request){

	$doctorsPrescribtion = ErpDoctorsPrescribtion::find($request->prescribe_id);
    $doctorsPrescribtion->payment_status=1;
    $resultss = $doctorsPrescribtion->update();

	    if($resultss){
	  		return redirect('/all_requested_tests')->with('message-success', 'Payment Received successfully.');
	    } 
	  else {
	    return redirect('/all_requested_tests')->with('message-success', 'Payment Received successfully.');
	  }
	}
 }

