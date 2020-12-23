<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\ErpPatientTest;
use DB;
use App\ErpSupportPlan;

class SendThanksToPatient extends Mailable
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
     
    

     // Array for Blade
     $input = array(
     
      'patients_email' => $this->mailData['patients_email'],
      'forename' => $this->mailData['forename'],
      'surname' => $this->mailData['surname'],
     );

 

     return $this->subject('Medicspot Home Service')->view('emails.sendThanksToPatient')
     ->with([
        'inputs' => $input,
     
    ]);
 }
}
