<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\ErpPatientTest;
use DB;
use App\ErpSupportPlan;

class SendTestsToPatient extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
     
     if(!empty($this->mailData['clinical_details'])){
        $clinical_details = $this->mailData['clinical_details'];
     }
     else{
        $clinical_details = '';
     }

     // Array for Blade
     $input = array(
      'consultation_id'     => $this->mailData['consultation_id'],
      'clinical_details'     => $this->mailData['clinical_details'],
      'urgency' => $this->mailData['urgency'],
      'fasting_value' => $this->mailData['fasting_value'],
      'aditional_instructions' => $this->mailData['aditional_instructions'],
      'patient_id' => $this->mailData['patient_id'],
      'patients_email' => $this->mailData['patients_email'],
      'forename' => $this->mailData['forename'],
      'surname' => $this->mailData['surname'],
     );

     $total_price_with_nurse = '';
     $patient_id = $this->mailData['patient_id'];
     $allCartstests = ErpPatientTest::where('patient_id', $input['patient_id'])->get();
     
     $total_prices = DB::select(DB::raw("SELECT SUM(price) as SUM_PRICE FROM erp_patient_tests WHERE patient_id = $patient_id"))[0];

     return $this->subject('Payment for your Medicspot Blood Test')->view('emails.SendTestsToPatient')
     ->with([
        'inputs' => $input,
        'allCartstests' => $allCartstests,
        'total_price' => (int)$total_prices->SUM_PRICE+35,
    ]);
 }
}
