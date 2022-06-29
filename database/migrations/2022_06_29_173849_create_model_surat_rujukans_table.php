<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelSuratRujukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_surat_rujukan_pasien', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_pasien');
            $table->string('path_file_pdf');
            $table->string('no_surat');

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
        Schema::dropIfExists('tb_surat_rujukan_pasien');
    }
}
