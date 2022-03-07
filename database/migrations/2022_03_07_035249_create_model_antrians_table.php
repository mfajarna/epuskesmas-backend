<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelAntriansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_antrian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_poli');
            $table->foreign('id_poli')->references('id')->on('tb_poli')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('status')->nullable();
            $table->integer('no_antrian')->nullable();

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
        Schema::dropIfExists('tb_antrian');
    }
}
