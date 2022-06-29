<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelPemeriksaanlabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pemeriksaanlab', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user');
            $table->date('tanggal');
            $table->string('no_rm');
            $table->json('jenis_pemeriksaan');
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
        Schema::dropIfExists('tb_pemeriksaanlab');
    }
}
