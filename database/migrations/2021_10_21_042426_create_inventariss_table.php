<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarissTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventariss', function (Blueprint $table) {
            $table->id();
            $table->enum('kondisi',['Baik/Lengkap','Rusak/Hilang']);
            $table->text('keterangan', 255)->nullable();
            $table->timestamps();
            $table->foreignId('barang_id');
            $table->foreignId('regu_id')->nullable();
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
        Schema::dropIfExists('inventariss');
    }
}
