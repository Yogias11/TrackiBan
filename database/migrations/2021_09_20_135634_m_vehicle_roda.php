<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MVehicleRoda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_vehicle_roda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('m_vehicle')->onUpdate('cascade');
            $table->string('kontainer')->nullable();
            $table->integer('roda');
            $table->string('no_seri');
            $table->string('posisi');
            $table->integer('status')->comment('0=>belum dipindah', '1=dipindah ke yang lain', '2=Sudah habis penggunaan');
            $table->integer('aktif');
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
