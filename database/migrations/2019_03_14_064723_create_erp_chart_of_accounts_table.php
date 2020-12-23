<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErpChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_chart_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code')->nullable();
            $table->string('coa_name')->nullable();
            $table->string('coa_description')->nullable();
            $table->integer('coa_category')->nullable();
            $table->integer('coa_type')->nullable();
            $table->integer('coa_class')->nullable();
            $table->integer('coa_level')->nullable();
            $table->integer('coa_parent')->nullable();
            $table->integer('coa_control')->nullable()->comment('control account = 1, non control account = 0');
            $table->integer('project_id')->nullable();
            $table->integer('debit_amount')->nullable();
            $table->integer('credit_amount')->nullable();
            $table->integer('opening_debit_amount')->nullable();
            $table->integer('opening_credit_amount')->nullable();
            $table->integer('shadow_debit_amount')->nullable();
            $table->integer('shadow_credit_amount')->nullable();
            $table->integer('company_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('erp_chart_of_accounts');
    }
}
