<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class ErpPatientTest extends Model
{
    public static function alltestsByPatientId($prescribe_id){
    	return ErpPatientTest::where('patient_id', $prescribe_id)->get();
    }

    public static function totalPricesByPatientId($prescribe_id){
    	$total_prices = DB::select(DB::raw("SELECT SUM(price) as SUM_PRICE FROM erp_patient_tests WHERE patient_id = $prescribe_id"))[0];
    	return $total_prices->SUM_PRICE;
    }
}
