<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_shifts', function (Blueprint $table) {
            $table->id();
            $table->char('nama');
            $table->time('waktu_awal');
            $table->time('waktu_akhir');
            $table->timestamps();
            $table->foreignId('shift_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_shifts');
    }
}
