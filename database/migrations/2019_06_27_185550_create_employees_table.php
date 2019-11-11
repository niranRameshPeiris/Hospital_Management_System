<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('employed_date');
            $table->string('nic');
            $table->integer('role');
            $table->integer('age');
            $table->string('gender');
            $table->string('email');
            $table->string('mobile');
            $table->string('landline')->nullable();
            $table->longText('address');
            $table->longText('description')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('employees');
    }
}
