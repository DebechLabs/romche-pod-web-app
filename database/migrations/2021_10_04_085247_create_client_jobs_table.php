<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_jobs', function (Blueprint $table) {
            $table->id();
            $table->string("tracking_number")->unique();
            $table->integer("client_id");
            $table->integer("driver_id");
            $table->text("goods_description");
            $table->string("pickup");
            $table->string("destination");
            $table->string("firebase_uid")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('client_jobs');
    }
}
