<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePossTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poss', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pos');
            $table->text('keterangan', 255)->nullable();
            $table->timestamps();
            $table->foreignId('zona_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poss');
    }
}
