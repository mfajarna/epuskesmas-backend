<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPasienModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_pasien', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pasien_id');
            $table->foreign('pasien_id')->references('id')->on('tb_pasien')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('gol_darah')->nullable();
            $table->date('tanggal_lahir')->nullable();


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
        Schema::dropIfExists('tb_detail_pasien');
    }
}
