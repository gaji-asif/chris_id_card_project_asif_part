<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErpProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_name')->length(200);
            $table->date('project_start_date');
            // $table->integer('project_status')->length(2);
            $table->date('project_end_date')->nullable();
            $table->integer('project_amount')->length(20);
            $table->string('client_id')->length(20);
            $table->integer('advances_received')->length(20)->nullable();
            $table->date('last_date_of_receipt')->nullable();
            $table->date('completion_due_date')->nullable();
            $table->date('completed_on')->nullable();
            $table->integer('receipts_to_date')->length(20)->nullable();
            $table->integer('expenses_to_date')->length(20)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            // $table->string('coa_account_id')->length(20)->nullable();
            // $table->string('company_id')->length(20);
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
        Schema::dropIfExists('erp_projects');
    }
}
