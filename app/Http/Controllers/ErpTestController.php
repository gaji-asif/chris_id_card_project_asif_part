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
use App\Mail\SendMailable;
use Carbon;
use Session;


class ErpTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $data = DB::table('tests')->whereNotNull('test_name')->get();
     $tests_for_dropdowns = DB::table('tests')->whereNotNull('test_name')->where('active_status', 1)->get();
     $main_page="main";
     return view('backEnd.tests.index', compact('data', 'tests_for_dropdowns', 'main_page'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      return view('backEnd.tests.create');
    }

    public function searchTest(Request $request){
   
     $search_result = $request->search_result;
     //session()->put('search_result', $search_result);
     $data = DB::select(DB::raw("SELECT t.* 
      FROM tests t 
      WHERE t.test_name LIKE '%$request->search_result%' OR
      t.code LIKE '%$request->search_result%' OR
      t.details LIKE '%$request->search_result%'"));
     
       // $tests_for_dropdowns = DB::table('tests')->whereNotNull('test_name')->where('active_status', 1)->get();
       //return redirect()->route('all_results', ['data' => $data]);
       //return redirect()->action('ErpTestController@allResults')->with('data', $data);
     return view('backEnd.tests.search_result', compact('data', 'test_name', 'code', 'details', 'allCartstests'));
   }

    // public function allResults($data){
    //   return view('backEnd.tests.search_result', compact('data'));
    // }

   public function addToCart(Request $request)
   {
    $test_id = $request->id;
    $tests_data = Test::find($test_id);

    $price_pound = explode('£', $tests_data->price);
        
    $price_only = $price_pound[1];


    //$product = Product::find($id);
 
        if(!$tests_data) {
 
            abort(404);
 
        }
 
        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
 
            $cart = [
                    $test_id => [
                        "idd" => $tests_data->id,
                        "test_name" => $tests_data->test_name,
                        "quantity" => 1,
                        "price" => $tests_data->price,
                        "code" => $tests_data->code,
                        "special_instruction" => $tests_data->special_instruction,
                        "sample_e_request" => $tests_data->sample_e_request,
                    ]
            ];
 
            session()->put('cart', $cart);
 
            //return redirect()->back()->with('success', 'Product added to cart successfully!');
            return view('backEnd.tests.allCartstests');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$test_id])) {
 
            $cart[$test_id]['quantity']++;
 
            session()->put('cart', $cart);
 
            // return redirect()->back()->with('success', 'Product added to cart successfully!');
           return view('backEnd.tests.allCartstests');
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$test_id] = [
            "idd" => $tests_data->id,
            "test_name" => $tests_data->test_name,
            "quantity" => 1,
            "price" => $tests_data->price,
            "code" => $tests_data->code,
            "special_instruction" => $tests_data->special_instruction,
            "sample_e_request" => $tests_data->sample_e_request,
        ];
 
        session()->put('cart', $cart);
      return view('backEnd.tests.allCartstests');
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
     

    // $tests = new ErpSupportPlan();
    // $tests->test_id = $test_id;
    // $tests->test_name = $tests_data->test_name;
    // $tests->code = $tests_data->code;
    // $tests->price = $price_only;
    // $tests->special_instruction = $tests_data->special_instruction;
    // $results = $tests->save();

    // if($results){
    //   $allCartstests = ErpSupportPlan::where('active', 1)->get();
    //   return view('backEnd.tests.allCartstests', compact('allCartstests'));
    // }

  }

  public function removeCartTest(Request $request)
  {

    //$result = ErpSupportPlan::destroy($request->id);
     if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            //session()->flash('success', 'Product removed successfully');
        }

  }

  public function checkout(){
    //$allCartstests = ErpSupportPlan::where('active', 1)->get();
    //$total_price = DB::table('erp_support_plans')->sum('price');
    //return view('backEnd.tests.checkout', compact('allCartstests', 'total_price'));
     $total_price = 0;
    if(session('cart')){
      
      foreach(session('cart') as $id => $details){
        $test_price = explode('£', $details['price']);
       $total_price +=(int)$test_price[1];
      }
     
    }

    return view('backEnd.tests.checkout', compact('total_price'));
  }

  public function checkout_patient(Request $request)
  {
    $fasting_value = "";
    //$request->clinical_details = "";
    //$request->aditional_instructions="";
    //$request->special_instruction="";

    // if($request->fasting == 'yes'){
    //   $fasting_value = $request->fasting;
    // }
    // if(empty($request->fasting)){
    //   echo  $fasting_value = 'no';
    // }

    $prescribes = new ErpDoctorsPrescribtion();
    $prescribes->consultation_id = $request->consultation_id;
    $prescribes->urgency = $request->urgency;
   
    $prescribes->fasting = $request->fasting;
    $prescribes->clinical_details = $request->clinical_details;
    $prescribes->aditional_instructions = $request->aditional_instructions;
    //$prescribes->created_at = date("Y-m-d");
    //$prescribes->updated_at = date("Y-m-d");
    $results = $prescribes->save();
    $lastInsertID = $prescribes->id;

    

    //echo $request->fasting; 
    

    if($results){
    if(session('cart')){
        //foreach($allCartstests as $value){
        foreach(session('cart') as $id => $value){
          $test_price = explode('£', $value['price']);
          $tests = new ErpPatientTest();
          $tests->test_id = $value['idd'];
          $tests->test_name = $value['test_name'];
          $tests->code = $value['code'];
          $tests->price = $test_price[1];
          //$tests->nurse_fee = 35;
          $tests->patient_id = $lastInsertID;
          $tests->special_instruction = $value['special_instruction'];
          $tests->sample_e_request = $value['sample_e_request'];
          //$tests->created_at = date("Y-m-d");
          //$tests->updated_at = date("Y-m-d");
          $result = $tests->save();
        }

        
      }

    $mailData = array(
       'consultation_id'     => $request->consultation_id,
       'clinical_details'     => $request->clinical_details,
       'urgency'           => $request->urgency,
       'fasting_value'           => $request->fasting,
       'aditional_instructions'       => $request->aditional_instructions,
       //'special_instruction'       => $request->special_instruction,
       'patient_id' => $lastInsertID,
      );

    // echo "<pre>";
    // print_r($mailData);
    // exit;

    
    

     $ok = Mail::to('tests@medicspot.co.uk')
    ->send(new SendMailable($mailData));

    if($ok){
      $cart = session()->get('cart');
        if(isset($cart)) {
          Session::flush();
        }
    }

    return redirect()->route('test.index')->with('message-success', 'The test request has successfully been sent to tests@medicspot.co.uk');
    
   }

}


