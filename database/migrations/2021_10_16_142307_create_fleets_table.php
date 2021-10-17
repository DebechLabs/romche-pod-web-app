<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet', function (Blueprint $table) {
            $table->id();
            $table->string("registration_no")->unique();
            $table->string("vehicle_type");
            $table->string("color");
            $table->string("chassis_no")->nullable();
            $table->string("engine_no")->nullable();
            $table->string("logbook_no")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fleet');
    }
}
