<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ErpPatient;
use App\ErpEmployee;
use App\ErpDepartment;
use App\ErpDesignation;
use App\ErpBaseSetup;
use Auth;
use App\ErpSupportPlan;
use PDF;
use Illuminate\Support\Facades\DB;
use Excel;
use File;
use App\Test;
use App\CartTest;
use App\ErpPatientTest;
use App\ErpDoctorsPrescribtion;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendTestsToPatient;
use Carbon;
use App\ErpSecretaryToPatient;
use App\User;
use App\Mail\SendThanksToPatientM;


class ErpSecretaryDashboardController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function requestedTests(){
     $user_id =Auth::user()->id;
     
     $requestedTests = ErpDoctorsPrescribtion::where('active_status','=', 1)->orderBy('id', 'DESC')->get();
    
      //dd($requestedTests);
     
     return view('backEnd.tests.requestedTests', compact('requestedTests'));
  }

  public function sendToPatient($prescribe_id){
    $prescribtionDetails = ErpDoctorsPrescribtion::where('id', $prescribe_id)->first();
    $tests_details = ErpPatientTest::where('patient_id', $prescribe_id)->get();
    $total_prices = DB::select(DB::raw("SELECT SUM(price) as SUM_PRICE FROM erp_patient_tests WHERE patient_id = $prescribe_id"))[0];
    $total_price = $total_prices->SUM_PRICE;
    return view('backEnd.tests.sendToPatient', compact('prescribe_id', 'prescribtionDetails', 'tests_details', 'total_price'));
  }

  public function storePatientData(Request $request){
      
        // if(!empty($request->date_of_birth)){
        //   $DOB = date('Y-m-d', strtotime($request->date_of_birth));
        // }
        // else{
        //   $DOB = null;
        // }

        // if(!empty($request->timing)){
        //   $timing = date('Y-m-d', strtotime($request->timing));
        // }
        // else{
        //   $timing = null;
        // }

        $prescribtionDetails = ErpDoctorsPrescribtion::find($request->prescribe_id);
        $prescribtionDetails->urgency = $request->urgency;
        $prescribtionDetails->fasting = $request->fasting;
        $prescribtionDetails->clinical_details = $request->clinical_details;
        $prescribtionDetails->aditional_instructions = $request->aditional_instructions;
        $resultss = $prescribtionDetails->update();

        $patients = new ErpSecretaryToPatient();
        $patients->forename = $request->forename;
        $patients->surname = $request->surname;
        $patients->gender = $request->gender;
        $patients->prescribe_id = $request->prescribe_id;
        $patients->date_of_birth = $request->date_of_birth;
        $patients->timing = $request->timing;
        $patients->email = $request->email;
        $patients->mobile = $request->mobile;
        $patients->total_price = $request->total_price;
        $patients->address = $request->address;
        $patients->created_by = Auth::user()->id;
        $results = $patients->save();
        $lastInsertID = $patients->id;

        if($results) {
            $doctors_pres = ErpDoctorsPrescribtion::find($request->prescribe_id);
            $doctors_pres->enter_status = 1;
            $result = $doctors_pres->update();

            return redirect('/all_requested_tests')->with('message-success', 'You have entered phase 2 details');
        } else {
            return redirect('/all_requested_tests')->with('message-danger', 'Something went wrong');
        }
  }

  public function editPhasetwoDeatails($prescribe_id){
        $prescribtionDetails = ErpDoctorsPrescribtion::where('id', $prescribe_id)->first();
        $tests_details = ErpPatientTest::where('patient_id', $prescribe_id)->get();
        $total_prices = DB::select(DB::raw("SELECT SUM(price) as SUM_PRICE FROM erp_patient_tests WHERE patient_id = $prescribe_id"))[0];
        $total_price = $total_prices->SUM_PRICE;
        $patientDetails = ErpSecretaryToPatient::where('prescribe_id', $prescribe_id)->first();
        return view('backEnd.tests.editPhasetwoDeatails', compact('prescribe_id', 'prescribtionDetails', 'tests_details', 'total_price', 'patientDetails'));
  }

  public function updatePhasetwoDetails(Request $request){
     // if(!empty($request->date_of_birth)){
     //      $DOB = date('Y-m-d', strtotime($request->date_of_birth));
     //    }
     //    else{
     //      $DOB = null;
     //    }

     //    if(!empty($request->timing)){
     //      $timing = date('Y-m-d', strtotime($request->timing));
     //    }
     //    else{
     //      $timing = null;
     //    }

        $prescribtionDetails = ErpDoctorsPrescribtion::find($request->prescribe_id);
        $prescribtionDetails->urgency = $request->urgency;
        $prescribtionDetails->fasting = $request->fasting;
        $prescribtionDetails->clinical_details = $request->clinical_details;
        $prescribtionDetails->aditional_instructions = $request->aditional_instructions;
        $resultss = $prescribtionDetails->update();

        $results = DB::table('erp_secretary_to_patients')->where('prescribe_id', $request->prescribe_id)
        ->update([
            'forename' => $request->forename,
            'total_price' => $request->total_price,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'prescribe_id' => $request->prescribe_id,
            'date_of_birth' => $request->date_of_birth,
            'timing' => $request->timing,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address
            // $patients->created_by = Auth::user()->id;
        ]);
        //$lastInsertID = $patients->id;

        if($results) {
          return redirect('/all_requested_tests')->with('message-success', 'Phase 2 details has been updated');
        } else {
            return redirect('/all_requested_tests')->with('message-success', 'Phase 2 details has been updated');
        }
  }

  public  function viewPresbToPatient($prescribe_id){
        $data = ErpSecretaryToPatient::where('prescribe_id','=', $prescribe_id)->first();
        $doctorsPrescribtions = ErpDoctorsPrescribtion::where('id','=', $prescribe_id)->first();
        $tests = ErpPatientTest::where('patient_id','=', $prescribe_id)->get();
        $result = [
            'patient_name' => $data->patient_name,
            'mobile' => $data->mobile,
            'address' => $data->address,
            'date_of_birth' => date('Y-m-d', strtotime($data->date_of_birth)),
          
            ];
        $prescribtionsData = [
          'consultation_id' => $doctorsPrescribtions->consultation_id,
          'urgency' => $doctorsPrescribtions->urgency,
          'fasting' => $doctorsPrescribtions->fasting,
          'clinical_details' => $doctorsPrescribtions->clinical_details,
          'aditional_instructions' => $doctorsPrescribtions->aditional_instructions,
          
        ];
        //$data = ['title' => 'Welcome to HDTuto.com'];
        $pdf = PDF::loadView('backEnd.tests.viewPresbToPatient', compact('result', 'tests', 'prescribtionsData'));
  
        return $pdf->download('view_patient_prescribe.pdf');
  }

  public function confirmationView($prescribe_id, $enter_status){
        return view('backEnd.tests.confirmationView', compact('prescribe_id', 'enter_status'));
  }

  public function reConfirmationView($prescribe_id, $enter_status){
        $total_prices = DB::select(DB::raw("SELECT SUM(price) as SUM_PRICE FROM erp_patient_tests WHERE patient_id = $prescribe_id"))[0];
        $total_price = $total_prices->SUM_PRICE;
        return view('backEnd.tests.reConfirmationView', compact('prescribe_id', 'enter_status', 'total_price'));
  }

  public function paymentRequestEmail(Request $request, $prescribe_id){

          if($request->sent_resent == 'resent'){
            $doctors_pres = ErpDoctorsPrescribtion::find($prescribe_id);
            $doctors_pres->payment_req_resent_status = 1;
            $doctors_pres->payment_re_request_date = date('Y-m-d');
            $result = $doctors_pres->update();
          }
          
          if($request->sent_resent == 'sent'){
            $doctors_pres = ErpDoctorsPrescribtion::find($prescribe_id);
            $doctors_pres->payment_request_status = 1;
            $doctors_pres->payment_request_date = date('Y-m-d');
            $result = $doctors_pres->update();
          }

          $patient_details = ErpSecretaryToPatient::where('prescribe_id',$prescribe_id)->first();

          $mailData = array(
             'consultation_id'     => $doctors_pres->consultation_id,
             'clinical_details'     => $doctors_pres->clinical_details,
             'urgency'           => $doctors_pres->urgency,
             'fasting_value'           => $doctors_pres->fasting,
             'aditional_instructions'       => $doctors_pres->aditional_instructions,
             'patient_id' => $patient_details->prescribe_id,
             'patients_email' => $patient_details->email,
             'forename' => $patient_details->forename,
             'surname' => $patient_details->surname,
           );

           //$prescrb_tests = ErpPatientTest::where('patient_id', $request->prescribe_id);

           $mailSent = Mail::to($patient_details->email)
            ->send(new SendTestsToPatient($mailData));

           if($mailSent){
            return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent to Patient.');
            } else {
            return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent to Patient.');
            }

}

