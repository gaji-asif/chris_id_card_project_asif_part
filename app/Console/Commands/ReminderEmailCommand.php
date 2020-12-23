<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ErpDoctorsPrescribtion;
use Illuminate\Support\Facades\Mail;
use Carbon;
use App\ErpSecretaryToPatient;
use App\Mail\ReminderEmail;

class ReminderEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:reminderemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info("Cron asif is working fine!");
        
  
         $requestedTests = ErpDoctorsPrescribtion::where('active_status','=', 2)->where('payment_status','=', 0)->orderBy('id', 'DESC')->get();

     if(count($requestedTests)>0){
        foreach($requestedTests as $requestedTest){
          $patient_details = ErpSecretaryToPatient::where('prescribe_id',$requestedTest->id)->first();

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
        
        $this->info('Demo:Cron Cummand Run successfully!');
    }
}
