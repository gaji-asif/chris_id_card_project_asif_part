<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class ErpSecretaryToPatient extends Model
{
    public static function totalPricesBySecratry($prescribe_id){
    	$total_prices_by_secratry = DB::select(DB::raw("SELECT total_price FROM erp_secretary_to_patients WHERE prescribe_id = $prescribe_id"));
    	// print_r($total_pricess);
    	// exit;

    	if(count($total_prices_by_secratry)>0){
    		return $total_prices_by_secratry[0]->total_price;
    	}
    	else{
    		return null;
    	}
    	
    	
    }
}
