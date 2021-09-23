<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TTrack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_track', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('m_vehicle');
            $table->unsignedBigInteger('roda_id')->nullable();
            $table->foreign('roda_id')->references('id')->on('m_vehicle_roda');
            $table->string('jarak')->nullable();
            $table->string('kontainer')->nullable();
            $table->string('posisi')->nullable();
            $table->integer('status')->nullable();
            $table->integer('jenis')->comment('0=roda', '1=kontainer')->nullable();
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
        //
    }
}
