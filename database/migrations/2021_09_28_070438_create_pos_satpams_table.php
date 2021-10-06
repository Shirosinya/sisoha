<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosSatpamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_satpams', function (Blueprint $table) {
            $table->id();
            $table->datetime('jadwal_shift');
            $table->timestamps();
            $table->foreignId('satpam_id');
            $table->foreignId('pos_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_satpams');
    }
}
