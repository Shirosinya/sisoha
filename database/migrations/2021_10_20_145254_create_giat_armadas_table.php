<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiatArmadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giat_armadas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 64);
            $table->string('keterangan', 255);
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
        Schema::dropIfExists('giat_armadas');
    }
}
