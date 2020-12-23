<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErpAccountsClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_accounts_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('start_id')->nullable();
            $table->integer('end_id')->nullable();
            $table->string('class_name')->nullable();
            $table->string('class_unit')->nullable();
            $table->string('class_unit_type')->nullable();
            $table->string('unit_description')->nullable();
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
        Schema::dropIfExists('erp_accounts_classes');
    }
}
