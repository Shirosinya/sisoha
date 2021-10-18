<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugass', function (Blueprint $table) {
            $table->id();
            $table->time('pukul')->nullable();
            $table->text('uraian_tugas',255);
            $table->enum('keterangan', ['Aman, Tertib Terkendali', 'Tidak Aman, Perlu Tindakan Lanjutan'])
            ->default('Aman, Tertib Terkendali');
            $table->timestamps();
            $table->foreignId('regu_id');
            //fake id just for identifier
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
        Schema::dropIfExists('tugass');
    }
}