public function viewPdfRequestForm($prescribe_id){

    $doctorsPrescribtions = ErpDoctorsPrescribtion::where('id','=', $prescribe_id)->first();
    
    $tests = ErpPatientTest::where('patient_id','=', $prescribe_id)->get();
    $patient_data = ErpSecretaryToPatient::where('prescribe_id','=', $prescribe_id)->first();
    return view('backEnd.tests.viewPdfRequestForm', compact('prescribe_id', 'doctorsPrescribtions', 'patient_data', 'tests')); 
    // if($doctorsPrescribtions->enter_status==1){
    //   $patient_data = ErpSecretaryToPatient::where('prescribe_id','=', $prescribe_id)->first();
    //   return view('backEnd.tests.viewPdfRequestForm', compact('prescribe_id', 'doctorsPrescribtions', 'patient_data', 'tests')); 
    // }
    // else{
    //   return view('backEnd.tests.viewPdfRequestFormElse'); 
    // }
      
} 

public function sendPdfToNurseView($prescribe_id, $payment_status){
     return view('backEnd.tests.sendPdfToNurse', compact('prescribe_id', 'payment_status'));
} 

public function reSendPdfToNurseView($prescribe_id, $payment_status){
     return view('backEnd.tests.reSendPdfToNurse', compact('prescribe_id', 'payment_status'));
} 

