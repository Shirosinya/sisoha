<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekaps', function (Blueprint $table) {
            $table->id();
            $table->text('uraian_tugas', 255);
            $table->time('mulai');
            $table->time('selesai')->nullable();
            $table->enum('keterangan', ['Aman, Tertib Terkendali', 'Tidak Aman, Perlu Tindakan Lanjutan'])
            ->default('Aman, Tertib Terkendali');
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
        Schema::dropIfExists('rekaps');
    }
}
