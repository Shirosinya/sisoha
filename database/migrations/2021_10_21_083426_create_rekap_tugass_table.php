<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapTugassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_tugass', function (Blueprint $table) {
            $table->id();
            $table->text('uraian_tugas');
            $table->time('mulai');
            $table->time('selesai');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->foreignId('satpam_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_tugass');
    }
}
