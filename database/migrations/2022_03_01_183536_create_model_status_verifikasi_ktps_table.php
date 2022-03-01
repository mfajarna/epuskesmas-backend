<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelStatusVerifikasiKtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_status_verifikasi_ktp', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pasien_id');
            $table->foreign('pasien_id')->references('id')->on('tb_pasien')
                ->onUpdate('cascade')->onDelete('cascade');


            $table->string('status')->nullable('');

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
        Schema::dropIfExists('tb_status_verifikasi_ktp');
    }
}
