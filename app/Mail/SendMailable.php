<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\ErpPatientTest;
use DB;
use App\ErpSupportPlan;

class SendMailable extends Mailable
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

     // if(!empty($this->mailData['fasting_value'])){
     //    $fasting_value = $this->mailData['fasting_value'];
     // }
     // else{
     //    $fasting_value = 'no';
     // }

     


     // Array for Blade
     $input = array(
      'consultation_id'     => $this->mailData['consultation_id'],
      'clinical_details'     => $this->mailData['clinical_details'],
      'urgency' => $this->mailData['urgency'],
      'fasting_value' => $this->mailData['fasting_value'],
      'aditional_instructions' => $this->mailData['aditional_instructions'],
      'patient_id' => $this->mailData['patient_id'],
      

     );

     $total_price_with_nurse = '';
     $patient_id = $this->mailData['patient_id'];
     $allCartstests = ErpPatientTest::where('patient_id', $input['patient_id'])->get();
     
     $total_prices = DB::select(DB::raw("SELECT SUM(price) as SUM_PRICE FROM erp_patient_tests WHERE patient_id = $patient_id"))[0];
     
     //$total_price = $allCartstests->sum('price');
    // $total_price_with_nurse = is_numeric(($total_price))+is_numeric(35);
      //$total_price_with_nurse = 100;
      
     return $this->subject('Medicspot test request')->view('emails.name')
     ->with([
        'inputs' => $input,
        'allCartstests' => $allCartstests,
        'total_price' => (int)$total_prices->SUM_PRICE+35,
    ]);
 }
}
