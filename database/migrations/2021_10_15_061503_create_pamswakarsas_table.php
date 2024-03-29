<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePamswakarsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pamswakarsas', function (Blueprint $table) {
            $table->id();
            $table->string('wilayah');
            $table->string('nama_petugas', 64);
            $table->integer('po');
            $table->integer('pb');
            $table->integer('ok');
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
        Schema::dropIfExists('pamswakarsas');
    }
}
