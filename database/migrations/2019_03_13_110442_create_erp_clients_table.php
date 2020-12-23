<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErpClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_name')->length(100);
            // $table->integer('account_status')->length(2);
            $table->string('client_contact')->length(50)->nullable();
            // $table->integer('client_cur_bal')->length(20)->nullable();
            $table->string('client_phone_1')->length(20)->nullable();
            $table->string('client_phone_2')->length(20)->nullable();
            $table->string('client_fax')->length(20)->nullable();
            $table->string('email')->length(50)->nullable();
            // $table->string('client_account')->length(30)->nullable();
            // $table->integer('client_balance')->length(20)->nullable();
            // $table->integer('client_paid')->length(20)->nullable();
            // $table->integer('client_turnover')->length(20)->nullable();
            // $table->string('last_invoice_number')->length(20)->nullable();
            // $table->integer('credit_limit')->length(20)->nullable();
            // $table->integer('amount_recevable')->length(20)->nullable();
            // $table->timestamp('last_payment_date')->nullable();
            $table->string('client_remarks')->length(200)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            // $table->string('company_id')->length(12);
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
        Schema::dropIfExists('erp_clients');
    }
}
