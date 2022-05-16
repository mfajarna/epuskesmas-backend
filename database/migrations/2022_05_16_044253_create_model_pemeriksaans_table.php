<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pasien');
            $table->integer('umur')->nullable();
            $table->string('no_urut');
            $table->string('status');
            $table->integer('corrected_by');
            $table->string('kunjungan');
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
        Schema::dropIfExists('tb_pemeriksaan');
    }
}