public function sendThanksToPatientView($prescribe_id, $payment_status){
     return view('backEnd.tests.sendThanksToPatientView', compact('prescribe_id', 'payment_status'));
}

public function sendThanksToPatient(Request $request){

          $patient_details = ErpSecretaryToPatient::where('prescribe_id', $request->prescribe_id)->first();

          $mailData = array(
             'patients_email' => $patient_details->email,
             'forename' => $patient_details->forename,
             'surname' => $patient_details->surname,
           );

           //$prescrb_tests = ErpPatientTest::where('patient_id', $request->prescribe_id);

        
            $doctors_pres = ErpDoctorsPrescribtion::find($request->prescribe_id);
            $doctors_pres->thanks_email_status = 1;
            $result = $doctors_pres->update();
          

        

            $mailSent = Mail::to($patient_details->email)
            ->send(new SendThanksToPatientM($mailData));

           if($mailSent){
            return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent to Patient.');
            } else {
            return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent to Patient.');
            }

}

public function sendPdfToNurse(Request $request){
  
  $doctorsPrescribtions = ErpDoctorsPrescribtion::where('id','=', $request->prescribe_id)->first();
  $tests = ErpPatientTest::where('patient_id','=', $request->prescribe_id)->get();
  $patient_data = ErpSecretaryToPatient::where('prescribe_id','=', $request->prescribe_id)->first();

  if($patient_data){
        $forename = $patient_data->forename;
        $surname = $patient_data->surname;
        $current_date = date('d-m-Y');
  }
  else{
      $forename = '';
      $surname = '';
      $current_date = date('d-m-Y');
  }
$full_name = $forename.'_'.$surname;
  
  
 $customPaper = array(0,0,800,1300);
 $pdf = PDF::loadView('backEnd.tests.pdf.pdfToNurse', compact('doctorsPrescribtions', 'tests', 'patient_data'))->setPaper($customPaper);

    if($request->sent_resent == 'sent'){
          if($request->send_option == 'manually'){
          $doctorsPrescribtion = ErpDoctorsPrescribtion::find($request->prescribe_id);
          $doctorsPrescribtion->sent_nurse_status= 1;
          $resultss = $doctorsPrescribtion->update();

          if($resultss){
            return redirect('/all_requested_tests')->with('message-success', 'Your have marked to change email send status');
          } 
          else {
           return redirect('/all_requested_tests')->with('message-success', 'Your have marked to change email send status');
        }
    }
    
    if($request->send_option == 'selected'){

          

            $mailSent = Mail::send('emails.sendPdfToNurse', compact('doctorsPrescribtions', 'tests', 'patient_data'), function($message) use($pdf, $request, $full_name, $current_date)
           {
            //$message->from('asif01665@yahoo.com', 'Your Name');

            $message->to($request->send_to)->subject('Patient Test Details');

           $message->attachData($pdf->output(), $full_name.' '.$current_date.'.pdf');
        });

            $doctorsPrescribtion = ErpDoctorsPrescribtion::find($request->prescribe_id);
            $doctorsPrescribtion->sent_nurse_status= 1;
            $resultss = $doctorsPrescribtion->update();
        

       if($mailSent){
        return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent successfully.');
       } 
        else {
          return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent successfully.');
        }
    }

    if($request->send_option == 'custom'){
          

          $mailSent = Mail::send('emails.sendPdfToNurse', compact('doctorsPrescribtions', 'tests', 'patient_data'), function($message) use($pdf, $request, $full_name, $current_date)
           {
            //$message->from('asif01665@yahoo.com', 'Your Name');

            $message->to($request->custom_email)->subject('Patient Test Details');
            $message->attachData($pdf->output(), $full_name.' '.$current_date.'.pdf');
        });

       
            $doctorsPrescribtion = ErpDoctorsPrescribtion::find($request->prescribe_id);
            $doctorsPrescribtion->sent_nurse_status= 1;
            $resultss = $doctorsPrescribtion->update();
        

       if($mailSent){
        return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent successfully.');
       } 
        else {
          return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent successfully.');
        }
    }
    }




    if($request->sent_resent == 'resent'){
          if($request->send_option == 'manually'){
          $doctorsPrescribtion = ErpDoctorsPrescribtion::find($request->prescribe_id);
          $doctorsPrescribtion->sent_nurse_resent_status= 1;
          $resultss = $doctorsPrescribtion->update();

          if($resultss){
            return redirect('/all_requested_tests')->with('message-success', 'Your have marked to change email send status');
          } 
          else {
           return redirect('/all_requested_tests')->with('message-success', 'Your have marked to change email send status');
        }
    }
    
    if($request->send_option == 'selected'){
           


            $mailSent = Mail::send('emails.sendPdfToNurse', compact('doctorsPrescribtions', 'tests', 'patient_data'), function($message) use($pdf, $request, $full_name, $current_date)
           {
            //$message->from('asif01665@yahoo.com', 'Your Name');

            $message->to($request->send_to)->subject('Patient Test Details');

            $message->attachData($pdf->output(), $full_name.' '.$current_date.'.pdf');
        });

         if($request->sent_resent == 'resent'){
            $doctorsPrescribtion = ErpDoctorsPrescribtion::find($request->prescribe_id);
            $doctorsPrescribtion->sent_nurse_resent_status= 1;
            $resultss = $doctorsPrescribtion->update();
        }

       
       if($mailSent){
        return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent successfully.');
       } 
        else {
          return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent successfully.');
        }
    }

    if($request->send_option == 'custom'){

          
            // if(!empty($patient_data->forename)){
            //   $forename = $patient_data->forename;
            //   $surname = $patient_data->surname;
            // }

          $mailSent = Mail::send('emails.sendPdfToNurse', compact('doctorsPrescribtions', 'tests', 'patient_data'), function($message) use($pdf, $request, $full_name, $current_date)
           {
            //$message->from('asif01665@yahoo.com', 'Your Name');

            $message->to($request->custom_email)->subject('Patient Test Details');

            $message->attachData($pdf->output(), $full_name.' '.$current_date.'.pdf');
        });

         if($request->sent_resent == 'resent'){
            $doctorsPrescribtion = ErpDoctorsPrescribtion::find($request->prescribe_id);
            $doctorsPrescribtion->sent_nurse_resent_status= 1;
            $resultss = $doctorsPrescribtion->update();
        }

       

       if($mailSent){
        return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent successfully.');
       } 
        else {
          return redirect('/all_requested_tests')->with('message-success', 'Your Email has sent successfully.');
        }
    }
    }

} 

