<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFleetIdToClientJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_jobs', function (Blueprint $table) {
            $table->bigInteger("fleet_id")->after("driver_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_jobs', function (Blueprint $table) {
            $table->dropColumn(["fleet_id"]);
        });
    }
}
