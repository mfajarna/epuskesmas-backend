<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasilPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_hasil_pemeriksaan', function (Blueprint $table) {
            $table->id();

            $table->integer('id_pemeriksaan');
            $table->integer('id_pasien');
            $table->boolean('is_rujukan')->nullable();
            $table->longText('rujukan')->nullable();
            $table->longText('resep_obat')->nullable();

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
        Schema::dropIfExists('tb_hasil_pemeriksaan');
    }
}
