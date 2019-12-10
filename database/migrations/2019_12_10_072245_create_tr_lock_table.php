<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrLockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_lock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tr_yoyaku',255)->nullable();
            $table->string('tr_yoyaku_danjiki_jikan',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_lock');
    }
}
