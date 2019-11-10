<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient');
            $table->string('title');
            $table->date('date');
            $table->longText('reason');
            $table->string('health_status_type');
            $table->string('health_status');
            $table->string('normal_health_status');
            $table->longText('description')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('path')->nullable();
            $table->integer('emp_id');
            $table->string('report_status');
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
