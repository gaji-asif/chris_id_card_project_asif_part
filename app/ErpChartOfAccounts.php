<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErpChartOfAccounts extends Model
{
    public function accountCategory(){
		return $this->belongsTo('App\ErpAccountsCategory', 'coa_category', 'id');
	}
	public function accountClass(){
		return $this->belongsTo('App\ErpAccountsClass', 'coa_class', 'id');
	}
	
}
