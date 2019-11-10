<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('employed_date');
            $table->date('registration_date');
            $table->string('registration_no');
            $table->string('nic');
            $table->string('specialty');
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
        DB::statement("ALTER TABLE hms_doctors AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
