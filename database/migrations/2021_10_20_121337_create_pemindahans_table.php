<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemindahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemindahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemindahan', 64);
            $table->string('gudang', 128);
            $table->string('tujuan', 128);
            $table->string('armada', 64);
            $table->string('keterangan', 225);
            $table->timestamps();
            $table->foreignId('regu_id');
            $table->foreignId('zona_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemindahans');
    }
}
