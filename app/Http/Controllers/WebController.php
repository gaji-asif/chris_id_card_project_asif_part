<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ErpEmployee;
use App\ErpPatient;
use App\ErpExpense;
use DB;
use App\User;


class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        //echo "asif"; exit;
      

     //$data = DB::table('tests')->whereNotNull('test_name')->get();
     //$tests_for_dropdowns = DB::table('tests')->whereNotNull('test_name')->where('active_status', 1)->get();
     return view('web.index');

        
    }
}
