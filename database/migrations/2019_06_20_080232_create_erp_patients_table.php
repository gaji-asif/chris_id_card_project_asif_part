<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErpPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_id')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('sur_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('nhs_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('mobile')->nullable();
            $table->string('post_code')->nullable();
            $table->date('date_of_death')->nullable();
            $table->text('address')->nullable();
            $table->text('gp_details')->nullable();
            $table->string('next_of_kin')->nullable();
            $table->string('support_plan')->nullable();
            $table->longText('behaviour')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('erp_patients');
    }
}
