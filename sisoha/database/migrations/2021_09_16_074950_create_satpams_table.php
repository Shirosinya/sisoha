<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatpamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satpams', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 64);
            $table->string('nik', 16)->unique();
            $table->enum('jabatan',['kajaga','wakajaga','penjaga'])->default('penjaga');
            $table->enum('status',['bekerja','cuti','lembur','ganti shift'])->default('bekerja');
            $table->timestamps();
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
        Schema::dropIfExists('satpams');
    }
}
