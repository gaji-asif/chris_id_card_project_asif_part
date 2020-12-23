<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
     public $fillable = ['title','test_name'];

     public static function addTocartResult($test_name, $code, $details){
      $query = '';
      
       if(isset($test_name)){
          $query .= "AND t.test_name = '$test_name'";
       }
       if(isset($code)){
          $query .= "AND t.code LIKE '%$code%'";
       }

       if(isset($details)){
          $query .= "AND t.details LIKE '%$details%'";
       }
     
       return $data = DB::select(DB::raw("SELECT t.* 
            FROM tests t 
            WHERE t.active_status = 1 $query"));
       
     }
}
