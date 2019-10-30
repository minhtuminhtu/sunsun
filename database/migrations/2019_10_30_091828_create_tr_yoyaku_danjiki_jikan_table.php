<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrYoyakuDanjikiJikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_yoyaku_danjiki_jikan', function (Blueprint $table) {
            $table->integer('booking_id');
            $table->string('service_date');
            $table->string('service_time_1',255);
            $table->string('service_time_2',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_yoyaku_danjiki_jikan');
    }
}