public function deletePrescribtion($prescribe_id){
  return view('backEnd.tests.deletePrescribtion', compact('prescribe_id'));
}
public function disablePrescribtion($prescribe_id){
  $doctorsPrescribtion = ErpDoctorsPrescribtion::find($prescribe_id);
  $doctorsPrescribtion->active_status=0;
  $resultss = $doctorsPrescribtion->update();

  if($resultss){
  
       return redirect('/all_requested_tests')->with('message-success', 'Successfully Deleted.');
    
   } 
  else {
    return redirect('/all_requested_tests')->with('message-success', 'Successfully Deleted.');
  }
}

public function allDeletedPrescribes(){
  $user_id =Auth::user()->id;
  $requestedTests = ErpDoctorsPrescribtion::where('active_status','=', 0)->get();
  return view('backEnd.tests.allDeletedPrescribes', compact('requestedTests'));
}

public  function downloadPdfRequesForm($prescribe_id){
        $patient_data = ErpSecretaryToPatient::where('prescribe_id','=', $prescribe_id)->first();
        $doctorsPrescribtions = ErpDoctorsPrescribtion::where('id','=', $prescribe_id)->first();
        $tests = ErpPatientTest::where('patient_id','=', $prescribe_id)->get();
        // $result = [
        //     'patient_name' => $data->patient_name,
        //     'mobile' => $data->mobile,
        //     'address' => $data->address,
        //     'date_of_birth' => date('Y-m-d', strtotime($data->date_of_birth)),
          
        //     ];
        // $prescribtionsData = [
        //   'consultation_id' => $doctorsPrescribtions->consultation_id,
        //   'urgency' => $doctorsPrescribtions->urgency,
        //   'fasting' => $doctorsPrescribtions->fasting,
        //   'clinical_details' => $doctorsPrescribtions->clinical_details,
        //   'aditional_instructions' => $doctorsPrescribtions->aditional_instructions,
          
        // ];
        //$data = ['title' => 'Welcome to HDTuto.com'];
        if(isset($patient_data)){
          $forename = $patient_data->forename;
          $surname = $patient_data->surname;

          $customPaper = array(0,0,800,1300);
          $pdf = PDF::loadView('backEnd.tests.pdf.pdfRequestForm', compact('patient_data', 'tests', 'doctorsPrescribtions'))->setPaper($customPaper);
          //return $pdf->download('pdfRequestForm '.date('d/m/Y').'.pdf');
          return $pdf->download($forename.'_'.$surname. ' '. date('d/m/Y').'.pdf');
        }

  }

  public function reminderEmail(){
     $requestedTests = ErpDoctorsPrescribtion::where('active_status','=', 2)->where('payment_status','=', 0)->orderBy('id', 'DESC')->get();

     if(count($requestedTests)>0){
        foreach($requestedTests as $requestedTest){
          $patient_details = ErpSecretaryToPatient::where('prescribe_id',$requestedTest->prescribe_id)->first();

          $mailData = array(
             'prescribe_id' => $patient_details->prescribe_id,
             'patients_email' => $patient_details->email,
             'forename' => $patient_details->forename,
             'surname' => $patient_details->surname,
           );

           $mailSent = Mail::to($patient_details->email)
            ->send(new ReminderEmail($mailData));
        }
     }

  }
}

