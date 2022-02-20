<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelJadwalPraktikDoktersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_jadwalpraktikdokter', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('dokter_id');
            $table->foreign('dokter_id')->references('id')->on('tb_dokter')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('poli_id');
            $table->foreign('poli_id')->references('id')->on('tb_poli')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('waktu')->nullable();

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
        Schema::dropIfExists('tb_jadwalpraktikdokter');
    }
}
