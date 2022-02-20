<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelPasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pasien', function (Blueprint $table) {
            $table->id();

            $table->string('kode_pasien')->unique();
            $table->string('nama_lengkap')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('no_ktp')->unique();
            $table->string('no_handphone')->nullable();

            $table->string('foto_ktp', 2048)->nullable();
            $table->boolean('is_verification')->default(0);

            $table->timestamp('email_verified_at')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->boolean('is_active')->default(0);


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
        Schema::dropIfExists('tb_pasien');
    }
}
