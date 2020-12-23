<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErpWebController extends Controller
{
    public function home()
    {
        //$employees = ErpEmployee::where('active_status', '=', 1)->get();
        return view('web.home');
    }

    public function behabiour()
    {
        //$employees = ErpEmployee::where('active_status', '=', 1)->get();
        return view('web.behabiour');
    }

    public function support_plan(){
    	return view('web.support_plan');
    }
    
}