public function removeAllTests(){
    $cart = session()->get('cart');
    if(isset($cart)) {
      $result = Session::flush();
    }
   if($result) {
      return redirect('/checkout')->with('message-success', 'All Tests has been deleted');
    } else {
      return redirect('/checkout')->with('message-success', 'All Tests has been deleted');
    }

}

public function clearTestCart(){
   $result = DB::select(DB::raw("SELECT TIME(created_at) as created_at_time, DATE(created_at) as created_at_date
                                FROM erp_support_plans 
                                WHERE id=(
                                    SELECT max(id) FROM erp_support_plans
                                    );"))[0];

 echo $column_with_15_mins =  date('Hi',strtotime($result->created_at_time . ' +15 minutes'))."<br>";
 echo $current_time = date('Hi')."<br>";


 echo $column_with_date =  date('Ymd',strtotime($result->created_at_date))."<br>";
 echo $current_date = date('Ymd')."<br>";

 if($column_with_15_mins === $current_time && $column_with_date === $current_date){
  
     $result = DB::table('erp_support_plans')->delete();
     return redirect()->route('test.index');
  }
  
}

public function requestedTests(){
  $requestedTests = ErpDoctorsPrescribtion::where('id','>', 1)->get();
  return view('backEnd.tests.requestedTests', compact('requestedTests'));
}

/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'patient_id'=>'required',
        'first_name'=> 'required',
        'sur_name'=> 'required',
        'middle_name'=> 'required',
        'date_of_birth'=> 'required'
      ]);

      $signature = ""; 
      if($request->file('signature') != ""){
       $file = $request->file('signature');
       $signature = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
       $file->move('public/uploads/signature/', $signature);
       $signature = 'public/uploads/signature/'.$signature;
     }

     $support_plan = array();
     if (empty($request->support_plan)) {
      $support_plan = '';
    } else {
      $support_plan = implode(',', $request->support_plan);
    }

    if (empty($request->date_of_birth)) {
      $date_of_birth = null;
    } else {
      $date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
    }


    if (empty($request->date_of_death)) {
      $date_of_death = null;
    } else {
      $date_of_death = date('Y-m-d', strtotime($request->date_of_death));
    }

    if (empty($request->behavihour_date)) {
      $behavihour_date = null;
    } else {
      $behavihour_date = date('Y-m-d', strtotime($request->behavihour_date));
    }

    $patients = new ErpPatient();
    $patients->patient_id = $request->get('patient_id');
    $patients->title = $request->get('title');
    $patients->first_name = $request->get('first_name');
    $patients->sur_name = $request->get('sur_name');
    $patients->last_name = $request->get('middle_name');
    $full_name = $request->get('first_name').' '.$request->get('sur_name').' '.$request->get('middle_name');
    $patients->full_name = $full_name;
    $patients->mobile = $request->get('mobile');
    $patients->nhs_no = $request->get('nhs_no');
    $patients->post_code = $request->get('post_code');
    $patients->date_of_birth = $date_of_birth;
    $patients->date_of_death = $date_of_death;
    $patients->next_of_kin = $request->get('next_of_kin');
    $patients->address = $request->get('address');
    $patients->support_plan = $support_plan;
    $patients->behaviour = $request->behaviour;
    $patients->education = $request->education;
    $patients->daily_living_skills = $request->daily_living_skills;
    $patients->communication = $request->communication;
    $patients->signature=$signature;
    $patients->position = $request->position;
    $patients->behabiour_date = $behavihour_date;
    $patients->gp_details = $request->get('gp_details');
    $patients->created_by = Auth::user()->id;
    $results = $patients->save();


    if($results) {
      return redirect('/patient')->with('message-success', 'Patient has been added');
    } else {
      return redirect('/patient')->with('message-danger', 'Something went wrong');
    }
  }


  public function import(Request $request){
    if($request->hasFile('file')){

      $path = $request->file('file')->getRealPath();

      $data = \Excel::load($path)->get();



      if($data->count()){

        foreach ($data as $value) {

         $data = new Test;
         $data->test_name = $value->test_name;
         $data->details = $value->details;
         $data->code = $value->code;
         $data->sample_e_request = $value->sample_e_request;
         $data->turn_around_time = $value->turn_around_time;
         $data->price = "£".$value->price;
         $data->page = $value->page;
         $data->special_instruction_codes = $value->special_instruction_codes;
         $data->special_instruction = $value->special_instruction;
         $data->save();
       }


                    //DB::table('tests')->insert($arr);

       dd('Insert Recorded successfully.');



     }

   }

   dd('Request data does not have any files to import.');  
 }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $editData = ErpEmployee::find($id);
      $designations = ErpDesignation::where('active_status','=',1)->get();
      $departments = ErpDepartment::where('active_status','=',1)->get();
      $genders = ErpBaseSetup::where('base_group_id', '=', 1)->where('active_status','=',1)->get();
      $blood_groups = ErpBaseSetup::where('base_group_id', '=', 2)->where('active_status','=',1)->get();
      return view('backEnd.patients.show', compact('editData','designations','departments','genders','blood_groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $support_plans = ErpSupportPlan::all();
      $editData = ErpPatient::find($id);
      return view('backEnd.patients.edit', compact('editData', 'support_plans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit;

      $request->validate([
        'patient_id'=>'required',
        'first_name'=> 'required',
        'sur_name'=> 'required',
        'middle_name'=> 'required',
        'date_of_birth'=> 'required'
      ]);

      $signature = ""; 
      if($request->file('signature') != ""){
       $file = $request->file('signature');
       $signature = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
       $file->move('public/uploads/signature/', $signature);
       $signature = 'public/uploads/signature/'.$signature;
     }


     $support_plan = array();
     if (empty($request->support_plan)) {
      $support_plan = '';
    } else {
      $support_plan = implode(',', $request->support_plan);
    }

    if (empty($request->date_of_birth)) {
      $date_of_birth = null;
    } else {
      $date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
    }

    if (empty($request->date_of_death)) {
      $date_of_death = null;
    } else {
      $date_of_death = date('Y-m-d', strtotime($request->date_of_death));
    }

    if (empty($request->behabiour_date)) {
      $behabiour_date = null;
    } else {
      $behabiour_date = date('Y-m-d', strtotime($request->behabiour_date));
    }

    $patients = ErpPatient::find($id);
    $patients->patient_id = $request->get('patient_id');
    $patients->title = $request->get('title');
    $patients->first_name = $request->get('first_name');
    $patients->sur_name = $request->get('sur_name');
    $patients->last_name = $request->get('middle_name');
    $full_name = $request->get('first_name').' '.$request->get('sur_name').' '.$request->get('middle_name');
    $patients->full_name = $full_name;
    $patients->mobile = $request->get('mobile');
    $patients->nhs_no = $request->get('nhs_no');
    $patients->post_code = $request->get('post_code');
    $patients->date_of_birth = $date_of_birth;
    $patients->date_of_death = $date_of_death;
    $patients->next_of_kin = $request->get('next_of_kin');
    $patients->address = $request->get('address');
    $patients->support_plan = $support_plan;
    $patients->gp_details = $request->get('gp_details');
    $patients->behaviour = $request->behaviour;
    $patients->behaviour = $request->behaviour;
    $patients->education = $request->education;
    $patients->daily_living_skills = $request->daily_living_skills;
    $patients->signature=$signature;
    $patients->position = $request->position;
    $patients->behabiour_date = $behabiour_date;
    $patients->updated_by = Auth::user()->name;
    $results = $patients->update();
    if($results) {
      return redirect('/patient')->with('message-success', 'Patient has been updated');
    } else {
      return redirect('/patient')->with('message-danger', 'Something went wrong');
    }

  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePateientView($id){
      $module = 'deletePateient';
      return view('backEnd.showDeleteModal', compact('id','module'));
    }

    public function deletePateient($id){
      $employee = ErpPatient::find($id);
      $employee->active_status = 0;

      $results = $employee->update();
      if($results){
        return redirect()->back()->with('message-success-delete', 'Patient has been deleted successfully');
      }else{
        return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
      }
    }

    public function generatePDF($id){
      $data = ErpPatient::where('id','=', $id)->first();
      $result = [
        'patient_id' => $data->patient_id,
        'first_name' => $data->first_name,
        'middle_name' => $data->last_name,
        'sur_name' => $data->sur_name,
        'behaviour' => $data->behaviour,
        'date_of_birth' => date('Y-m-d', strtotime($data->date_of_birth)),
      ];
        //$data = ['title' => 'Welcome to HDTuto.com'];
      $pdf = PDF::loadView('backEnd.patients.behavihour', $result);

      return $pdf->download('behavihour.pdf');
    }
    
    public function patient_demog($id){
      $data = ErpPatient::where('id','=', $id)->first();
      $result = [
        'patient_id' => $data->patient_id,
        'title' => $data->title,
        'first_name' => $data->first_name,
        'middle_name' => $data->last_name,
        'sur_name' => $data->sur_name,
        'behaviour' => $data->behaviour,
        'date_of_birth' => date('Y-m-d', strtotime($data->date_of_birth)),
        'nhs_no' => $data->nhs_no,
        'mobile' => $data->mobile,
        'post_code' => $data->post_code,
        'address' => $data->address,
        'gp_details' => $data->gp_details,
        'next_of_kin' => $data->next_of_kin,
      ];
        //$data = ['title' => 'Welcome to HDTuto.com'];
      $pdf = PDF::loadView('backEnd.patients.patient_demog', $result);

      return $pdf->download('patient_demographic.pdf');
    }

    public function support_plan($id){
      $data = ErpPatient::where('id','=', $id)->first();
      $support_plans = ErpSupportPlan::all();
      $result = [
        'patient_id' => $data->patient_id,
        'title' => $data->title,
        'first_name' => $data->first_name,
        'middle_name' => $data->last_name,
        'sur_name' => $data->sur_name,
        'behaviour' => $data->behaviour,
        'date_of_birth' => date('Y-m-d', strtotime($data->date_of_birth)),
        'nhs_no' => $data->nhs_no,
        'mobile' => $data->mobile,
        'post_code' => $data->post_code,
        'support_plan' => $data->support_plan,
        'address' => $data->address,
        'gp_details' => $data->gp_details,
        'next_of_kin' => $data->next_of_kin,
      ];
        //$data = ['title' => 'Welcome to HDTuto.com'];
      $pdf = PDF::loadView('backEnd.patients.support_plan', compact('result', 'support_plans'));

      return $pdf->download('support_plan.pdf');
    }

    public function full_patients_details($id){

      $data = ErpPatient::where('id','=', $id)->first();
      $support_plans = ErpSupportPlan::all();
      $result = [
        'patient_id' => $data->patient_id,
        'title' => $data->title,
        'first_name' => $data->first_name,
        'middle_name' => $data->last_name,
        'sur_name' => $data->sur_name,
        'behaviour' => $data->behaviour,
        'date_of_birth' => date('Y-m-d', strtotime($data->date_of_birth)),
        'nhs_no' => $data->nhs_no,
        'mobile' => $data->mobile,
        'post_code' => $data->post_code,
        'support_plan' => $data->support_plan,
        'address' => $data->address,
        'gp_details' => $data->gp_details,
        'next_of_kin' => $data->next_of_kin,
        'behaviour' => $data->behaviour,
        'communication' => $data->communication,
        'daily_living_skills' => $data->daily_living_skills,
        'education' => $data->education,
      ];
        //$data = ['title' => 'Welcome to HDTuto.com'];
      $pdf = PDF::loadView('backEnd.patients.full_patients_details', compact('result', 'support_plans'));

      return $pdf->download('full_patients_details.pdf');
    }


    
  }
